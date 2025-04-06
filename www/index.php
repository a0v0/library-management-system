<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['login'] != '') {
  $_SESSION['login'] = '';
}
if (isset($_POST['login'])) {
  //code for captach verification
  if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
    echo "<script>alert('Incorrect verification code');</script>";
  } else {
    $email = $_POST['emailid'];
    $password = md5($_POST['password']);
    $sql = "SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      foreach ($results as $result) {
        $_SESSION['stdid'] = $result->StudentId;
        if ($result->Status == 1) {
          $_SESSION['login'] = $_POST['emailid'];
          echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
          echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";
        }
      }
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
  <title>Online Library Management System | </title>
  <!-- BOOTSTRAP CORE STYLE  -->
  <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" /> -->
  <!-- FONT AWESOME STYLE  -->
  <!-- <link href="assets/css/font-awesome.css" rel="stylesheet" /> -->
  <!-- CUSTOM STYLE  -->
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- GOOGLE FONT -->

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

<body>
  <!------MENU SECTION START-->
  <?php include('includes/header.php'); ?>
  <!-- MENU SECTION END-->
  <div class="">
    <div class="">

      <h4 class="header-line">USER LOGIN FORM</h4>


      <div class="main-content mt-20 container mx-auto">
        <h2 class="text-4xl font-bold text-gray-800 mb-8 text-center">Login</h2>
        <div class="max-w-md mx-auto">
          <div class="card">
            <form role="form" method="post">
              <div class=" mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input type="email" id="email" name="emailid" class="w-full p-2 border rounded" required>
              </div>
              <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border rounded" required>
              </div>
              <div class="mb-4">
                <label for="vercode" class="block text-gray-700 font-semibold mb-2">Verification Code</label>
                <input type="text" id="vercode" name="vercode" class="w-full p-2 border rounded" maxlength="5" required>
                <div class="mt-2">
                  <img src="captcha.php" alt="Captcha">
                </div>
              </div>
              <button type="submit" name="login" class="btn-action mx-auto">Login</button>
            </form>


            <p class="text-center mt-4"><a href="user-forgot-password.php" class="text-blue-600 hover:underline">Forgot Password?</a></p>
            <p class="text-center mt-4">Don't have an account? <a href="signup.php" class="text-blue-600 hover:underline">Sign Up</a></p>
          </div>
        </div>
      </div>
      <!---LOGIN PANEL END-->


    </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php'); ?>
  <!-- FOOTER SECTION END-->
  <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
  <!-- BOOTSTRAP SCRIPTS  -->
  <!-- <script src="assets/js/bootstrap.js"></script> -->
  <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>

</body>

</html>