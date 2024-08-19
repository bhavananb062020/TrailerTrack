
<?php

function checkUserAccess($conn, $email, $role)
{
    $query = "SELECT * FROM users WHERE email = ? AND role = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $role);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function handleAccessDenial($message)
{
    logoutSession();
    redirect('../login.php', $message);
    exit;
}

function validateUserSession($conn)
{
    if (!isset($_SESSION['auth']) || !isset($_SESSION['loggedInUserRole'])) {
        redirect('../login.php', 'Login to continue..');
        exit;
    }

    $role = validate($_SESSION['loggedInUserRole']);
    $email = validate($_SESSION['loggedInUser']['email']);

    $user = checkUserAccess($conn, $email, $role);
    if (!$user) {
        handleAccessDenial('Access Denied');
    }

    if ($user['role'] !== 'employee') {
        handleAccessDenial('Access Denied');
    }

    if ($user['is_ban'] == 1) {
        handleAccessDenial('Your account has been banned. Please contact admin.');
    }
}

// Call the function to validate the session
validateUserSession($conn);
