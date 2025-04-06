<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $bookid = intval($_GET['bookid']);
        $sql = "update  tblbooks set BookName=:bookname,CatId=:category,AuthorId=:author,ISBNNumber=:isbn,BookPrice=:price where id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Book info updated successfully";
        header('location:manage-books.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Edit Book</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END -->
        <div class="content-wrapper">
            <div class="container mx-auto px-4">
                <div class="pt-26 flex justify-center">
                    <h4 class="text-2xl font-semibold text-gray-700">Edit Book</h4>
                </div>
                <div class="flex justify-center">
                    <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-6">
                        <h5 class="text-lg font-medium text-gray-800 mb-4">Book Info</h5>
                        <form method="post">
                            <?php
                            $bookid = intval($_GET['bookid']);
                            $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id=:bookid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Book Name<span class="text-red-500">*</span></label>
                                        <input type="text" name="bookname" value="<?php echo htmlentities($result->BookName); ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Category<span class="text-red-500">*</span></label>
                                        <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="<?php echo htmlentities($result->cid); ?>"><?php echo htmlentities($catname = $result->CategoryName); ?></option>
                                            <?php
                                            $status = 1;
                                            $sql1 = "SELECT * from tblcategory where Status=:status";
                                            $query1 = $dbh->prepare($sql1);
                                            $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                            $query1->execute();
                                            $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                            if ($query1->rowCount() > 0) {
                                                foreach ($resultss as $row) {
                                                    if ($catname == $row->CategoryName) {
                                                        continue;
                                                    } else { ?>
                                                        <option value="<?php echo htmlentities($row->id); ?>"><?php echo htmlentities($row->CategoryName); ?></option>
                                            <?php }
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Author<span class="text-red-500">*</span></label>
                                        <select name="author" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="<?php echo htmlentities($result->athrid); ?>"><?php echo htmlentities($athrname = $result->AuthorName); ?></option>
                                            <?php
                                            $sql2 = "SELECT * from tblauthors";
                                            $query2 = $dbh->prepare($sql2);
                                            $query2->execute();
                                            $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                            if ($query2->rowCount() > 0) {
                                                foreach ($result2 as $ret) {
                                                    if ($athrname == $ret->AuthorName) {
                                                        continue;
                                                    } else { ?>
                                                        <option value="<?php echo htmlentities($ret->id); ?>"><?php echo htmlentities($ret->AuthorName); ?></option>
                                            <?php }
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">ISBN Number<span class="text-red-500">*</span></label>
                                        <input type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber); ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                        <p class="text-sm text-gray-500 mt-1">An ISBN is an International Standard Book Number. ISBN must be unique.</p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Price in USD<span class="text-red-500">*</span></label>
                                        <input type="text" name="price" value="<?php echo htmlentities($result->BookPrice); ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                    </div>
                            <?php }
                            } ?>
                            <button type="submit" name="update" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
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