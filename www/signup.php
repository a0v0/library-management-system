<?php
session_start();
include('includes/config.php');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'includes/email.php';

if (isset($_POST['signup'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {
        $StudentId = uniqid();
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = 1;
        $sql = "INSERT INTO  tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            sendEmail($email, "Registration Successful", "Dear $fname,\n\nYour registration was successful. Your Student ID is $StudentId.\n\nThank you!");
            echo '<script>
                alert("Your Registration was successful and your student ID is ' . $StudentId . '");
                window.location.href = "index.php";
            </script>';
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Student Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#emailid").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>

</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div>
        <h2 class="mt-22 text-center text-3xl font-extrabold text-gray-900">User Signup</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Fill in the details below to create your account.
        </p>
    </div>
    <div class="mt-6 flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full ">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <form class="mt-8 space-y-6" name="signup" method="post" onSubmit="return valid();" role="form">
                    <div class=" -space-y-px">
                        <div class="mb-4">
                            <label for="fullanme" class="block text-sm font-semibold text-gray-700">Full Name</label>
                            <input id="fullanme" name="fullanme" type="text" autocomplete="off" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:ring-1 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="mobileno" class="block text-sm font-semibold text-gray-700">Mobile Number</label>
                            <input id="mobileno" name="mobileno" type="text" maxlength="10" autocomplete="off" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:ring-1 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="emailid" class="block text-sm font-semibold text-gray-700">Email</label>
                            <input id="emailid" name="email" type="email" onBlur="checkAvailability()" autocomplete="off" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:ring-1 sm:text-sm">
                            <span id="user-availability-status" class="text-xs text-gray-500"></span>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <input id="password" name="password" type="password" autocomplete="off" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:ring-1 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="confirmpassword" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                            <input id="confirmpassword" name="confirmpassword" type="password" autocomplete="off" required
                                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:ring-1 sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="vercode" class="block text-sm font-semibold text-gray-700">Verification Code</label>
                            <div class="flex items-center">
                                <input id="vercode" name="vercode" type="text" maxlength="5" autocomplete="off" required
                                    class="appearance-none rounded-md relative block w-1/2 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:ring-1 sm:text-sm">
                                <img src="captcha.php" alt="Captcha" class="ml-4">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" name="signup"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Register Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>

</html>