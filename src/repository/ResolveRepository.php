<?php

use model\Page;
use model\Resolved;

require_once 'Repository.php';
require_once __DIR__.'/../model/Page.php';
require_once __DIR__.'/../model/Resolved.php';
class ResolveRepository extends Repository
{
    public function getQuestionAndAnswerByPrevPage($userId, $prevPageId)
    {
        $sql = 'SELECT * FROM page as p
                WHERE flashcard_id=(SELECT flashcard_id FROM page WHERE page_id = :pageId LIMIT 1)
                    AND page_id NOT IN (SELECT r.page_id FROM resolved r WHERE r.page_id = p.page_id AND r.user_id=:userId)
                    AND page_id > :pageId
                ORDER BY page_id
                LIMIT 1;';
        $statement = $this->database->connect()->prepare($sql);

        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':pageId', $prevPageId);
        $statement->execute();

        $page = $statement->fetch(PDO::FETCH_ASSOC);

        if ($page == false) {
            return null;
        }

        return $page;
    }

    public function getQuestionAndAnswer($flashcardId, $userId): ?Page
    {
        $sql = 'SELECT * FROM page as p
                    WHERE flashcard_id=:flashcardId
                    AND page_id IN (SELECT r.page_id FROM resolved r WHERE r.page_id = p.page_id AND r.user_id=:userId)
                    ORDER BY page_id
                    LIMIT 1;';
        $statement = $this->database->connect()->prepare($sql);

        $statement->bindParam(':flashcardId', $flashcardId);
        $statement->bindParam(':userId', $userId);
        $statement->execute();

        $page = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$page) {
            $sql = 'SELECT * FROM page as p
                    WHERE flashcard_id=:flashcardId
                    AND page_id NOT IN (SELECT r.page_id FROM resolved r WHERE r.page_id = p.page_id AND r.user_id=:userId)
                    ORDER BY page_id
                    LIMIT 1;';

            $statement = $this->database->connect()->prepare($sql);

            $statement->bindParam(':flashcardId', $flashcardId);
            $statement->bindParam(':userId', $userId);
            $statement->execute();

            $page = $statement->fetch(PDO::FETCH_ASSOC);

            if (!$page) {
                $sql = 'SELECT * FROM page as p
                            WHERE flashcard_id=:flashcardId
                            ORDER BY page_id
                            LIMIT 1;';

                $statement = $this->database->connect()->prepare($sql);

                $statement->bindParam(':flashcardId', $flashcardId);
                $statement->execute();

                $page = $statement->fetch(PDO::FETCH_ASSOC);

                if (!$page) {
                    return null;
                }
                return new Page($page['page_id'], $page['flashcard_id'], $page['question'], $page['question_image'],
                    $page['answer'], $page['answer_image'], $page['created_at']);
            }

            return new Page($page['page_id'], $page['flashcard_id'], $page['question'], $page['question_image'],
                $page['answer'], $page['answer_image'], $page['created_at']);
        }

        return new Page($page['page_id'], $page['flashcard_id'], $page['question'], $page['question_image'],
            $page['answer'], $page['answer_image'], $page['created_at']);
    }

    public function save(Resolved $resolved)
    {
        $conn = $this->database->connect();
        $sql='INSERT INTO resolved(user_id, page_id, answer, is_correct) VALUES (:userId, :pageId, :answer, :isCorrect);';
        $statement = $conn->prepare($sql);

        $userId = $resolved->getUserId();
        $pageId = $resolved->getPageId();
        $answer = $resolved->getAnswer();
        $isCorrect = $resolved->getIsCorrect();

        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':pageId', $pageId);
        $statement->bindParam(':answer', $answer);
        $statement->bindParam(':isCorrect', $isCorrect, PDO::PARAM_BOOL);

        $statement->execute();
        return $conn->lastInsertId();
    }
}