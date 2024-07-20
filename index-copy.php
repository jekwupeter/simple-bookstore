<?php
require_once 'header.php';
require_once 'db_functions.php';
require_once 'db_functions.php';
$db_instance = new SqliteDb(getenv('DB_DATABASE'));
$db = $db_instance->connect();
$db_functions_instance = new BooksDbFunctions($db);
$rows = $db_functions_instance->GetAllBooks();
?>
 <script>
        // Function to submit the form when the page loads
        function submitForm() {
            document.getElementById("searchForm").submit();
        
        // Run the function when the window loads
        window.onload = submitForm;

        
</script>

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
                            <input type="text" class="form-control" action="<?php echo $_SERVER['PHP_SELF']; ?>" placeholder="Search by Title or Author">
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>