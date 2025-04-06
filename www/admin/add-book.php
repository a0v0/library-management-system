<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $sql = "INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookPrice) VALUES(:bookname,:category,:author,:isbn,:price)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book Listed successfully";
            header('location:manage-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-books.php');
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
        <title>Online Library Management System | Add Book</title>
        <!-- BOOTSTRAP CORE STYLE  -->

        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <div class="bg-gray-100 min-h-screen">
            <div class="container mx-auto px-4">
                <div class="pt-20 pb-6">
                    <div class="text-center">
                        <h4 class="text-2xl font-bold text-gray-700">Add Book</h4>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
                        <div class="mb-4">
                            <h5 class="text-lg font-semibold text-gray-600">Book Info</h5>
                        </div>
                        <form method="post">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Book Name<span class="text-red-500">*</span></label>
                                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="bookname" autocomplete="off" required />
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Category<span class="text-red-500">*</span></label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="category" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    $status = 1;
                                    $sql = "SELECT * from tblcategory where Status=:status";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Author<span class="text-red-500">*</span></label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="author" required>
                                    <option value="">Select Author</option>
                                    <?php
                                    $sql = "SELECT * from tblauthors";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->AuthorName); ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">ISBN Number<span class="text-red-500">*</span></label>
                                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="isbn" required autocomplete="off" />
                                <p class="text-sm text-gray-500">An ISBN is an International Standard Book Number. ISBN must be unique.</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Price<span class="text-red-500">*</span></label>
                                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="price" autocomplete="off" required />
                            </div>
                            <button type="submit" name="add" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Add</button>
                        </form>
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