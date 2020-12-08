<?php

function getMatchingScore($student, $university) {
    $score = 0;
    foreach($university["programs"] as $program) {
        if ($program["name"] === $student["program"]) {
            $score += 50;
            break;
        }
    }
    if ($university["ranking"] <= $student["preferredRanking"]) {
        $score += 10;
    }
    if ($university["setting"] === $student["preferredSetting"]) {
        $score += 10;
    }
    $preferredSize = explode("-", $student["preferredSize"]);
    if ($university["size"] > $preferredSize[0] && $university["size"] < $preferredSize[1]) {
        $score += 5;
    }
    // TODO add cost vs budget
    return $score;
}
