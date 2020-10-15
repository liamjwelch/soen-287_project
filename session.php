<?php

function isValidLogin($username, $password) {
    if ($username === "nico" && $password === "qwerty123") {
        return true;
    }
    return false;
}
