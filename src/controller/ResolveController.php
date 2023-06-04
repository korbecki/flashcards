<?php


use model\Flashcard;
use model\Page;

require_once 'BaseController.php';
require_once __DIR__ . '/../model/Flashcard.php';
require_once __DIR__ . '/../model/Page.php';
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
        $flashcardId = $id = $_GET['id'];

        $page = $repository->getQuestionAndAnswer($flashcardId, $userId);

        $this->render("resolve", ['page' => $page]);

    }

}