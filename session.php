<?php

// will be replaced by the database later
define("USERS", array("nico" => "qwerty", "John" => "passwd", "tEst" => "ALLCAPS"));

function isValidLogin($username, $password) {
    if (array_key_exists($username, USERS) && USERS[$username] === $password) {
        return true;
    }
    return false;
}
