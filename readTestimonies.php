<?php
    $file = "testimonials.txt";
    $testimonies = array();
    if(file_exists($file)) {
        $fileToOpen = fopen($file, "r");
        while(!feof($fileToOpen)) {
            $line = fgets($fileToOpen);
            $testimonies[] = $line;
        }
        fclose($fileToOpen);
    }
    echo json_encode($testimonies);