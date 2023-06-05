<?php


use model\Flashcard;
use model\Page;
use model\Resolved;

require_once 'BaseController.php';
require_once __DIR__ . '/../model/Flashcard.php';
require_once __DIR__ . '/../model/Page.php';
require_once __DIR__ . '/../model/Resolved.php';
require_once __DIR__ . '/../repository/ResolveRepository.php';

class ResolveController extends BaseController
{

    public function resolve()
    {
        if (!isset($_COOKIE['user'])) {
            $this->render('login');
        }

        $repository = new ResolveRepository();

        $userId = $this->getUserId();
        $flashcardId  = $_GET['id'];

        $page = $repository->getQuestionAndAnswer($flashcardId, $userId);

        $this->render("resolve", ['page' => $page]);
    }

    public function getNextPage()
    {
        if (!isset($_COOKIE['user'])) {
            $this->render('login');
        }

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $repository = new ResolveRepository();

            $userId = $this->getUserId();
            $pageId = $decoded['pageId'];

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($repository->getQuestionAndAnswerByPrevPage($userId, $pageId));
        }
    }

    public function saveAttempt()
    {
        if (!isset($_COOKIE['user'])) {
            $this->render('login');
        }

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            $repository = new ResolveRepository();

            $userId = $this->getUserId();
            $pageId = $decoded['pageId'];
            $isCorrect = $decoded['isCorrect'];
            $answer = $decoded['answer'];

            header('Content-type: application/json');
            http_response_code(200);

            $resolved = new Resolved(null, $userId, $pageId, $answer, $isCorrect);
            $id = $repository->save($resolved);

            echo json_encode($id, $this->getUserId());
        }
    }

}