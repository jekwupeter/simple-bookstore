<?php
require_once 'header.php';
require_once 'db_functions.php';
require_once 'book_entity.php';
require_once 'constants.php';
$update = isset($_GET['id']);
if ($update){
    $db_instance = new SqliteDb(getenv('DB_DATABASE'));
    $db = $db_instance->connect();
    $db_functions_instance = new BooksDbFunctions($db);
    $rows = $db_functions_instance->GetBookByParam(BOOK_ID, $_GET['id']);
    $row = $rows->fetchArray();
}
?>

<div class="container">
    <div class="row">
		<div class="col pt-5">
			<h2>Manage Books</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <div class="row mb-3" has-validation>
                        <label for="title" class="col-lg-2 col-form-label col-form-label-lg">Title</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php if ($update){ echo $row['Title'];} ?>" class="form-control form-control-lg" id="title" name="title" placeholder="Title" required>
                        </div>
                    </div>
                </div>
                <div class="form-group" has-validation>
                    <div class="row mb-3">
                        <label for="author" class="col-lg-2 col-form-label col-form-label-lg">Author</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php if ($update){ echo $row['Author'];} ?>" class="form-control form-control-lg" id="author" name ="author" placeholder="Author" required>
                        </div>
                    </div>
                </div>
                <div class="form-group" has-validation>
                    <div class="row mb-3">
                        <label for="genre" class="col-lg-2 col-form-label col-form-label-lg">Genre</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?php if ($update){ echo $row['Genre'];} ?>" class="form-control form-control-lg" id="genre" name="genre" placeholder="Genre" required>
                        </div>
                    </div>
                </div>
                <div class="form-group" has-validation>
                    <div class="row mb-3">
                        <label for="publication_year" class="col-lg-2 col-form-label col-form-label-lg">Publication Year</label>
                        <div class="col-sm-10">
                            <input type="date" value="<?php if ($update){ echo $row['Publication Year'];} ?>" class="form-control form-control-lg" id="publication_year" name="publication_year" required>
                        </div>                    
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr>
            <?php 
                if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['genre'])){
                    $db_instance = new SqliteDb(getenv('DB_DATABASE'));
                    $db = $db_instance->connect();
                    $db_functions_instance = new BooksDbFunctions($db);
                    $book = new Book();
                    $book->setTitle(htmlspecialchars(html_entity_decode($_POST['title'])));
                    $book->setAuthor(htmlspecialchars(html_entity_decode($_POST['author'])));
                    $book->setPublicationYear(htmlspecialchars($_POST['publication_year']));
                    $book->setGenre(htmlspecialchars(html_entity_decode($_POST['genre'])));
                    $result = $db_functions_instance->AddBook($book);
                    $db_instance->close();
                    if ($result !="false"){
                        echo "<script>alert('Book added successfully'); window.location.href='index.php';</script>>";
                    }else{
                        echo "Failed to add Book.";
                        exit;
                    }
                    
                }
                
            ?>
		</div>
    </div>
    
</div>
<?php
require_once 'footer.php';
?>
