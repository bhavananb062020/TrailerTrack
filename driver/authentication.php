<?php

if (isset($_SESSION['auth'])) {
    if (isset($_SESSION['loggedInUserRole'])) {
        $role = validate($_SESSION['loggedInUserRole']);
        $email = validate($_SESSION['loggedInUser']['email']);

        $query = "SELECT * FROM drivers WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if (mysqli_num_rows($result) == 0) {
                logoutSession();
                redirect('../driverLogin.php', 'Access Denied');
            } else {

                if ($row['is_ban'] == 1) {
                    logoutSession();
                    redirect('../driverLogin.php', 'Your account has been banned . Please contact admin');
                }
            }
        } else {
            logoutSession();
            redirect('../driverLogin.php', 'Something went wrong!!');
        }
    }
} else {
    redirect('../driverLogin.php', 'Login to continue..');
}
