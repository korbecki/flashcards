<?php


use model\Flashcard;
use model\Page;

require_once 'BaseController.php';
require_once __DIR__.'/../model/Flashcard.php';
require_once __DIR__.'/../model/Page.php';
require_once __DIR__.'/../repository/FlashcardRepository.php';
class AddFlashcardsController extends BaseController
{
    public function addFlashcards()
    {
        if (!isset($_COOKIE['user'])) {
            $this -> render('login');
        }
        if ($this->isPost()) {
            $flashcardRepository = new FlashcardRepository();
            $name = $_POST['name'];
            $description = $_POST['description'];
            $flashcard = new Flashcard(null, $name, $description, null, true, $this->getUserId(), null);

            $start = true;
            $index = 1;

            $pages = array();
            while ($start) {
                $question = $_POST['question'.$index];
                $answer = $_POST['answer'.$index];

                if (!$question) {
                    $start = false;
                } else{
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
}