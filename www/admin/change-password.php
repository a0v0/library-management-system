<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['change'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $username = $_SESSION['alogin'];
    $sql = "SELECT Password FROM admin where UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update admin set Password=:newpassword where UserName=:username";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
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

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }

      .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
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
    <div class="content-wrapper ">
      <div class="container mx-auto px-100">
        <div class="row pt-36 pb-10">
          <div class="col-md-12">
            <h4 class="text-2xl font-bold text-gray-800">Change Admin Password</h4>
          </div>
        </div>
        <?php if ($error) { ?>
          <div class="errorWrap bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
            <strong>ERROR</strong>: <?php echo htmlentities($error); ?>
          </div>
        <?php } else if ($msg) { ?>
          <div class="succWrap bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
            <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?>
          </div>
        <?php } ?>
        <!--LOGIN PANEL START-->
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 mx-auto">
            <div class="panel bg-blue-100 shadow-md rounded-lg">
              <div class="panel-heading bg-blue-500 text-white text-lg font-semibold p-4 rounded-t-lg">
                Change Password
              </div>
              <div class="panel-body p-6">
                <form role="form" method="post" onSubmit="return valid();" name="chngpwd" class="space-y-4">

                  <div class="form-group">
                    <label class="block text-gray-700 font-medium">Current Password</label>
                    <input class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="password" autocomplete="off" required />
                  </div>

                  <div class="form-group">
                    <label class="block text-gray-700 font-medium">Enter Password</label>
                    <input class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="newpassword" autocomplete="off" required />
                  </div>

                  <div class="form-group">
                    <label class="block text-gray-700 font-medium">Confirm Password</label>
                    <input class="form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" name="confirmpassword" autocomplete="off" required />
                  </div>

                  <button type="submit" name="change" class="btn bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Change
                  </button>
                </form>
              </div>
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