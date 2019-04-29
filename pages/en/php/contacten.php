<?php
if (isset($_POST['email'])) {

    // Global informations
    $email_to = "jcordatauclair@gmail.com";
    $email_subject = "Site Internet - nouveau message";

    function died($error)
    {
        // Error code
        echo "<script>alert('There are some errors with the form your submitted');window.location.href='https://www.juliencordatauclair.com/pages/en/contact.html';</script>";
        exit;
    }


    // Expected data
    if (!isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message'])) {
        died('A field is missing!');
    }



    $first_name = $_POST['fname']; // required
    $last_name = $_POST['lname']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email_from)) {
        $error_message .= 'The email address you entered does not appear to be valid.';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $first_name)) {
        $error_message .= 'The first name you entered does not appear to be valid.';
    }

    if (!preg_match($string_exp, $last_name)) {
        $error_message .= 'The last name you entered does not appear to be valid.';
    }

    if (strlen($message) < 2) {
        $error_message .= 'The message you entered do not appear to be valid.';
    }

    if (strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Form details below.\n\n";


    function clean_string($string)
    {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad, "", $string);
    }



    $email_message .= "First name: ".clean_string($first_name)."\n";
    $email_message .= "Last name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

    // Email headers
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    // Success message
    echo "<script>alert('Thank you!');window.location.href='https://www.juliencordatauclair.com';</script>";
    exit;
}
?>
