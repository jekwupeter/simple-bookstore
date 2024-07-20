<?php

class Book{
    public $id;
    public $title;
    public $author;
    public $genre;
    public $publication_year;

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setAuthor($author) {
        $this->author = $author;
    }

    function setGenre($genre) {
        $this->genre = $genre;
    }

    function setPublicationYear($publication_year) {
        $this->publication_year = $publication_year;
    }
}
?>