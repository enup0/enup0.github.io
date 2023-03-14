<?php
function generate_password_hash($password) {
    // Generate a password hash using bcrypt
    $options = ['cost' => 12];
    $hash = password_hash($password, PASSWORD_BCRYPT, $options);
    return $hash;
}

function send_confirmation_email($to_email, $confirmation_code) {
    // Send a confirmation email with a confirmation code to the user
    $subject = "Confirm your email address";
    $message = "Please click the link below to confirm your email address:\n\n";
    $message .= "https://example.com/confirm.php?code=$confirmation_code";
    $headers = "From: support@example.com\r\n";
    $headers .= "Reply-To: support@example.com\r\n";
    $headers .= "Content-type: text/plain\r\n";
    mail($to_email, $subject, $message, $headers);
}

function generate_random_string($length) {
    // Generate a random string of the given length
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $characters_length = strlen($characters);
    $random_string = "";
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, $characters_length - 1)];
    }
    return $random_string;
}
?>
