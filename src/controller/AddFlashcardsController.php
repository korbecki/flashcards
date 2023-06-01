<?php


use model\Flashcard;
use model\Page;

require_once 'BaseController.php';
require_once __DIR__ . '/../model/Flashcard.php';
require_once __DIR__ . '/../model/Page.php';
require_once __DIR__ . '/../repository/FlashcardRepository.php';

class AddFlashcardsController extends BaseController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_PATH = '/uploads/';

    private $messages = [];

    public function addFlashcards()
    {
        if (!isset($_COOKIE['user'])) {
            $this->render('login');
        }
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            $fileName = dirname(__DIR__).self::UPLOAD_PATH.md5(date('d-m-y h:i:s')).$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $fileName);


            $flashcardRepository = new FlashcardRepository();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $flashcard = new Flashcard(null, $name, $description, $fileName, true, $this->getUserId(), null);

            $start = true;
            $index = 1;

            $pages = array();
            while ($start) {
                $question = $_POST['question' . $index];
                $answer = $_POST['answer' . $index];

                if (!$question) {
                    $start = false;
                } else {
                    $page = new Page(null, null, $question, null, $answer, null);
                    $pages[] = $page;
                }
                $index++;
            }
            $flashcardRepository->saveFlashcard($flashcard, $pages);
            return $this->render('flashcards');
        }
        return $this->render('add_flashcards');

    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large';
            return false;
        }
        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported';
            return false;
        }

        return true;
    }
}