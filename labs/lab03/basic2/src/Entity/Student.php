<?php
namespace App\Entity;


class Student
{
    private $id;
    private $firstName;
    private $surname;

    /**
     * Student constructor.
     *
     * @param $id
     * @param $firstName
     * @param $surname
     */
    public function __construct($id, $firstName, $surname)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }




}