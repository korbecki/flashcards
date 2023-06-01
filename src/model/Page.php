<?php

namespace model;

class Page
{
    private $pageId;
    private $flashcardId;
    private $question;
    private $questionImage;
    private $answer;
    private $answerImage;

    /**
     * @param $pageId
     * @param $flashcardId
     * @param $question
     * @param $questionImage
     * @param $answer
     * @param $answerImage
     */
    public function __construct($pageId, $flashcardId, $question, $questionImage, $answer, $answerImage)
    {
        $this->pageId = $pageId;
        $this->flashcardId = $flashcardId;
        $this->question = $question;
        $this->questionImage = $questionImage;
        $this->answer = $answer;
        $this->answerImage = $answerImage;
    }

    /**
     * @return mixed
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * @param mixed $pageId
     */
    public function setPageId($pageId): void
    {
        $this->pageId = $pageId;
    }

    /**
     * @return mixed
     */
    public function getFlashcardId()
    {
        return $this->flashcardId;
    }

    /**
     * @param mixed $flashcardId
     */
    public function setFlashcardId($flashcardId): void
    {
        $this->flashcardId = $flashcardId;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question): void
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getQuestionImage()
    {
        return $this->questionImage;
    }

    /**
     * @param mixed $questionImage
     */
    public function setQuestionImage($questionImage): void
    {
        $this->questionImage = $questionImage;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @return mixed
     */
    public function getAnswerImage()
    {
        return $this->answerImage;
    }

    /**
     * @param mixed $answerImage
     */
    public function setAnswerImage($answerImage): void
    {
        $this->answerImage = $answerImage;
    }



}