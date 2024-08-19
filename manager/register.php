<?php
include('./includes/header.php');
include('./includes/navbar.php');
include('./includes/datatable-top.php');
?>
<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">

        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Avilable Drivers List</span> </h1>


        <?= alertMessage(); ?>

        <div class="bg-green-100 dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                    <div class="custom-length-menu mb-4 sm:mb-0">
                        <label for="entries" class="sr-only">Show entries</label>
                        <select id="entries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="10">Show 10 entries</option>
                            <option value="25">Show 25 entries</option>
                            <option value="50">Show 50 entries</option>
                            <option value="-1">Show All entries</option>
                        </select>
                    </div>
                    <div id="tableSearch" class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" />
                    </div>
                </div>

                <table id="myTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 display nowrap">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 sm:px-6">Name</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Driver Id</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Email</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Phone</th>

                            <th scope="col" class="px-4 py-3 sm:px-6">Is Ban</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $drivers = getAll('drivers');

                        if (mysqli_num_rows($drivers) > 0) {
                            foreach ($drivers as $Item) {
                                if (checkDriverStatus($Item['id'])) {
                                    continue;
                                } else {


                        ?>
                                    <tr>
                                        <td class="px-4 py-4 sm:px-6"><?= $Item['name']; ?></td>
                                        <td class="px-4 py-4 sm:px-6"> <?= $Item['id']; ?></td>
                                        <td class="px-4 py-4 sm:px-6"> <?= $Item['email']; ?></td>
                                        <td class="px-4 py-4 sm:px-6"> <?= $Item['phone']; ?></td>
                                        <td class="px-4 py-4 sm:px-6"><?= $Item['is_ban'] == 1 ? 'Banned' : 'Active'; ?></td>
                                        <td class="px-4 py-4 sm:px-6">
                                            <a href="registerTrailer.php?id=<?= $Item['id']; ?>" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Register</a>
                                        </td>
                                    </tr>

                            <?php
                                }
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">No Record Found</td>
                            </tr>

                        <?php
                        }

                        ?>

                        <!-- Add more rows as needed -->

                    </tbody>
                </table>

                <div>
                    <nav id="pagination" aria-label="Table navigation" class="flex flex-col gap-5 md:flex-row justify-between items-center mt-4">
                        <!-- Pagination will be inserted here -->
                    </nav>
                </div>

            </div>
        </div>




    </div>
</div>

<?php include('./includes/datatable-bottom.php'); ?>
<?php include('./includes/footer.php'); ?>