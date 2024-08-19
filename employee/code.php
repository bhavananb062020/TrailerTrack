<?php

require '../config/function.php';


if (isset($_POST['saveDriver'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $address = validate($_POST['address']);
    $license = validate($_POST['license']);
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;

    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];

        $imgFileTypes = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if ($imgFileTypes != 'jpg' && $imgFileTypes != 'jpeg' && $imgFileTypes != 'png') {
            redirect('services.php', 'Sorry, only JPG, JPEG, and PNG images are supported');
        }

        $path = "../assets/uploads/driver/";
        $imgExt = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $imgExt;

        $finalImage = '/assets/uploads/driver/' . $filename;
    } else {
        $finalImage = NULL;
    }

    if ($name != '' && $email != '' && $phone != '' && $password != '') {
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
            'is_ban' => $is_ban,
            'license' => $license,
            'address' => $address,
            'image' => $finalImage,
        ];

        $inserted_driver = insert('drivers', $data);

        if ($inserted_driver) {
            $driver_id = $inserted_driver['id'];

            // Generate QR code
            $qr_path = "../qrcodes/";
            $qr_filename = "driver_" . $driver_id . ".png";
            $qr_full_path = $qr_path . $qr_filename;

            // Generate QR code (you'll need to include a QR code library)
            require_once('../phpqrcode/qrlib.php'); // Include the QR code library

            // Set QR code size and error correction level
            $qr_size = 10; // This determines the size of the QR code. Increase for a larger code.
            $qr_ecc = 'L'; // Error correction level ('L', 'M', 'Q', 'H'). 'L' is the lowest, 'H' is the highest.

            QRcode::png($driver_id, $qr_full_path, $qr_ecc, $qr_size);

            // Update the driver's record with the QR code path
            $qr_update = [
                'qr' => '/qrcodes/' . $qr_filename
            ];
            update('drivers', $driver_id, $qr_update);

            if ($_FILES['image']['size'] > 0) {
                move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);
            }

            redirect('drivers.php', 'Driver added successfully');
        } else {
            redirect('drivers-create.php', 'Something went wrong!!!');
        }
    } else {
        redirect('drivers-create.php', 'Please fill all the input fields');
    }
}

if (isset($_POST['updateDriver'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $address = validate($_POST['address']);
    $license = validate($_POST['license']);

    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    $driverId = validate($_POST['driverId']);

    $driver = getById('drivers', $driverId);

    if ($driver['status'] != 200) {

        redirect('drivers-edit.php?id=' . $driverId, 'No such id found ');
    }

    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];

        $imgFileTypes = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if ($imgFileTypes != 'jpg' && $imgFileTypes != 'jpeg' && $imgFileTypes != 'png') {
            redirect('driver-edit.php', 'Sorry , only JPG, JPEG and PNG images are supported');
        }

        $deleteImage = '../' . $driver['data']['image'];

        if (file_exists($deleteImage)) {
            unlink($deleteImage);
        }

        $path = "../assets/uploads/driver/";
        $imgExt = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $imgExt;

        $finalImage = '/assets/uploads/driver/' . $filename;
    } else {
        $finalImage = $driver['data']['image'];
    }




    if ($name != '' && $email != '' && $phone != '' && $password != '') {
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
            'address' => $address,
            'license' => $license,
            'is_ban' => $is_ban,
            'image' => $finalImage,
        ];

        $result = update('drivers', $driverId, $data);



        if ($result) {
            if ($_FILES['image']['size'] > 0) {

                move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);
            }

            redirect('drivers-edit.php?id=' . $driverId, 'Driver updated Successfully');
        } else {
            redirect('drivers-edit.php?id=' . $driverId, 'Something went wrong !!!');
        }
    } else {
        redirect('drivers-edit.php', 'Please fill all the input fields');
    }
}

if (isset($_POST['registerTrailer'])) {
    // ID's
    $driverid = validate($_POST['driverid']);
    $emp_id = validate($_POST['emp_id']);

    // Vehicle Details
    $vnumber = validate($_POST['vnumber']);
    $vweight = validate($_POST['vweight']);
    $vmodel = validate($_POST['vmodel']);
    $center = validate($_POST['center']);

    $status = isset($_POST['status']) ? 1 : 0;

    if ($_FILES['vimage']['size'] > 0) {
        $vimage = $_FILES['vimage']['name'];

        $imgFileTypes = strtolower(pathinfo($vimage, PATHINFO_EXTENSION));
        if ($imgFileTypes != 'jpg' && $imgFileTypes != 'jpeg' && $imgFileTypes != 'png') {
            redirect('registerTrailer.php', 'Sorry, only JPG, JPEG, and PNG images are supported');
        }

        $path = "../assets/uploads/vehicle/";
        $imgExt = pathinfo($vimage, PATHINFO_EXTENSION);
        $filename = time() . '.' . $imgExt;

        $finalImage = '/assets/uploads/vehicle/' . $filename;
    } else {
        $finalImage = NULL;
    }

    $driver = getById('drivers', $driverid);

    if ($driver['data']['is_ban'] == 1) {
        redirect('registerTrailer.php', 'Driver is banned !');
    }

    $onging = checkDriverStatus($driverid);

    if ($onging) {
        redirect('registerTrailer.php?id=' . $driverid, 'Ongoing Trailer');
    }

    if ($vnumber != '' && $vweight != '' && $vmodel != '' &&  $driverid != '' && $emp_id != '') {

        $data = [
            'driverid' => $driverid,
            'emp_id' => $emp_id,
            'vnumber' => $vnumber,
            'vweight' => $vweight,
            'vmodel' => $vmodel,
            'center' => $center,
            'vimage' => $finalImage,
        ];



        $result = insert('register', $data);


        if ($result) {

            if ($_FILES['vimage']['size'] > 0) {
                move_uploaded_file($_FILES['vimage']['tmp_name'], $path . $filename);
            }

            redirect('ongoing.php', 'Trailer created successfully');
        } else {
            redirect('registerTrailer.php?id=' . $driverid, 'Something went wrong!!!');
        }
    } else {
        redirect('registerTrailer.php?id=' . $driverid, 'Please fill all the input fields');
    }
}

if (isset($_POST['checkin'])) {

    $register_id = validate($_POST['register_id']);
    $location = validate($_POST['location']);
    $checkin_by = validate($_POST['checkin_by']);
    $checkin_time = validate($_POST['checkin_time']);
    $checkin_weight = validate($_POST['checkin_weight']);



    if ($register_id != '' && $location != '' && $checkin_by != '' && $checkin_time != '' && $checkin_weight != '') {
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'register_id' => $register_id,
            'location' => $location,
            'checkin_by' => $checkin_by,
            'checkin_time' => $checkin_time,
            'checkin_weight' => $checkin_weight,

        ];

        $result = insert('trailer_logs', $data);

        if ($result) {
            redirect('trailerDetails.php?id=' . $register_id, 'Checked In successfully');
        } else {
            redirect('trailerDetails.php?id=' . $register_id, 'Something went wrong!!!');
        }
    } else {
        redirect('trailerDetails.php?id=' . $register_id, 'Please fill all the input fields');
    }
}
if (isset($_POST['checkout'])) {

    $id = validate($_POST['id']);
    $register_id = validate($_POST['register_id']);
    $location = validate($_POST['location']);
    $checkout_by = validate($_POST['checkout_by']);
    $checkout_time = validate($_POST['checkout_time']);
    $checkout_weight = validate($_POST['checkout_weight']);
    $load_status = validate($_POST['load_status']);



    if ($id != '' && $location != '' && $checkout_by != '' && $checkout_time != '' && $checkout_weight != '' && $load_status != '') {

        $data = [
            'location' => $location,
            'checkout_by' => $checkout_by,
            'checkout_time' => $checkout_time,
            'checkout_weight' => $checkout_weight,
            'load_status' => $load_status,
            'status' => 1,
        ];

        $result = update('trailer_logs', $id, $data);

        if ($result) {
            redirect('trailerDetails.php?id=' . $register_id, 'Checked Out successfully');
        } else {
            redirect('trailerDetails.php?id=' . $register_id, 'Something went wrong!!!');
        }
    } else {
        redirect('trailerDetails.php?id=' . $register_id, 'Please fill all the input fields');
    }
}
if (isset($_POST['final_checkout'])) {

    $register_id = validate($_POST['register_id']);
    $location = validate($_POST['location']);
    $checkout_by = validate($_POST['checkout_by']);
    $checkout_time = validate($_POST['checkout_time']);




    if ($register_id != '' && $location != '' && $checkout_by != '' && $checkout_time != '') {

        $data = [
            'location' => $location,
            'checkout_by' => $checkout_by,
            'checkout_time' => $checkout_time,
            'status' => 1,
        ];

        $result = update('register', $register_id, $data);

        if ($result) {
            redirect('trailerDetails.php?id=' . $register_id, 'Final Checked Out successfully');
        } else {
            redirect('trailerDetails.php?id=' . $register_id, 'Something went wrong!!!');
        }
    } else {
        redirect('trailerDetails.php?id=' . $register_id, 'Please fill all the input fields');
    }
}
