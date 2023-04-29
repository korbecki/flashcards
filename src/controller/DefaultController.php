<?php
require_once 'BaseController.php';
class DefaultController extends BaseController {

    public function index()
    {
        $this -> render('login');
    }

        public function flashcards()
    {
        $this -> render('flashcards');

    }
}