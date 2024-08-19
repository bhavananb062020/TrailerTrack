<?php

require '../config/function.php';

$paraResult = checkParamId('id');

if (is_numeric($paraResult)) {
    $driverId = validate($paraResult);

    $driver = getById('drivers', $driverId);
    if ($driver['status'] == 200) {
        // Get the QR code path before deleting the driver
        $qrPath = "../" . $driver['data']['qr'];

        $driverDeleteRes = deleteQuery('drivers', $driverId);
        if ($driverDeleteRes) {
            // If driver deletion was successful, delete the QR code file
            if (file_exists($qrPath)) {
                unlink($qrPath);
            }

            redirect('drivers.php', 'Driver and associated QR code deleted successfully');
        } else {
            redirect('drivers.php', 'Something Went Wrong while deleting the driver!');
        }
    } else {
        redirect('drivers.php', $driver['message']);
    }
} else {
    redirect('drivers.php', $paraResult);
}
