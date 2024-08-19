<?php
include('./includes/header.php');
include('./includes/navbar.php');
?>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<main class="bg-green-50 dark:bg-gray-900 ">
    <section class="bg-green-100 dark:bg-gray-800 mt-1 shadow-lg rounded-lg max-w-screen-xl mx-auto my-8 rounded">
        <div class="bg-green-100 dark:bg-gray-800 py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-12 rounded">
            <dotlottie-player class="mx-auto" src="./home.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>

            <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl"><span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Trailer Track</span> Ultimate Trailer Management System.</h1>
            <p class="mb-8 text-lg font-normal text-gray-600 dark:text-gray-300 lg:text-xl sm:px-16 lg:px-48">"Efficiently Streamline Your Logistics with Our Trailer Management System"</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="login-select.php" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:bg-green-700 dark:hover:bg-green-800 dark:focus:ring-green-800 shadow-md transition-all duration-300">
                    Login
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
                <a href="about.php" class="py-3 px-5 sm:ms-4 text-sm font-medium text-gray-900 dark:text-white bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-green-700 dark:hover:text-green-500 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 shadow-md transition-all duration-300">
                    Know More
                </a>
            </div>
        </div>
        <div class=" bg-green-100 dark:bg-gray-800 py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 rounded">
            <h2 class="mb-4 text-center text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">What We Do.</h2>
            <p class="mb-8 text-lg font-normal text-gray-600 dark:text-gray-300 lg:text-xl sm:px-16 lg:px-48">Our Trailer Management System is designed to manage all aspects of trailer movement within the supply chain. From tracking trailer locations in real-time to optimizing routes and load planning, our system ensures that goods are transported efficiently and securely.</p>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-800 shadow-lg rounded-lg max-w-screen-xl mx-auto my-8">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-12 lg:px-6">
            <div class="max-w-screen-md mx-auto mb-8 lg:mb-16">
                <h2 class="mb-4 text-center text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Why Choose Us</h2>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <div class="p-6 bg-green-100 dark:bg-gray-700 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex justify-center items-center mb-4 w-12 h-12 rounded-full bg-green-200 dark:bg-green-900 lg:h-16 lg:w-16">
                        <img src="./assets/images/inovation.png" alt="innovation" class="w-8 h-8">
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Innovation</h3>
                    <p class="text-gray-600 dark:text-gray-300">We leverage the latest technologies like QR Code based Trailer Management to provide cutting-edge solutions that keep you ahead of the competition.</p>
                </div>
                <div class="p-6 bg-green-100 dark:bg-gray-700 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex justify-center items-center mb-4 w-12 h-12 rounded-full bg-green-200 dark:bg-green-900 lg:h-16 lg:w-16">
                        <img src="./assets/images/reliable.png" alt="reliable" class="w-8 h-8">
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Reliability</h3>
                    <p class="text-gray-600 dark:text-gray-300">Our system is designed for maximum uptime and reliability, ensuring that your operations run smoothly.</p>
                </div>
                <div class="p-6 bg-green-100 dark:bg-gray-700 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                    <div class="flex justify-center items-center mb-4 w-12 h-12 rounded-full bg-green-200 dark:bg-green-900 lg:h-16 lg:w-16">
                        <img src="./assets/images/scalability.png" alt="scalability" class="w-8 h-8">
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Scalability</h3>
                    <p class="text-gray-600 dark:text-gray-300">Our TMS is scalable to meet the needs of businesses of all sizes, from small enterprises to large corporations.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('./includes/footer.php'); ?>