<?php
if (isset($_POST['email'])) {

    // Infos globales
    $email_to = "jcordatauclair@gmail.com"; // Adresse mail sur laquelle le message doit être reçu
    $email_subject = "Site Internet - nouveau message"; // Objet du message


    // Erreur : pop-up avec message personnalisé et redirection vers une page spécifique
    function died($error)
    {
        echo "<script>alert('Le formulaire est invalide');window.location.href='https://www.juliencordatauclair.com/pages/fr/contact.html';</script>";
        exit;
    }


    /* Données attendues */

    if (!isset($_POST['fname']) ||   // Prénom
        !isset($_POST['lname']) ||   // Nom
        !isset($_POST['email']) ||   // Email
        !isset($_POST['message'])) { // Message
        died('Vous avez oublié de remplir un champ'); // Erreur si un des champs n'est pas rempli
    }

    $first_name = $_POST['fname'];
    $last_name = $_POST['lname']; 
    $email_from = $_POST['email'];
    $message = $_POST['message'];

    /*********************/


    /* Gestion d'erreur de syntaxe */

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($email_exp, $email_from)) {
        $error_message .= 'Adresse mail invalide';
    }

    if (!preg_match($string_exp, $first_name)) {
        $error_message .= 'Prenom invalide';
    }

    if (!preg_match($string_exp, $last_name)) {
        $error_message .= 'Nom invalide';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Message invalide';
    }

    if (strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Detail des erreurs : \n";

    /*******************************/


    /* Nettoyage de chaîne pour le mail reçu */

    function clean_string($string)
    {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Prenom : ".clean_string($first_name)."\n";
    $email_message .= "Nom : ".clean_string($last_name)."\n";
    $email_message .= "Email : ".clean_string($email_from)."\n";
    $email_message .= "Message : ".clean_string($message)."\n";

    /*****************************************/


    /* Headers du mail reçu */

    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    /************************/


    // Succès : pop-up avec message personnalisé et redirection vers une page spécifique
    echo "<script>alert('Merci !');window.location.href='https://www.juliencordatauclair.com';</script>";
    exit;
}
?>
