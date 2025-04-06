<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['issue'])) {
        $studentid = strtoupper($_POST['studentid']);
        $bookid = $_POST['bookdetails'];
        $sql = "INSERT INTO  tblissuedbookdetails(StudentID,BookId) VALUES(:studentid,:bookid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book issued successfully";
            header('location:manage-issued-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-issued-books.php');
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
        <title>Online Library Management System | Issue a new Book</title>
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
        <!-- MENU SECTION END -->
        <div class="bg-gray-100 min-h-screen">
            <div class="container mx-auto px-4">
                <div class="pt-26 pb-6">
                    <div class="text-center">
                        <h4 class="text-2xl font-bold text-gray-700">Issue a New Book</h4>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-lg">
                        <div class="mb-4">
                            <h5 class="text-lg font-semibold text-gray-600">Book Issue Form</h5>
                        </div>
                        <form method="post">
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Student ID<span class="text-red-500">*</span></label>
                                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="studentid" id="studentid" onBlur="getstudent()" autocomplete="off" required />
                            </div>
                            <div class="mb-4">
                                <span id="get_student_name" class="text-gray-600 text-sm"></span>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">ISBN Number<span class="text-red-500">*</span></label>
                                <input class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="booikid" id="bookid" onBlur="getbook()" required />
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2">Book Details</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="bookdetails" id="get_book_name" readonly>
                                </select>
                            </div>
                            <button type="submit" name="issue" id="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Issue Book</button>
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