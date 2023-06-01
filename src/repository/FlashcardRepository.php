<?php

use model\Flashcard;
use model\Page;

require_once 'Repository.php';
require_once __DIR__.'/../model/Flashcard.php';
require_once __DIR__.'/../model/Page.php';
class FlashcardRepository extends Repository
{
    public function saveFlashcard(Flashcard $flashcard, $page)
    {
        $sql = 'INSERT INTO flashcard(name, description, icon, is_public, created_by) VALUES(?, ?, ?, ?, ?)';
        $connect = $this->database->connect();
        $statement = $connect->prepare($sql);
        $statement->execute([$flashcard->getName(), $flashcard->getDescription(), $flashcard->getIcon(), $flashcard->getIsPublic(), $flashcard->getCreatedBy()]);
        $id = $connect->lastInsertId();

        foreach ($page as &$value) {
            $this->savePage($id, $value);
        }
    }

    public function savePage($flashcardId, Page $page)
    {
        $sql = 'INSERT INTO page(flashcard_id, question, question_image, answer, answer_image) VALUES(?, ?, ?, ?, ?)';
        $statement = $this->database->connect()->prepare($sql);
        $statement->execute([$flashcardId, $page->getQuestion(), $page->getQuestionImage(), $page->getAnswer(), $page->getAnswerImage()]);

    }

}