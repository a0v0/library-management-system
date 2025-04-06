<?php if ($_SESSION['login']) {
?>


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

                <a href="adminlogin.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">Admin Login</a>
                <a href="signup.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">User Signup</a>
                <a href="index.php" class="text-white hover:text-blue-200 transition font-semibold block md:inline-block py-2 md:py-0">User Login</a>
            </div>

        </div>
    </nav>

<?php } ?>