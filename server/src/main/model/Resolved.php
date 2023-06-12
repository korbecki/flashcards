<?php

class Resolved
{
    private $resolvedId;
    private $userId;
    private $pageId;
    private $answer;
    private $isCorrect;

    /**
     * @param $resolvedId
     * @param $userId
     * @param $pageId
     * @param $answer
     * @param $isCorrect
     */
    public function __construct($resolvedId, $userId, $pageId, $answer, $isCorrect)
    {
        $this->resolvedId = $resolvedId;
        $this->userId = $userId;
        $this->pageId = $pageId;
        $this->answer = $answer;
        $this->isCorrect = $isCorrect;
    }

    /**
     * @return mixed
     */
    public function getResolvedId()
    {
        return $this->resolvedId;
    }

    /**
     * @param mixed $resolvedId
     */
    public function setResolvedId($resolvedId): void
    {
        $this->resolvedId = $resolvedId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
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
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * @param mixed $isCorrect
     */
    public function setIsCorrect($isCorrect): void
    {
        $this->isCorrect = $isCorrect;
    }



}