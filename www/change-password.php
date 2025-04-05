<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['change'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $email = $_SESSION['login'];
    $sql = "SELECT Password FROM tblstudents WHERE EmailId=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update tblstudents set Password=:newpassword where EmailId=:email";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg = "Your Password succesfully changed";
    } else {
      $error = "Your current password is wrong";
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
    <title>Online Library Management System | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
      html,
      body {
        height: 100%;
        margin: 0;
      }

      body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }

      .main-content {
        flex: 1 0 auto;
        padding: 1rem;
      }

      .nav-gradient {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
      }

      .card {
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 1rem;
        transition: transform 0.3s ease;
      }

      .card:hover {
        transform: translateY(-5px);
      }

      .btn-action {
        background: linear-gradient(to right, #3b82f6, #8b5cf6);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        transition: all 0.3s ease;
        width: 100%;
        max-width: 200px;
      }

      .btn-action:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
      }

      .table-container {
        max-height: 20rem;
        overflow-y: auto;
      }

      footer {
        flex-shrink: 0;
        background: #1f2937;
        color: white;
        padding: 1rem;
        text-align: center;
      }

      @media (max-width: 768px) {
        .main-content {
          padding: 0.5rem;
        }

        .card {
          padding: 0.75rem;
        }

        .grid {
          grid-template-columns: 1fr;
        }

        .table-container table {
          display: block;
          overflow-x: auto;
          white-space: nowrap;
          width: 100%;
        }

        .table-container th,
        .table-container td {
          min-width: 100px;
          padding: 0.5rem;
          font-size: 0.875rem;
        }

        .btn-action {
          font-size: 0.875rem;
        }

        #nav-links {
          display: none;
          flex-direction: column;
          position: absolute;
          top: 100%;
          left: 0;
          width: 100%;
          /* background: linear-gradient(to right, #3b82f6, #8b5cf6); */
          padding: 1rem;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        #nav-links.active {
          display: flex;
        }
      }

      @media (max-width: 480px) {
        h2 {
          font-size: 1.5rem;
        }

        h3 {
          font-size: 1.25rem;
        }

        input {
          font-size: 0.875rem;
          padding: 0.5rem;
        }
      }
    </style>
  </head>
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container mx-auto py-12">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line text-2xl font-bold text-center text-gray-800">User Change Password</h4>
          </div>
        </div>
        <?php if ($error) { ?>
          <div class="errorWrap bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
            <strong>ERROR</strong>: <?php echo htmlentities($error); ?>
          </div>
        <?php } else if ($msg) { ?>
          <div class="succWrap bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4">
            <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?>
          </div>
        <?php } ?>
        <!--LOGIN PANEL START-->
        <div class="flex justify-center mt-8">
          <div class="w-full max-w-md">
            <div class="card shadow-lg rounded-lg">
              <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">Change Password</h2>
              <form role="form" method="post" onSubmit="return valid();" name="chngpwd" class="space-y-4">
                <div class="form-group">
                  <label class="block text-gray-600 font-medium mb-2">Current Password</label>
                  <input class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password" autocomplete="off" required />
                </div>

                <div class="form-group">
                  <label class="block text-gray-600 font-medium mb-2">Enter Password</label>
                  <input class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="newpassword" autocomplete="off" required />
                </div>

                <div class="form-group">
                  <label class="block text-gray-600 font-medium mb-2">Confirm Password</label>
                  <input class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="confirmpassword" autocomplete="off" required />
                </div>

                <button type="submit" name="change" class="btn-action w-full py-2 text-white font-semibold rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">
                  Change
                </button>
              </form>
            </div>
          </div>
        </div>
        <!---LOGIN PANEL END-->
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
  </body>

  </html>
<?php } ?>