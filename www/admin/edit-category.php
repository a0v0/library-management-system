<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];
        $catid = intval($_GET['catid']);
        $sql = "update  tblcategory set CategoryName=:category,Status=:status where id=:catid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':catid', $catid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg'] = "Brand updated successfully";
        header('location:manage-categories.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Edit Categories</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="bg-gray-100 min-h-screen">
            <div class="container mx-auto px-4">
                <div class="pt-25 pb-6">
                    <div class="text-center">
                        <h4 class="text-2xl font-bold text-gray-700">Edit Category</h4>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md">
                        <div class="mb-4">
                            <h5 class="text-lg font-semibold text-gray-600">Category Info</h5>
                        </div>
                        <form method="post">
                            <?php
                            $catid = intval($_GET['catid']);
                            $sql = "SELECT * from tblcategory where id=:catid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':catid', $catid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                            ?>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Category Name</label>
                                        <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="category" value="<?php echo htmlentities($result->CategoryName); ?>" required />
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Status</label>
                                        <?php if ($result->Status == 1) { ?>
                                            <div class="flex items-center mb-2">
                                                <input type="radio" name="status" id="status-active" value="1" checked class="mr-2">
                                                <label for="status-active" class="text-gray-600">Active</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" name="status" id="status-inactive" value="0" class="mr-2">
                                                <label for="status-inactive" class="text-gray-600">Inactive</label>
                                            </div>
                                        <?php } else { ?>
                                            <div class="flex items-center mb-2">
                                                <input type="radio" name="status" id="status-inactive" value="0" checked class="mr-2">
                                                <label for="status-inactive" class="text-gray-600">Inactive</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" name="status" id="status-active" value="1" class="mr-2">
                                                <label for="status-active" class="text-gray-600">Active</label>
                                            </div>
                                        <?php } ?>
                                    </div>
                            <?php }
                            } ?>
                            <button type="submit" name="update" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Update</button>
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