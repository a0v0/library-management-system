<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    // code for block student    
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = 0;
        $sql = "update tblstudents set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }



    //code for active students
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = 1;
        $sql = "update tblstudents set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Reg Students</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="w-full flex flex-col justify-center items-center pl-3 pt-30 text-center">
            <div>
                <h3 class="text-4xl font-semibold text-slate-800">Manage Registered Students</h3>
                <p class="text-slate-500">View and manage all registered students in the system.</p>
            </div>
        </div>

        <div class="relative flex flex-col w-11/12 max-w-5xl mx-auto my-10 p-6 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-gray-700 shadow-lg rounded-lg">
            <div class="flex justify-end mb-4">
                <div class="w-full max-w-sm min-w-[200px] relative">
                    <div class="relative">
                        <input
                            id="searchInput"
                            class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
                            placeholder="Search for students..."
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
                <table id="studentsTable" class="w-full text-left table-auto min-w-max border-collapse border border-slate-200 bg-white rounded-lg shadow-md">
                    <thead>
                        <tr>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">#</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Student ID</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Student Name</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Email</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Mobile Number</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Reg Date</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Status</p>
                            </th>
                            <th class="p-4 border border-slate-200 bg-slate-50">
                                <p class="text-sm font-normal leading-none text-slate-500">Action</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * from tblstudents";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <tr class="hover:bg-slate-50 border-b border-slate-200">
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($cnt); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->StudentId); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->FullName); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->EmailId); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities($result->MobileNumber); ?></td>
                                    <td class="p-4 py-5 border border-slate-200"><?php echo htmlentities(date("F j, Y, g:i a", strtotime($result->RegDate))); ?></td>
                                    <td class="p-4 py-5 border border-slate-200">
                                        <?php if ($result->Status == 1) { ?>
                                            <span class="text-green-500">Active</span>
                                        <?php } else { ?>
                                            <span class="text-red-500">Blocked</span>
                                        <?php } ?>
                                    </td>
                                    <td class="p-4 py-5 border border-slate-200">
                                        <?php if ($result->Status == 1) { ?>
                                            <a href="reg-students.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to block this student?');" class="text-red-500 hover:underline">Block</a>
                                        <?php } else { ?>
                                            <a href="reg-students.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to activate this student?');" class="text-blue-500 hover:underline">Activate</a>
                                        <?php } ?>
                                    </td>
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
            function filterTable() {
                const searchInput = document.getElementById("searchInput").value.toLowerCase();
                const tableRows = document.querySelectorAll("#studentsTable tbody tr");
                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchInput) ? "" : "none";
                });
            }

            const rowsPerPage = 5;
            let currentPage = 1;

            function paginateTable() {
                const tableRows = document.querySelectorAll("#studentsTable tbody tr");
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
                const totalRows = document.querySelectorAll("#studentsTable tbody tr").length;
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    paginateTable();
                }
            });

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