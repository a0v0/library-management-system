<?php if ($_SESSION['alogin']) { ?>
    <nav class="bg-gradient-to-r from-blue-500 to-purple-500 mb-10 shadow-lg p-4 fixed left-0 w-full z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-white text-3xl font-bold">LibraryHub Admin</a>
            <div class="md:hidden">
                <button onclick="toggleMenu()" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <div id="nav-links" class="hidden md:flex space-x-6 items-center">
                <a href="dashboard.php" class="text-white hover:text-blue-200 transition font-semibold">Dashboard</a>
                <div class="relative group inline-block">
                    <a href="#" class="text-white hover:text-blue-200 transition font-semibold">Categories</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md">
                        <a href="add-category.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Add Category</a>
                        <a href="manage-categories.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Manage Categories</a>
                    </div>
                </div>
                <div class="relative group inline-block">
                    <a href="#" class="text-white hover:text-blue-200 transition font-semibold">Authors</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md">
                        <a href="add-author.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Add Author</a>
                        <a href="manage-authors.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Manage Authors</a>
                    </div>
                </div>
                <div class="relative group inline-block">
                    <a href="#" class="text-white hover:text-blue-200 transition font-semibold">Books</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md">
                        <a href="add-book.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Add Book</a>
                        <a href="manage-books.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Manage Books</a>
                    </div>
                </div>
                <div class="relative group inline-block">
                    <a href="#" class="text-white hover:text-blue-200 transition font-semibold">Issue Books</a>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md">
                        <a href="issue-book.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Issue New Book</a>
                        <a href="manage-issued-books.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Manage Issued Books</a>
                    </div>
                </div>
                <a href="reg-students.php" class="text-white hover:text-blue-200 transition font-semibold">Reg Students</a>
                <a href="change-password.php" class="text-white hover:text-blue-200 transition font-semibold">Change Password</a>
                <a href="logout.php" class="text-white bg-red-600 px-4 py-2 rounded-full hover:bg-red-700 transition font-semibold">Logout</a>
            </div>
        </div>
    </nav>
<?php } else { ?>
    <nav class="bg-gradient-to-r from-blue-500 to-purple-500 mb-10 shadow-lg p-4 fixed left-0 w-full z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="index.php" class="text-white text-3xl font-bold">LibraryHub</a>
            <div class="md:hidden">
                <button onclick="toggleMenu()" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <div id="nav-links" class="hidden md:flex space-x-6 items-center">
                <a href="adminlogin.php" class="text-white hover:text-blue-200 transition font-semibold">Admin Login</a>
                <a href="signup.php" class="text-white hover:text-blue-200 transition font-semibold">User Signup</a>
                <a href="index.php" class="text-white hover:text-blue-200 transition font-semibold">User Login</a>
            </div>
        </div>
    </nav>
<?php } ?>

<script>
    function toggleMenu() {
        const navLinks = document.getElementById("nav-links");
        navLinks.classList.toggle("hidden");
    }
</script>