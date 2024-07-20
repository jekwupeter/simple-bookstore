<?php
require_once 'db_connection.php';

class BooksDbFunctions{
    private $db;

     #connect to the SQLite database
     function __construct($db) {
        $this->db = $db;
        $this->createBooksTable();
    }

    function createBooksTable(){
        //create table in sqlite database
        $stmt = "CREATE TABLE IF NOT EXISTS Books(Id integer primary key, 
                    Title text, Author text, Genre text, 'Publication_Year' Datetime)";
        $this->db->exec($stmt);
    }

    public function deleteBookById($id){
        //$stmt = "DELETE FROM Books where Id='$id'";  
        //return $this->db->exec($stmt);
        $stmt = $this->db->prepare("DELETE FROM Books where Id='$id'");
        return $stmt->execute();
    }

    public function AddBook($book){
        $stmt = "SELECT 1 FROM Books ORDER BY Id DESC";
        $records=$this->db->query($stmt);
        $record = $records->fetchArray();
        $id = 1;
        if ($record !='false'){
            echo "INSIDE ID";
            $id = $record['Id'] + 1;
        }

        $stmt = $this->db->prepare("INSERT INTO Books (Id, Title, Author, Genre, Publication_Year) VALUES (:id, :title, :author, :genre, :yearr)");
        // Bind the values to the placeholders
        $stmt->bindValue(':title', $book->title, SQLITE3_TEXT);
        $stmt->bindValue(':author', $book->author, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->bindValue(':genre', $book->genre, SQLITE3_TEXT);
        $stmt->bindValue(':yearr', $book->publication_year, SQLITE3_INTEGER);
        return $stmt->execute();
    }

    public function UpdateBookById($book){
        $stmt = "UPDATE Books SET Title='$book->title', Author='$book->author', Genre='$book->genre', Publication_Year='$book->publication_year' WHERE Id = '$book->id'";  
        $this->db->exec($stmt);
    }

    
    public function GetBookByParam($property, $value){
        $stmt = "SELECT * FROM Books WHERE $property='$value'";
        return $this->db->query($stmt);
    }

    public function GetAllBooks(){
        $stmt = "SELECT * FROM Books";  
        return $this->db->query($stmt);
    }
}

?>

