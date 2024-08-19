<?php

require './config/function.php';

if (isset($_POST['loginDriver'])) {
    $emailInput = validate($_POST['email']);
    $passwordInput = validate($_POST['password']);

    $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
    $password = filter_var($passwordInput, FILTER_SANITIZE_STRING);

    if ($email != '' && $password != '') {

        $query = "SELECT * FROM drivers WHERE email = '$email' AND password = '$password' LIMIT 1";
        // $query = "SELECT * FROM drivers WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                // $hashedPassword = $row['password'];

                // if (!password_verify($password, $hashedPassword)) {

                //     redirect('login.php', 'Invalid Password');
                // }

                if ($row['is_ban'] == 1) {
                    redirect('driverLogin.php', 'Your account has been banned. Please contact admin');
                }

                $_SESSION['auth'] = true;
                $_SESSION['loggedInUserRole'] = 'driver';
                $_SESSION['loggedInUser'] = [
                    'id' => $row['id'],
                    'email' => $row['email'],
                    'name' => $row['name'],
                    'phone' => $row['phone'],
                    'id' => $row['id'],
                    'address' => $row['address'],
                    'license' => $row['license'],
                    'created_at' => $row['created_at'],
                    'image' => $row['image'],
                    'qr' => $row['qr'],
                ];

                redirect('driver/index.php', 'Logged In Successfully ....');
            } else {
                redirect('driverLogin.php', 'Invalid Email Id or Password');
            }
        } else {
            redirect('driverLogin.php', 'Something went wrong !!');
        }
    } else {
        redirect('driverLogin.php', 'All Fileds are mandetory');
    }
}
