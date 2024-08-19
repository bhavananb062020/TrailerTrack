<?php
include('./includes/header.php');
include('./includes/navbar.php');
?>

<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14 text-center">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            <span class="text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">Scanner</span>
        </h1>

        <div class="max-w-lg mx-auto py-8 px-5 bg-green-100 dark:bg-gray-700 rounded-lg">
            <div id="scanner-container" class="mb-4">
                <video id="scanner-video" class="w-full rounded-lg shadow-lg"></video>
            </div>

            <div class="flex justify-center space-x-2 mb-4">
                <button id="toggleCamera" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                    Turn Camera Off
                </button>
                <button id="switchCamera" type="button" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Switch Camera
                </button>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="qr_upload">Upload QR Code</label>
                <input id="qr_upload" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" accept="image/*">
            </div>

            <div id="scanner-result" class="mt-4 text-gray-700 dark:text-gray-300"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.3.1/dist/jsQR.min.js"></script>
<script>
    const video = document.getElementById('scanner-video');
    const resultDiv = document.getElementById('scanner-result');
    const toggleCameraBtn = document.getElementById('toggleCamera');
    const switchCameraBtn = document.getElementById('switchCamera');
    const qrUpload = document.getElementById('qr_upload');
    let stream;
    let facingMode = "environment";
    let scanning = true;
    let hasRedirected = false;

    function startCamera() {
        navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: facingMode
                }
            })
            .then(function(newStream) {
                stream = newStream;
                video.srcObject = stream;
                video.setAttribute("playsinline", true);
                video.play();
                scanning = true;
                hasRedirected = false;
                toggleCameraBtn.textContent = "Turn Camera Off";
                requestAnimationFrame(tick);
            })
            .catch(function(error) {
                console.error("Error accessing the camera:", error);
            });
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        video.srcObject = null;
        scanning = false;
        toggleCameraBtn.textContent = "Turn Camera On";
    }

    toggleCameraBtn.addEventListener('click', function() {
        if (scanning) {
            stopCamera();
        } else {
            startCamera();
        }
    });

    switchCameraBtn.addEventListener('click', function() {
        facingMode = facingMode === "environment" ? "user" : "environment";
        if (scanning) {
            stopCamera();
            startCamera();
        }
    });

    qrUpload.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, img.width, img.height);
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const code = jsQR(imageData.data, imageData.width, imageData.height);
                    if (code) {
                        redirectToDriverEdit(code.data);
                    } else {
                        resultDiv.textContent = "No QR code found in the image.";
                    }
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    function redirectToDriverEdit(data) {
        window.location.href = 'driverDetails.php?id=' + encodeURIComponent(data);
    }

    function tick() {
        if (video.readyState === video.HAVE_ENOUGH_DATA && !hasRedirected) {
            const canvas = document.createElement("canvas");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height);
            if (code) {
                hasRedirected = true;
                stopCamera();
                redirectToDriverEdit(code.data);
            }
        }
        if (scanning && !hasRedirected) {
            requestAnimationFrame(tick);
        }
    }

    startCamera();
</script>

<?php include('./includes/footer.php'); ?>