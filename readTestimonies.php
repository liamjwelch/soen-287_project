<?php

    $file = "testimony.txt";
    $testimonies = array();

    if(file_exists($file)) {
        $fileToOpen = fopen($file, "r");
        while(!feof($fileToOpen)) {
            $line = fgets($fileToOpen);
            $testimonies[] = $line;
        }
    }

    echo json_encode($testimonies);

?>