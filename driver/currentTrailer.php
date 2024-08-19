<?php
include('./includes/header.php');
include('./includes/navbar.php');
?>


<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">


        <h1 class="mb-5 pb-5 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400"> Trailer Details</span> </h1>

        <?php
        $trailers = getRegisteredById($_SESSION['loggedInUser']['id']);

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

                </span>
            </h1>


        <?php
        }

        ?>

    </div>
</div>

<?php include('./includes/footer.php'); ?>