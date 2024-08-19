<?php

require './config/function.php';

if (isset($_POST['contact'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $message = validate($_POST['message']);


    if ($name != '' && $email != '' && $message != '') {

        $data = [

            'name' => $name,
            'email' => $email,
            'message' => $message,

        ];

        $result = insert('contact', $data);

        if ($result) {

            redirect('contact.php', 'Message Sent Successfully .');
        } else {
            redirect('contact.php', 'Something went wrong !!!');
        }
    } else {
        redirect('contact.php', 'Please fill all the input fields');
    }
}
