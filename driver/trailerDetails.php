<?php
include('./includes/header.php');
include('./includes/navbar.php');
date_default_timezone_set('Asia/Kolkata');
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">


        <h1 class="mb-5 pb-5 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400"> Trailer Details</span> </h1>

        <div class="mx-auto">


            <?= alertMessage(); ?>




            <div>
                <?php

                $paramResult = checkParamId('id');

                if (!is_numeric($paramResult)) {
                    echo '<h5>' . $paramResult . '</h5>';
                    return false;
                }

                $register = getById('register', checkParamId('id'));

                if ($register['status'] == 200) {

                    $driverid = $register['data']['driverid'];

                    $driver = getById('drivers', $driverid);
                    if (($driver['status'] == 200)) {




                ?>
                        <div class="bg-green-100 dark:bg-gray-700 rounded-lg p-2 mb-3">

                            <h1 class="mb-5 pb-5 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-4xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Driver details</span> </h1>


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



                            <input type="hidden" required value="<?= $driver['data']['id']; ?>" name="driverid">
                            <input type="hidden" required value="<?= $_SESSION['loggedInUser']['id']  ?>" name="emp_id">


                            <div class="relative mb-3 md:grid md:grid-cols-2 md:gap-6">
                                <div class="relative mb-3">
                                    <input type="text" disabled value="<?= $driver['data']['name']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-black dark:text-white duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Name</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="text" disabled value="<?= $driver['data']['phone']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-black dark:text-white duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Phone</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="text" disabled value="<?= $driver['data']['email']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-black dark:text-white duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Email</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="text" disabled value="<?= $driver['data']['license']; ?>" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-black dark:text-white duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">license</label>
                                </div>
                                <div class="relative mb-3 flex flex-col items-start">
                                    <label class="mb-2 text-sm font-medium text-black dark:text-white">Address</label>
                                    <textarea rows="4" disabled class="block p-2.5 w-full text-sm text-gray-900 bg-green-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Address"><?= $driver['data']['address']; ?></textarea>
                                </div>
                            </div>

                        </div>


                        <div class="bg-green-100 dark:bg-gray-700 rounded-lg p-2 mb-3">

                            <h1 class="mb-5 pb-5 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-4xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                                    Vehicle Details</span> </h1>
                            <div class="mb-5">
                                <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Driver Picture</h3>
                                <img src="<?= '..' . $register['data']['vimage']; ?>" style="width:140px;height:140px;" class="mx-auto rounded" alt="uploaded pic" />
                                <a href="<?= '..' . $register['data']['vimage']; ?>" download class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Download</a>
                            </div>
                            <div class="relative mb-3 md:grid md:grid-cols-2 md:gap-6">

                                <div class="relative mb-3">
                                    <input type="text" disabled name="vnumber" value="<?= $register['data']['vnumber']; ?>" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Vehicle Number</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="text" disabled name="vweight" value="<?= $register['data']['vweight']; ?>" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Vehicle Weigth</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="text" disabled name="vmodel" value="<?= $register['data']['vmodel']; ?>" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Vehicle Model</label>
                                </div>


                            </div>


                            <h1 class="mb-5 pb-5 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-4xl">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Trailer Check In / Check out Details</span>
                            </h1>



                            <div class=" p-6 max-w-md mx-auto rounded-lg">

                                <ol class="relative border-s border-green-700 dark:border-white">
                                    <?php
                                    $trailer_logs = getLogs($register['data']['id']);

                                    if (mysqli_num_rows($trailer_logs) > 0) {
                                        foreach ($trailer_logs as $Item) {
                                    ?>


                                            <li class="mb-10 ms-6">
                                                <span class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-700 dark:bg-green-800">
                                                    <?php if ($Item['status'] == 1) {
                                                        echo ' <svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                                                 </svg>';
                                                    } else {
                                                        echo '<svg class="w-3.5 h-3.5 text-black dark:text-white dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                             <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                                            </svg>';
                                                    } ?>




                                                </span>
                                                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                                    <div class=" mb-3 pl-5  text-left">
                                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Location : <?php if ($Item['location'] == '') {
                                                                                                                                                            echo "Pending";
                                                                                                                                                        } else {
                                                                                                                                                            echo $Item['location'];
                                                                                                                                                        } ?></div>
                                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Checked In At : <?php if ($Item['checkin_time'] == '') {
                                                                                                                                                                echo "Pending";
                                                                                                                                                            } else {
                                                                                                                                                                echo $Item['checkin_time'];
                                                                                                                                                            } ?>

                                                        </div>
                                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Checked In By : <?php if ($Item['checkin_by'] == '') {
                                                                                                                                                                echo "Pending";
                                                                                                                                                            } else {
                                                                                                                                                                echo $Item['checkin_by'];
                                                                                                                                                            } ?>
                                                        </div>
                                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Check In Weight : <?php if ($Item['checkin_weight'] == '') {
                                                                                                                                                                    echo "Pending";
                                                                                                                                                                } else {
                                                                                                                                                                    echo $Item['checkin_weight'];
                                                                                                                                                                } ?>
                                                        </div>
                                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Checked Out At : <?php if ($Item['checkout_time'] == '') {
                                                                                                                                                                    echo "Pending";
                                                                                                                                                                } else {
                                                                                                                                                                    echo $Item['checkout_time'];
                                                                                                                                                                } ?>
                                                        </div>
                                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Check Out By :<?php if ($Item['checkout_by'] == '') {
                                                                                                                                                                echo "Pending";
                                                                                                                                                            } else {
                                                                                                                                                                echo $Item['checkout_by'];
                                                                                                                                                            } ?>
                                                        </div>
                                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Check Out Weight : <?php if ($Item['checkout_weight'] == '') {
                                                                                                                                                                    echo "Pending";
                                                                                                                                                                } else {
                                                                                                                                                                    echo $Item['checkout_weight'];
                                                                                                                                                                } ?>
                                                        </div>
                                                        <div class="text-sm mt-5 font-normal text-black dark:text-white mb-2 dark:text-gray-300"><?php
                                                                                                                                                    if ($Item['status'] == 0) {
                                                                                                                                                    ?>




                                                            <?php    }
                                                            ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </li>



                                    <?php
                                        }
                                    }

                                    ?>

                                </ol>
                            </div>

                            <?php
                            if (mysqli_num_rows($trailer_logs) == 0) {
                                echo "<h1 class='mb-3 mx-auto text-l'>Vehicle not yet Checked In or Checked Out</h1>";
                            }
                            ?>




                            <div class="<?= $register['data']['status'] == 0 ? 'hidden' : '' ?> ">

                                <h1 class="mb-5 pb-5 text-2xl font-extrabold text-gray-900 dark:text-white md:text-3xl lg:text-4xl">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Final Checkout Details</span>
                                </h1>


                                <div class="max-w-sm mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                    <div class=" mb-3 pl-5  text-left">
                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">Location : <?= $register['data']['location'] ?> </div>
                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">checked out by : <?= $register['data']['checkout_by'] ?> </div>
                                        <div class="text-sm font-normal text-black dark:text-white mb-2 dark:text-gray-300">check out time : <?= $register['data']['checkout_time'] ?> </div>
                                    </div>
                                </div>
                            </div>

                        </div>
            </div>
    <?php
                    } else {
                        echo "<h5>" . $driver['message'] . "</h5>";
                    }
                } else {

                    echo "<h5>" . $register['message'] . "</h5>";
                }
    ?>
        </div>

    </div>
</div>

<?php include('./includes/footer.php'); ?>