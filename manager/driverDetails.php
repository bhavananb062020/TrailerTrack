<?php
include('./includes/header.php');
include('./includes/navbar.php');
include('./includes/datatable-top.php');
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">
        <div class="px-3 mx-auto py-3 flex items-center">

            <a href="drivers.php" class=" text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Back</a>

        </div>

        <h1 class="mb-5 pb-5 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Driver Details</span> </h1>


        <div class=" mx-auto bg-green-100 dark:bg-gray-700 rounded-lg p-3 md:p-5 my-10">

            <?= alertMessage(); ?>



            <div>
                <?php

                $paramResult = checkParamId('id');

                if (!is_numeric($paramResult)) {
                    echo '<h5>' . $paramResult . '</h5>';
                    return false;
                }

                $driver = getById('drivers', checkParamId('id'));

                if ($driver['status'] == 200) {
                ?>
                    <div class="flex gap-3 items-center justify-center mb-5">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Driver Picture</h3>
                            <img src="<?= '../' . $driver['data']['image']; ?>" style="width:140px;height:140px;" class="mx-auto rounded" alt="uploaded pic" />
                            <a href="<?= '..' . $driver['data']['image']; ?>" download class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Download</a>
                        </div>

                        <!-- QR Code Display -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Driver QR Code</h3>
                            <img src="<?= '..' . $driver['data']['qr']; ?>" style="width:140px;height: 140px;" class="mx-auto rounded" alt="Driver QR Code" />
                            <a href="<?= '..' . $driver['data']['qr']; ?>" download class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Download QR</a>

                        </div>
                    </div>

                    <input type="hidden" required value="<?= $driver['data']['id']; ?>" name="driverId">
                    <div class="relative mb-3 md:grid md:grid-cols-2 md:gap-6">
                        <div class="relative mb-3">
                            <input type="text" id="name" disabled name="name" required value="<?= $driver['data']['name']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="name" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Name</label>
                        </div>
                        <div class="relative mb-3">
                            <input type="text" id="phone" disabled name="phone" value="<?= $driver['data']['phone']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="phone" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Phone</label>
                        </div>
                        <div class="relative mb-3">
                            <input type="text" id="email" disabled name="email" value="<?= $driver['data']['email']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="email" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email</label>
                        </div>
                        <div class="relative mb-3">
                            <input type="text" id="license" disabled name="license" value="<?= $driver['data']['license']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="license" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">license</label>
                        </div>
                        <div class="relative mb-3 flex flex-col items-start">
                            <label class="mb-2 text-sm font-medium text-black dark:text-white">Address</label>
                            <textarea rows="4" disabled class="block p-2.5 w-full text-sm text-gray-900 bg-green-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address"><?= $driver['data']['address']; ?></textarea>
                        </div>
                    </div>







                    <?php
                    $trailers = getRegisteredById($driver['data']['id']);

                    if (mysqli_num_rows($trailers) > 0) {
                        foreach ($trailers as $Item) {
                    ?>

                            <div class="p-4 max-w-md mx-auto bg-green-200 border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                <div class=" mb-3 pl-5  text-left">
                                    <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">
                                        <h2 class="mb-5 pb-5 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-4xl">
                                            <span class="text-transparent text-2xl bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Ongoing Trailer</span>
                                        </h2>

                                        <p class="mb-3 text-xl">
                                            Driver Id : <?= $Item['driverid']; ?>

                                        </p>
                                        <p class="mb-3 text-xl">
                                            Registered Employee Id : <?= $Item['emp_id']; ?>
                                        </p>
                                        <p class="mb-3 text-xl">
                                            Vehicle Number : <?= $Item['vnumber']; ?>
                                        </p>
                                        <p class="mb-3 text-xl">
                                            Vehicle Weight : <?= $Item['vweight']; ?>
                                        </p>
                                        <p class="mb-3 text-xl">
                                            Vehicle Model : <?= $Item['vmodel']; ?>
                                        </p>
                                        <p class="mb-3 text-xl">
                                            <a href="trailerDetails.php?id=<?= $Item['id']; ?>" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">View</a>
                                        </p>

                                    </div>
                                </div>
                            </div>


                        <?php
                        }
                    } else {
                        ?>

                        <h1 class="mb-5 pb-5 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-4xl">
                            <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">The Trailer is Not Registered
                                <br>
                                <a href="registerTrailer.php?id=<?= $driver['data']['id'] ?>" type="button" class="text-white mt-5 bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Register</a>

                            </span>
                        </h1>


                    <?php
                    }

                    ?>




                    <h1 class="mb-5 pb-5 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-4xl">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">History</span>
                    </h1>

                    <div class="bg-green-200 dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
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

                                    $trailers = getHistoryById($driver['data']['id']);

                                    if (mysqli_num_rows($trailers) > 0) {
                                        foreach ($trailers as $Item) {
                                    ?>
                                            <tr>
                                                <td class="px-4 py-4 sm:px-6"> <?= $Item['id']; ?></td>
                                                <td class="px-4 py-4 sm:px-6"><?= $Item['driverid']; ?></td>
                                                <td class="px-4 py-4 sm:px-6"> <?= $Item['emp_id']; ?></td>
                                                <td class="px-4 py-4 sm:px-6"> <?= $Item['vnumber']; ?></td>
                                                <td class="px-4 py-4 sm:px-6"> <?= $Item['vweight']; ?></td>
                                                <td class="px-4 py-4 sm:px-6"> <?= $Item['vmodel']; ?></td>
                                                <td class="px-4 py-4 sm:px-6">
                                                    <a href="trailerDetails.php?id=<?= $Item['id']; ?>" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">View</a>
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No Record Found</td>
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
        <?php
                } else {

                    echo "<h5>" . $driver['message'] . "</h5>";
                }
        ?>

        </div>

    </div>
</div>
<?php include('./includes/datatable-bottom.php'); ?>
<?php include('./includes/footer.php'); ?>