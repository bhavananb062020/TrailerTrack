<?php
include('./includes/header.php');
include('./includes/navbar.php');
?>


<div class=" p-4 mt-7 pt-7 text-center dark:text-white">



    <div class="flex flex-col gap-6 lg:flex-row justify-center items-stretch lg:space-x-4 w-full mb-6">
        <a href="login.php" class="flex-1 flex flex-col items-center justify-center text-center mb-3 lg:mb-0 p-6 bg-green-100 border border-gray-200 rounded-lg shadow hover:bg-green-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="./assets/images/users.gif" class="w-32 h-32 rounded-lg" alt="Current Trailers">
            <h1 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Manager/Employee Login</span>
            </h1>

        </a>
        <a href="driverLogin.php" class="flex-1 flex flex-col items-center justify-center text-center p-6 bg-green-100 border border-gray-200 rounded-lg shadow hover:bg-green-200 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <img src="./assets/images/driver.gif" class="w-32 h-32 rounded-lg" alt="Current Trailers">
            <h1 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white">
                <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
                    Driver Login</span>
            </h1>
        </a>

    </div>

</div>



<?php include('./includes/footer.php'); ?>