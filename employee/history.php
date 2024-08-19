<?php
include('./includes/header.php');
include('./includes/navbar.php');
include('./includes/datatable-top.php');
?>
<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">

        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">History</span> </h1>


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
                            <th scope="col" class="px-4 py-3 sm:px-6">Created At</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Trailer Id</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Driver ID</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Registered Employee ID</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">vehicle number</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">vehicle weight</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">vehicle model</th>
                            <th scope="col" class="px-4 py-3 sm:px-6">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $trailers = getHistory();

                        if (mysqli_num_rows($trailers) > 0) {
                            foreach ($trailers as $Item) {
                        ?>
                                <tr>
                                    <td class="px-4 py-4 sm:px-6"> <?= $Item['registered_at']; ?></td>
                                    <td class="px-4 py-4 sm:px-6"> <?= $Item['id']; ?></td>
                                    <td class="px-4 py-4 sm:px-6"><?= $Item['driverid']; ?></td>
                                    <td class="px-4 py-4 sm:px-6"> <?= $Item['emp_id']; ?></td>
                                    <td class="px-4 py-4 sm:px-6"> <?= $Item['vnumber']; ?></td>
                                    <td class="px-4 py-4 sm:px-6"> <?= $Item['vweight']; ?></td>
                                    <td class="px-4 py-4 sm:px-6"> <?= $Item['vmodel']; ?></td>
                                    <td class="px-4 py-4 sm:px-6">
                                        <a href="historyDetails.php?id=<?= $Item['id']; ?>" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">View</a>
                                    </td>
                                </tr>

                            <?php
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<script>
    $(document).ready(function() {
        const table = $("#myTable").DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],
            ],
            ordering: false, // Disable default sorting
            language: {
                info: "", // Remove the default info text
                emptyTable: "No data available in table",
            },
            dom: 'rt<"bottom"i><"clear">',
        });

        // Custom search functionality
        $("#table-search").on("keyup", function() {
            table.search(this.value).draw();
        });

        // Custom length menu functionality
        $("#entries").on("change", function() {
            table.page.len(this.value).draw();
        });

        // Custom pagination
        function updatePagination() {
            const info = table.page.info();
            const totalPages = info.pages;
            const currentPage = info.page + 1;

            const maxPageButtons = 5; // Adjust the number of page buttons displayed
            let paginationHtml = `
            <div class="flex flex-col gap-5 md:flex-row items-center justify-between w-full">
              <div class="text-sm p-5 text-gray-700 dark:text-gray-400">
                Showing ${info.start + 1} to ${info.end} of ${
            info.recordsTotal
          } entries
              </div>

              <div class="inline-flex p-5 xs:mt-0">
                <button id="prev" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ${
                  currentPage === 1 ? "opacity-50 cursor-not-allowed" : ""
                }">Previous</button>
          `;

            // Calculate page button range
            let startPage = Math.max(
                currentPage - Math.floor(maxPageButtons / 2),
                1
            );
            let endPage = startPage + maxPageButtons - 1;
            if (endPage > totalPages) {
                endPage = totalPages;
                startPage = Math.max(endPage - maxPageButtons + 1, 1);
            }

            // Add "..." if there are hidden pages before
            if (startPage > 1) {
                paginationHtml += `<button disabled class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">...</button>`;
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHtml += `
              <button data-page="${i}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ${
              i === currentPage
                ? "text-blue-600 border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                : ""
            }">${i}</button>
            `;
            }

            // Add "..." if there are hidden pages after
            if (endPage < totalPages) {
                paginationHtml += `<button disabled class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">...</button>`;
            }

            paginationHtml += `
                <button id="next" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ${
                  currentPage === totalPages
                    ? "opacity-50 cursor-not-allowed"
                    : ""
                }">Next</button>
              </div>
            </div>
          `;

            $("#pagination").html(paginationHtml);
        }

        $(document).on("click", "#pagination button", function() {
            if ($(this).attr("id") === "prev") {
                table.page("previous").draw("page");
            } else if ($(this).attr("id") === "next") {
                table.page("next").draw("page");
            } else {
                const page = parseInt($(this).data("page")) - 1;
                table.page(page).draw("page");
            }
        });

        table.on("draw", updatePagination);

        // Initial pagination update
        updatePagination();

        // Dark mode toggle
        $("#darkModeToggle").on("change", function() {
            $("body").toggleClass("dark", this.checked);
        });
    });
</script>
<?php include('./includes/footer.php'); ?>