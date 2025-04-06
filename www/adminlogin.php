<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
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
    <title>Online Library Management System</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">ADMIN LOGIN</h2>
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <form method="post" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Enter Username</label>
                    <input type="text" name="username" autocomplete="off" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" autocomplete="off" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Verification Code</label>
                    <div class="flex items-center space-x-4">
                        <input type="text" name="vercode" maxlength="5" autocomplete="off" required
                            class="w-1/2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                        <img src="captcha.php" alt="Captcha" class="h-10">
                    </div>
                </div>
                <div>
                    <button type="submit" name="login"
                        class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        LOGIN
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
    </script>
</body>

</html>