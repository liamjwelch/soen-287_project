<?php

function generateValidationToken() {
    return bin2hex(random_bytes(25));
}

function getEmailVerificationURL($token, $email) {
    $encodedEmail = urlencode($email);
    $path = pathinfo($_SERVER["REQUEST_URI"], PATHINFO_DIRNAME);
    $url = "http://" . $_SERVER["HTTP_HOST"] . "$path";
    return "$url/studentProfileCreationForm.php?token=$token&email=$encodedEmail";
}
