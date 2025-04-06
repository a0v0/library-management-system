<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $fine = $_POST['fine'];
        $rstatus = 1;
        $sql = "update tblissuedbookdetails set fine=:fine,RetrunStatus=:rstatus where id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "Book Returned successfully";
        header('location:manage-issued-books.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Issued Book Details</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script>
            // function for get student name
            function getstudent() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_student.php",
                    data: 'studentid=' + $("#studentid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_student_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }

            //function for book details
            function getbook() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_book.php",
                    data: 'bookid=' + $("#bookid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_book_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
        <style type="text/css">
            .others {
                color: red;
            }
        </style>


    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="bg-gray-100 min-h-screen">
            <div class="container mx-auto px-4">
                <div class="pt-26 pb-6">
                    <div class="text-center">
                        <h4 class="text-2xl font-bold text-gray-700">Issued Book Details</h4>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg">
                        <div class="mb-4">
                            <h5 class="text-lg font-semibold text-gray-600">Book Details</h5>
                        </div>
                        <form method="post">
                            <?php
                            $rid = intval($_GET['rid']);
                            $sql = "SELECT tblstudents.FullName,tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.RetrunStatus from tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblissuedbookdetails.id=:rid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Student Name:</label>
                                        <p class="text-gray-600"><?php echo htmlentities($result->FullName); ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Book Name:</label>
                                        <p class="text-gray-600"><?php echo htmlentities($result->BookName); ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">ISBN:</label>
                                        <p class="text-gray-600"><?php echo htmlentities($result->ISBNNumber); ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Book Issued Date:</label>
                                        <p class="text-gray-600"><?php echo htmlentities($result->IssuesDate); ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Book Returned Date:</label>
                                        <p class="text-gray-600">
                                            <?php echo $result->ReturnDate == "" ? "Not Returned Yet" : htmlentities($result->ReturnDate); ?>
                                        </p>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Fine (in USD):</label>
                                        <?php if ($result->fine == "") { ?>
                                            <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="fine" id="fine" required />
                                        <?php } else { ?>
                                            <p class="text-gray-600"><?php echo htmlentities($result->fine); ?></p>
                                        <?php } ?>
                                    </div>
                                    <?php if ($result->RetrunStatus == 0) { ?>
                                        <button type="submit" name="return" id="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Return Book</button>
                            <?php }
                                }
                            } ?>
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