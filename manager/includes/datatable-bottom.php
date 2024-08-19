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