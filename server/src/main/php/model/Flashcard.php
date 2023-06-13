<?php

class Flashcard
{
    private $flashcardId;
    private $name;
    private $description;
    private $icon;
    private $isPublic;
    private $createdBy;
    private $createdAt;

    public function __construct($flashcardId, $name, $description, $icon, $isPublic, $createdBy, $createdAt)
    {
        $this->flashcardId = $flashcardId;
        $this->name = $name;
        $this->description = $description;
        $this->icon = $icon;
        $this->isPublic = $isPublic;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return mixed
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * @param mixed $isPublic
     */
    public function setIsPublic($isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}