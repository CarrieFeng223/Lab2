<?php
class Book {
    private $title;
    private $author;
    private $year;

    // constructor
    public function __construct($title, $author, $year) {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
    }

    //getters and setters
    public function getTitle() {
        return $this->title;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getYear() {
        return $this->year;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function setYear($year) {
        $this->year = $year;
    }
}
