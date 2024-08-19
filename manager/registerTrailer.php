<?php
include('./includes/header.php');
include('./includes/navbar.php');
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">
        <div class="px-3 mx-auto py-3 flex items-center">

            <a href="register.php" class=" text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Back</a>

        </div>

        <h1 class="mb-5 pb-5 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Register Trailer</span> </h1>

        <div class="mx-auto">


            <?= alertMessage(); ?>

            <form action="code.php" method="POST" enctype="multipart/form-data">


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
                            <div class="relative mb-3 max-w-sm mx-auto">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Vehicle Picture</label>
                                <input type="file" name="vimage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                            </div>
                            <div class="relative mb-3 md:grid md:grid-cols-2 md:gap-6">

                                <div class="relative mb-3">
                                    <input type="text" name="vnumber" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Vehicle Number</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="text" name="vweight" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Vehicle Weigth</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="text" name="vmodel" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Vehicle Model</label>
                                </div>
                                <div class="relative mb-3">
                                    <input type="hidden" name="center" value="<?= $_SESSION['loggedInUser']['center']  ?>" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <label class="absolute hidden text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-green-100 dark:bg-gray-700 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Center Name</label>
                                </div>


                            </div>

                            <div>
                                <button type="submit" name="registerTrailer" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Register</button>
                            </div>

                        </div>
                </div>
            <?php
                    } else {

                        echo "<h5>" . $driver['message'] . "</h5>";
                    }
            ?>
            </form>
        </div>

    </div>
</div>
<?php include('./includes/footer.php'); ?>