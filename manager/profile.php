<?php
include('./includes/header.php');
include('./includes/navbar.php');
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center dark:text-white">

        <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Profile</span> </h1>


        <div class="w-full pt-5 mx-auto max-w-md bg-green-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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
                        Work at : <?= $_SESSION['loggedInUser']['center']  ?>


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

                </div>

            </div>
        </div>


    </div>
</div>

<?php include('./includes/footer.php'); ?>