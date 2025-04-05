<!-- <div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">

                <img src="assets/img/logo.png" />
            </a>

        </div>
        <?php if ($_SESSION['login']) {
        ?>
            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">LOG ME OUT</a>
            </div>
        <?php } ?>
    </div>
</div> -->
<!-- LOGO HEADER END-->
<?php if ($_SESSION['login']) {
?>
    <!-- <section class="menu-section">
        <div class="">
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <?php if ($_SESSION['login']) {
                            ?>
                                <div class="right-div">
                                    <a href="logout.php" class="btn btn-danger pull-right">LOG ME OUT</a>
                                </div>
                            <?php } ?>
                            <li><a href="dashboard.php" class="menu-top-active">DASHBOARD</a></li>


                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php">My Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php">Change Password</a></li>
                                </ul>
                            </li>
                            <li><a href="issued-books.php">Issued Books</a></li>


                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </section> -->


    <nav class="nav-gradient mb-10 shadow-lg p-4 fixed  left-0 w-full z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-white text-3xl font-bold">LibraryHub</a>
            <div class="md:hidden">
                <button onclick="toggleMenu()" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <div id="nav-links" class="space-x-6 md:flex md:items-center">

                <a href="dashboard.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Dashboard</a>
                <div class="relative group inline-block">
                    <a href="#" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Account</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md ">
                        <a href="my-profile.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">My Profile</a>
                        <a href="change-password.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Change Password</a>
                    </div>
                </div>
                <a href="issued-books.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Issued Books</a>
                <a href="logout.php" class="text-white bg-red-600 px-4 py-2 rounded-full hover:bg-red-700 transition font-semibold block md:inline-block">Logout</a>
            </div>

        </div>
    </nav>


<?php } else { ?>


    <nav class="nav-gradient mb-10 shadow-lg p-4 fixed  left-0 w-full z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-white text-3xl font-bold">LibraryHub</a>
            <div class="md:hidden">
                <button onclick="toggleMenu()" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <div id="nav-links" class="space-x-6 md:flex md:items-center">
                <!-- <a href="index.html" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Dashboard</a>
                <a href="books.html" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Book Management</a>
                <a href="search.html" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Search & Browse</a>
                <a href="members.html" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Member Management</a>
                <a href="borrow-return.html" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Borrow & Return</a>
                <a href="reports.html" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Reports</a>
                <a href="contact.html" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Contact</a>
                <div id="profile-link" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0"></div>
                <div id="signup-link" class="text-white bg-blue-600 px-4 py-2 rounded-full hover:bg-blue-700 transition font-semibold block md:inline-block">
                    <a href="signup.html">Signup</a>
                </div> -->

                <a href="adminlogin.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Admin Login</a>
                <a href="signup.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">User Signup</a>
                <a href="index.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">User Login</a>
            </div>

        </div>
    </nav>

<?php } ?>