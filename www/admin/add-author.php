<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $author = $_POST['author'];
        $sql = "INSERT INTO  tblauthors(AuthorName) VALUES(:author)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Author Listed successfully";
            header('location:manage-authors.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-authors.php');
        }
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Add Author</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END -->
        <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-600 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-lg"></div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-lg sm:p-20">
                <div class="max-w-md mx-auto">
                <div>
                    <h4 class="text-2xl font-semibold text-center text-gray-800">Add Author</h4>
                </div>
                <div class="divide-y divide-gray-200">
                    <form class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7" method="post">
                    <div class="relative">
                        <label for="author" class="block text-sm font-medium text-gray-700">Author Name</label>
                        <input id="author" name="author" type="text" required autocomplete="off" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="relative">
                        <button type="submit" name="create" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add
                        </button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>