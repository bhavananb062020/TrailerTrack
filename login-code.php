<?php

require './config/function.php';

if (isset($_POST['loginBtn'])) {
    $emailInput = validate($_POST['email']);
    $passwordInput = validate($_POST['password']);

    $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
    $password = filter_var($passwordInput, FILTER_SANITIZE_STRING);

    if ($email != '' && $password != '') {

        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        // $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // $hashedPassword = $row['password'];

                // if (!password_verify($password, $hashedPassword)) {

                //     redirect('login.php', 'Invalid Password');
                // }

                if ($row['role'] == 'manager') {

                    if ($row['is_ban'] == 1) {
                        redirect('login.php', 'Your account has been banned. Please contact admin');
                    }

                    $_SESSION['auth'] = true;
                    $_SESSION['loggedInUserRole'] = $row['role'];
                    $_SESSION['loggedInUser'] = [
                        'email' => $row['email'],
                        'name' => $row['name'],
                        'phone' => $row['phone'],
                        'id' => $row['id'],
                        'center' => $row['center'],
                        'created_at' => $row['created_at'],
                        'image' => $row['image'],
                    ];

                    redirect('manager/index.php', 'Logged In Successfully ....');
                } else if ($row['role'] == 'employee') {
                    if ($row['is_ban'] == 1) {
                        redirect('login.php', 'Your account has been banned. Please contact admin');
                    }

                    $_SESSION['auth'] = true;
                    $_SESSION['loggedInUserRole'] = $row['role'];
                    $_SESSION['loggedInUser'] = [
                        'email' => $row['email'],
                        'name' => $row['name'],
                        'phone' => $row['phone'],
                        'id' => $row['id'],
                        'center' => $row['center'],
                        'created_at' => $row['created_at'],
                        'image' => $row['image'],

                    ];
                    redirect('employee/index.php', 'Logged In Successfully');
                } else {
                    redirect('login.php', 'Access Denied ......');
                }
            } else {
                redirect('login.php', 'Invalid Email Id or Password');
            }
        } else {
            redirect('login.php', 'Something went wrong !!');
        }
    } else {
        redirect('login.php', 'All Fileds are mandetory');
    }
}
