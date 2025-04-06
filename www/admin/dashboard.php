<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else { ?>
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
    <title>Online Library Management System | Admin Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="admin/assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->

    <div class="content-wrapper mx">
      <div class="container mx-auto p-25">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="text-2xl font-bold text-gray-800 mb-6">ADMIN DASHBOARD</h4>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div class="bg-green-100 p-6 rounded-lg shadow-md text-center">
            <i class="fa fa-book fa-5x text-green-500 mb-4"></i>
            <?php
            $sql = "SELECT id from tblbooks ";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $listdbooks = $query->rowCount();
            ?>
            <h3 class="text-2xl font-semibold text-gray-800"><?php echo htmlentities($listdbooks); ?></h3>
            <p class="text-gray-600">Books Listed</p>
          </div>

          <div class="bg-blue-100 p-6 rounded-lg shadow-md text-center">
            <i class="fa fa-bars fa-5x text-blue-500 mb-4"></i>
            <?php
            $sql1 = "SELECT id from tblissuedbookdetails ";
            $query1 = $dbh->prepare($sql1);
            $query1->execute();
            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
            $issuedbooks = $query1->rowCount();
            ?>
            <h3 class="text-2xl font-semibold text-gray-800"><?php echo htmlentities($issuedbooks); ?></h3>
            <p class="text-gray-600">Times Book Issued</p>
          </div>

          <div class="bg-yellow-100 p-6 rounded-lg shadow-md text-center">
            <i class="fa fa-recycle fa-5x text-yellow-500 mb-4"></i>
            <?php
            $status = 1;
            $sql2 = "SELECT id from tblissuedbookdetails where RetrunStatus=:status";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':status', $status, PDO::PARAM_STR);
            $query2->execute();
            $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
            $returnedbooks = $query2->rowCount();
            ?>
            <h3 class="text-2xl font-semibold text-gray-800"><?php echo htmlentities($returnedbooks); ?></h3>
            <p class="text-gray-600">Times Books Returned</p>
          </div>

          <div class="bg-red-100 p-6 rounded-lg shadow-md text-center">
            <i class="fa fa-users fa-5x text-red-500 mb-4"></i>
            <?php
            $sql3 = "SELECT id from tblstudents ";
            $query3 = $dbh->prepare($sql1);
            $query3->execute();
            $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
            $regstds = $query3->rowCount();
            ?>
            <h3 class="text-2xl font-semibold text-gray-800"><?php echo htmlentities($regstds); ?></h3>
            <p class="text-gray-600">Registered Users</p>
          </div>
        </div>

        <div class="grid mb-10 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
          <div class="bg-green-100 p-6 rounded-lg shadow-md text-center">
            <i class="fa fa-user fa-5x text-green-500 mb-4"></i>
            <?php
            $sq4 = "SELECT id from tblauthors ";
            $query4 = $dbh->prepare($sql);
            $query4->execute();
            $results4 = $query4->fetchAll(PDO::FETCH_OBJ);
            $listdathrs = $query4->rowCount();
            ?>
            <h3 class="text-2xl font-semibold text-gray-800"><?php echo htmlentities($listdathrs); ?></h3>
            <p class="text-gray-600">Authors Listed</p>
          </div>

          <div class="bg-blue-100 p-6 rounded-lg shadow-md text-center">
            <i class="fa fa-file-archive fa-5x text-blue-500 mb-4"></i>
            <?php
            $sql5 = "SELECT id from tblcategory ";
            $query5 = $dbh->prepare($sql1);
            $query5->execute();
            $results5 = $query5->fetchAll(PDO::FETCH_OBJ);
            $listdcats = $query5->rowCount();
            ?>
            <h3 class="text-2xl font-semibold text-gray-800"><?php echo htmlentities($listdcats); ?></h3>
            <p class="text-gray-600">Listed Categories</p>
          </div>
        </div>

        <div id="controls-carousel" class="relative w-full rounded-lg" data-carousel="slide">
          <!-- Carousel wrapper -->
          <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img src="assets/img/1.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Slide 1">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
              <img src="assets/img/2.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Slide 2">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img src="assets/img/3.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="Slide 3">
            </div>
          </div>
          <!-- Slider controls -->
          <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
              </svg>
              <span class="sr-only">Previous</span>
            </span>
          </button>
          <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
              <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
              </svg>
              <span class="sr-only">Next</span>
            </span>
          </button>
        </div>
      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->

    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
  </body>

  </html>
<?php } ?>