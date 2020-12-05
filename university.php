<html>
<head></head>
<body>
<pre>
<?php

require_once "database/universities.php";

function print_array($array, $indent) {
    foreach($array as $key=>$value) {
        if (is_array($value)) {
            echo str_repeat(" ", $indent) . "$key:<br>";
            print_array($value, $indent+4);
            echo "<br>";
        }
        else {
            echo str_repeat(" ", $indent) . "$key: $value<br>";
        }
    }
}

if (array_key_exists("id", $_GET)) {
    $id = $_GET["id"];
}
else {
    $id = "all";
}

if ($id === "all") {
    $rows = getAllUniversities();
}
else {
    $rows = getUniversity($id);
}
if (!is_null($rows)) {
    if (count($rows) === 0) {
        echo "University not found";
    }
    else {
        print_array($rows, 0);
    }
}

?>
</pre>
</body>
</html>


