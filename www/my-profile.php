<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $sid = $_SESSION['stdid'];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];

        $sql = "update tblstudents set FullName=:fname,MobileNumber=:mobileno where StudentId=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Your profile has been updated")</script>';
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
        <div class="content-wrapper flex justify-center items-start mt-12">
            <div class="container mx-auto mt-10 px-4 max-w-3xl">
                <div class="row py-4">
                    <div class="col-md-12">
                        <h4 class="text-2xl font-bold text-gray-800 text-center">My Profile</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 mx-auto">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <!-- <div class="text-lg font-semibold text-red-600 mb-4 text-center">
                                My Profile
                            </div> -->
                            <div>
                                <form name="signup" method="post" class="space-y-4">
                                    <?php
                                    $sid = $_SESSION['stdid'];
                                    $sql = "SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from tblstudents where StudentId=:sid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-medium">Student ID:</label>
                                                <p class="text-gray-900"><?php echo htmlentities($result->StudentId); ?></p>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-medium">Reg Date:</label>
                                                <p class="text-gray-900"><?php echo date("F j, Y, g:i a", strtotime($result->RegDate)); ?></p>
                                            </div>

                                            <?php if ($result->UpdationDate != "") { ?>
                                                <div class="mb-4">
                                                    <label class="block text-gray-700 font-medium">Last Updation Date:</label>
                                                    <p class="text-gray-900"><?php echo date("F j, Y, g:i a", strtotime($result->UpdationDate)); ?></p>
                                                </div>
                                            <?php } ?>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-medium">Profile Status:</label>
                                                <?php if ($result->Status == 1) { ?>
                                                    <span class="text-green-600 font-semibold">Active</span>
                                                <?php } else { ?>
                                                    <span class="text-red-600 font-semibold">Blocked</span>
                                                <?php } ?>
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-medium">Enter Full Name</label>
                                                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName); ?>" autocomplete="off" required />
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-medium">Mobile Number:</label>
                                                <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->MobileNumber); ?>" autocomplete="off" required />
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-gray-700 font-medium">Enter Email</label>
                                                <input class="w-full px-4 py-2 border rounded-lg bg-gray-100 cursor-not-allowed" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId); ?>" autocomplete="off" required readonly />
                                            </div>
                                    <?php }
                                    } ?>

                                    <button type="submit" name="update" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                        Update Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>

        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>