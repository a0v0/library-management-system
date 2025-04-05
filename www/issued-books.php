<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblbooks  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Category deleted scuccessfully ";
        header('location:manage-books.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Issued Books</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- CUSTOM STYLE  -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" /> -->
        <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>

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
        <!-- Material Tailwind Table with Search and Pagination -->
        <div class="w-full flex flex-col justify-center items-center  mt-25 pl-3 text-center">
            <div>
                <h3 class="text-4xl font-semibold text-slate-800">Library Issued Books</h3>
                <p class="text-slate-500">Track issued books and their return status.</p>
            </div>
        </div>

        <div class="relative flex flex-col w-11/12 max-w-5xl mx-auto my-10 p-6 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-gray-700 shadow-lg rounded-lg">
            <div class="flex justify-end mb-4">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    <div class="relative">
                        <input
                            id="searchInput"
                            class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Search for books..."
                            onkeyup="filterTable()" />
                        <button
                            class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mx-auto my-6 w-full">
                <table id="issuedBooksTable" class="w-full text-left table-auto min-w-max border-collapse border border-slate-200 bg-white rounded-lg shadow-md">
                    <thead>
                        <tr>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">#</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Book Name</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">ISBN</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Issued Date</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Return Date</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Fine (USD)</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sid = $_SESSION['stdid'];
                        $sql = "SELECT tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.id as rid, tblissuedbookdetails.fine 
            FROM tblissuedbookdetails 
            JOIN tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentId 
            JOIN tblbooks ON tblbooks.id = tblissuedbookdetails.BookId 
            WHERE tblstudents.StudentId = :sid 
            ORDER BY tblissuedbookdetails.id DESC";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <tr class="hover:bg-slate-50 border-b border-slate-200">
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($cnt); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->BookName); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->IssuesDate); ?></td>
                                    <td class="p-4 py-5 border border-slate-200">
                                        <?php if ($result->ReturnDate == "") { ?>
                                            <span class="text-red-500">Not Returned Yet</span>
                                        <?php } else {
                                            echo htmlentities($result->ReturnDate);
                                        } ?>
                                    </td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->fine); ?></td>
                                </tr>
                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center px-4 py-3">
                <div class="text-sm text-slate-100">
                    Showing <b id="currentPage">1</b> of <b id="totalPages">1</b>
                </div>
                <div class="flex space-x-1">
                    <button id="prevPage" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                        Prev
                    </button>
                    <button id="nextPage" class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <script>
            // JavaScript for Search Functionality
            function filterTable() {
                const searchInput = document.getElementById("searchInput").value.toLowerCase();
                const tableRows = document.querySelectorAll("#issuedBooksTable tbody tr");
                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchInput) ? "" : "none";
                });
            }

            // JavaScript for Pagination
            const rowsPerPage = 5;
            let currentPage = 1;

            function paginateTable() {
                const tableRows = document.querySelectorAll("#issuedBooksTable tbody tr");
                const totalRows = tableRows.length;
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                document.getElementById("totalPages").textContent = totalPages;

                tableRows.forEach((row, index) => {
                    row.style.display = (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) ? "" : "none";
                });

                document.getElementById("currentPage").textContent = currentPage;
                document.getElementById("prevPage").disabled = currentPage === 1;
                document.getElementById("nextPage").disabled = currentPage === totalPages;
            }

            document.getElementById("prevPage").addEventListener("click", () => {
                if (currentPage > 1) {
                    currentPage--;
                    paginateTable();
                }
            });

            document.getElementById("nextPage").addEventListener("click", () => {
                const totalRows = document.querySelectorAll("#issuedBooksTable tbody tr").length;
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    paginateTable();
                }
            });

            // Initialize Pagination
            paginateTable();
        </script>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>
<?php } ?>