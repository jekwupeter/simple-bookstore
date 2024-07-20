<?php
require_once 'db_functions.php';
$db_instance = new SqliteDb(getenv('DB_DATABASE'));
$db = $db_instance->connect();
$db_functions_instance = new BooksDbFunctions($db);
if (isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    $result = $db_functions_instance->deleteBookById($id);
    $db_instance->close();
    if ($result !="false"){
        echo "<script>alert('Book deleted successfully'); window.location.href='index.php';</script>>";
    }else{
        echo "Failed to delete Book.";
        exit;
    }
}
?>