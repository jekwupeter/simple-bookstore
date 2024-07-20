<?php
require_once 'header.php';
require_once 'db_functions.php';
include 'constants.php';
$db_instance = new SqliteDb(getenv('DB_DATABASE'));
$db = $db_instance->connect();
$db_functions_instance = new BooksDbFunctions($db);
$rows;
if (isset($_GET['search_author']) && !empty($_GET['search_author'])){
    $rows = $db_functions_instance->GetBookByParam(BOOK_AUTHOR, $_GET['search_author']);   
}else if (isset($_GET['search_title']) && !empty($_GET['search_title'])){
    $rows = $db_functions_instance->GetBookByParam(BOOK_TITLE, $_GET['search_title']);   
}else{
    $rows = $db_functions_instance->GetAllBooks();
}
?>
 
<div class="container">
    <div class="row pt-5">
		<div class="col pt-5">
            <div class="row mb-3">
                <div class="col">
                    <h2>Books</h2>
                </div>
                <div class="col">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" id="searchForm">
			            <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search_title" action="<?php echo $_SERVER['PHP_SELF']; ?>" placeholder="Search by Title">
                            <input type="text" class="form-control" name="search_author" action="<?php echo $_SERVER['PHP_SELF']; ?>" placeholder="Search by Author">
                            <button class="btn btn-outline-secondary" type="submit" id="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Publication Year</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
                        if ($rows!="false"){
                        while ($row = $rows->fetchArray()) {   
                            echo '    
                            <th scope="row">'.$row['Id'].'</th>
                            <td>'.$row['Title'].'</td>
                            <td>'.$row['Author'].'</td>
                            <td>'.$row['Genre'].'</td>
                            <td>'.$row['Publication_Year'].'</td>
                            <td colspan="0.5">
                            <div class="btn-group">
								<a href="insert.php?id='.$row['Id'].'" class="btn btn-secondary" role="button" aria-pressed="true">Edit</a>
								<a href="delete.php?id='.$row['Id'].'" class="btn btn-danger" role="button" aria-pressed="true">Delete</a>
							</div>
                            </td> 
                            ';
                            }
                        }else{
                            echo'
                            <td colspan="5" class="table-active">No result found</td>
                            ';
                        }
                        ?>
                    
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$db_instance->close();
require_once 'footer.php';
?>