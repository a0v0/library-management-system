<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" /> -->
    <!-- FONT AWESOME STYLE  -->
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet" /> -->
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

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper mt-10">
      <div class="container mx-auto px-4">
        <div class="row py-6">
          <div class="col-md-12 mt-10 text-center">
            <h4 class="text-2xl font-bold text-gray-800">USER DASHBOARD</h4>
          </div>
        </div>

        <div class="flex flex-wrap justify-center gap-6">
          <div class="card text-center p-6 flex-1 max-w-xs">
            <div class="text-blue-500">
              <i class="fa fa-book fa-3x"></i>
            </div>
            <?php
            $sid = $_SESSION['stdid'];
            $sql1 = "SELECT id from tblissuedbookdetails where StudentID=:sid";
            $query1 = $dbh->prepare($sql1);
            $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
            $query1->execute();
            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
            $issuedbooks = $query1->rowCount();
            ?>
            <h3 class="text-xl font-semibold mt-4"><?php echo htmlentities($issuedbooks); ?></h3>
            <p class="text-gray-600">Books Issued</p>
          </div>

          <div class="card text-center p-6 flex-1 max-w-xs">
            <div class="text-yellow-500">
              <i class="fa fa-exclamation-circle fa-3x"></i>
            </div>
            <?php
            $rsts = 0;
            $sql2 = "SELECT id from tblissuedbookdetails where StudentID=:sid and RetrunStatus=:rsts";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
            $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
            $query2->execute();
            $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
            $returnedbooks = $query2->rowCount();
            ?>
            <h3 class="text-xl font-semibold mt-4"><?php echo htmlentities($returnedbooks); ?></h3>
            <p class="text-gray-600">Books Not Returned Yet</p>
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