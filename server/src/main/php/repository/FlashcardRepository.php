<?php

require_once 'Repository.php';
require_once __DIR__ . '/../model/Flashcard.php';
require_once __DIR__ . '/../model/Page.php';
require_once __DIR__ . '/../dto/FlashcardDto.php';

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

    public function getFlashcardsByUserIdAndTitle($title, $userId): array
    {
        $statement = $this->database->connect()->prepare('
            SELECT flashcard_id, name, description, icon, is_public, created_by, created_at,
                (SELECT COUNT(*) from page as p where p.flashcard_id=flashcard.flashcard_id) AS pages_count
            FROM flashcard
            WHERE created_by = :userId and LOWER(name) LIKE :name;');

        $title = '%' . strtolower($title) . '%';
        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':name', $title);
        $statement->execute();
        $flashcards = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $flashcards;
    }

    public function getFlashcardsByUserId($userId): array
    {
        $statement = $this->database->connect()->prepare('
            SELECT DISTINCT flashcard_id, name, description, icon, is_public, created_by, created_at,
                (SELECT COUNT(*) from page as p where p.flashcard_id=flashcard.flashcard_id) AS pages_count
            FROM flashcard
            WHERE created_by = :userId OR is_public=true');

        $statement->bindParam(':userId', $userId);
        $statement->execute();
        $flashcards = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->createFlashcardsArrayFromDB($flashcards);
    }

    public function getPublicFlashcards(): array
    {
        $statement = $this->database->connect()->prepare('
            SELECT flashcard_id, name, description, icon, is_public, created_by, created_at,
                (SELECT COUNT(*) from page as p where p.flashcard_id=flashcard.flashcard_id) AS pages_count
            FROM flashcard
            WHERE is_public = true;');

        $statement->execute();
        $flashcards = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->createFlashcardsArrayFromDB($flashcards);
    }

    private function createFlashcardsArrayFromDB($flashcards): array
    {
        $result = [];

        foreach ($flashcards as $flashcard) {
            $result[] = new FlashcardDto(
                $flashcard['flashcard_id'],
                $flashcard['name'],
                $flashcard['description'],
                $flashcard['icon'],
                $flashcard['is_public'],
                $flashcard['created_by'],
                $flashcard['created_at'],
                $flashcard['pages_count']
            );
        }

        return $result;
    }

}