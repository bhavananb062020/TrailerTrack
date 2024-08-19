<?php
include('./includes/header.php');
include('./includes/navbar.php');
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">

        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Profile</span> </h1>


        <div class="w-full pt-5 mx-auto max-w-sm bg-green-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center pb-10">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src=" <?= '..' . $_SESSION['loggedInUser']['image'] ?>" alt="image" />
                <div class="flex flex-col text-xl items-start gap-4">

                    <div>
                        Name : <?= $_SESSION['loggedInUser']['name']  ?>
                    </div>

                    <div>
                        Role : <?= $_SESSION['loggedInUserRole'] ?>
                    </div>


                    <div>
                        Email : <?= $_SESSION['loggedInUser']['email']  ?>
                    </div>


                    <div>
                        Phone : <?= $_SESSION['loggedInUser']['phone']  ?>
                    </div>
                    <div>
                        Created At : <?= $_SESSION['loggedInUser']['created_at']  ?>
                    </div>
                    <!-- QR Code Display -->
                    <div class="mb-5 mx-auto my-3">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-2">Driver QR Code</h3>
                        <img src="<?= '..' . $_SESSION['loggedInUser']['qr'] ?>" style="width:150px;height:150px;" class="mx-auto rounded" alt="Driver QR Code" />
                        <a href="<?= '..' . $_SESSION['loggedInUser']['qr'] ?>" download class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Download QR</a>

                    </div>


                </div>


            </div>
        </div>


    </div>
</div>


<?php include('./includes/footer.php'); ?>