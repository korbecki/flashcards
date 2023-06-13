<?php


require_once 'BaseController.php';
require_once __DIR__ . '/../model/Flashcard.php';
require_once __DIR__ . '/../model/Page.php';
require_once __DIR__ . '/../repository/FlashcardRepository.php';

class FlashcardsController extends BaseController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_PATH = '/../web/images/upload/';

    private $messages = [];

    public function addFlashcards()
    {
        if (!isset($_COOKIE['user'])) {
            $this->render('login');
        }
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            $fileName = md5(date('d-m-y h:i:s')) . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], dirname(__DIR__) . self::UPLOAD_PATH . $fileName);

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
            $repository = new FlashcardRepository();
            $repository->saveFlashcard($flashcard, $pages);
            return $this->flashcards();
        }
        return $this->render('add_flashcards');

    }

    public function flashcards()
    {
        if (!isset($_COOKIE['user'])) {
            $this->render('login');
        }

        $repository = new FlashcardRepository();
        $flashcards = $repository->getFlashcardsByUserId($this->getUserId());

        $this->render('flashcards', ['my_flashcards' => $flashcards]);
    }

    public function search()
    {
        if (!isset($_COOKIE['user'])) {
            $this->render('login');
        }

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $repository = new FlashcardRepository();
            echo json_encode($repository->getFlashcardsByUserIdAndTitle($decoded['search'], $this->getUserId()));
        }
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