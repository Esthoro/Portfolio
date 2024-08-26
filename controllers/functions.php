<?php

require_once 'C:\xampp\htdocs\PortfolioGit\public\assets\vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\DB;

/**
 * Function to clean requests
 *
 * @param mixed $data
 * @param array|null $exclude
 *
 * @return array|string
 */
function cleanRequest($data)
{
    if (is_array($data)) {

        foreach ($data as $key => $value) {

                $data[$key] = cleanRequest($value);
        }

    } else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }

    return $data;
}

function sendMail($name, $email, $subject, $message) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
    $mail->SMTPDebug = 0;
    $mail->Host = 'mail.gandi.net';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = 'esther@pp-communication.fr';
    $mail->Password = 'estherPass10';
    $mail->setFrom('esther@pp-communication.fr');

    $mail->addReplyTo($email, $name);

    $mail->addAddress('esthoro28@gmail.com');

    $mail->Subject = $subject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    $mail->msgHTML($message);

//Replace the plain text body with one created manually
    $mail->AltBody = $message;

    //Desactivate certificate - ONLY FOR LOCALHOST !!! SECURITY RISK
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

//send the message, check for errors
    if (!$mail->send()) {
        return 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        return true;
    }
}
function isConnected() {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        if (isset($_SESSION['pseudo'])) {
            return true;
        }
    }
    return false;
}
function isAdmin() {
    if (isset($_SESSION['pseudo'])) {
        $pseudo = $_SESSION['pseudo'];
        $sql = 'SELECT * FROM person
            WHERE pseudo = :pseudo
            AND role = 2';
        $params = array(':pseudo' => $pseudo);
        if ($result = DB::exec($sql, $params)) {
            if ($result->rowCount() == 1) {
                return true;
            }
        }
    }
    return false;
}
function showPersonByLogin($login) {
    $sql = 'SELECT * FROM person WHERE pseudo = :pseudo';
    $params = array(':pseudo' => $login);

    if ($result = DB::exec($sql, $params)) {
        return $result->fetchAll(\PDO::FETCH_OBJ);
    }
    return [];
}
