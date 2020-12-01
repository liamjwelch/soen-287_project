<?php

require_once "connection.php";

$university_directory = "../universities/";

function createUniversitiesTable() {
    $connection = createConnection();
    $statement = $connection->prepare("CREATE TABLE universities (id VARCHAR (50) PRIMARY KEY NOT NULL,
                                                                  name VARCHAR(100),
                                                                  description TEXT,
                                                                  address VARCHAR(250),
                                                                  setting CHAR(10),
                                                                  size INT,
                                                                  ranking INT,
                                                                  location VARCHAR(100),
                                                                  deadline VARCHAR(20),
                                                                  contactPage VARCHAR(250),
                                                                  phone CHAR(10),
                                                                  email VARCHAR(50),
                                                                  avgGPA DECIMAL(3,2)
                                                                  )");
    try {
        $success = $statement->execute();
        if ($success) {
            echo "universities table created successfully<br>";
            createProgramsTable();
            echo "programs table created successfully<br>";
            createScholarshipsTable();
            echo "scholarships table created successfully<br>";
            createCostsTable();
            echo "costs table created successfully<br>";
            generateUniversityProfiles();
        }
        else {
            echo 'Error when creating university table: $statement->execute() returned false' . "<br>";
        }
    }
    catch (PDOException $e) {
        echo "Error when creating table: " . $e->getMessage() . "<br>";
    }
}

function createProgramsTable() {
    $connection = createConnection();
    $statement = $connection->prepare("CREATE TABLE programs (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                                                              name VARCHAR(50) NOT NULL, minimumGPA DECIMAL(3,2),
                                                              university VARCHAR(50),
                                                              FOREIGN KEY (university)  REFERENCES universities(id))");
    $success = $statement->execute();
    if (!$success) {
        throw new PDOException('$statement->execute() returned false for programs table creation');
    }
}

function createScholarshipsTable() {
    $connection = createConnection();
    $statement = $connection->prepare("CREATE TABLE scholarships (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                                                                  name VARCHAR(100) NOT NULL, minimumGPA DECIMAL(3,2),
                                                                  residence VARCHAR(50), amount INT NOT NULL,
                                                                  financialNeed INT, university VARCHAR(50),
                                                                  FOREIGN KEY (university) REFERENCES universities(id))");
    $success = $statement->execute();
    if (!$success) {
        throw new PDOException('$statement->execute() returned false for scholarships table creation');
    }
}

function createCostsTable() {
    $connection = createConnection();
    $statement = $connection->prepare("CREATE TABLE costs (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, resident INT,
                                                          nonResident INT, university VARCHAR(50),
                                                          FOREIGN KEY (university) REFERENCES universities(id))");
    $success = $statement->execute();
    if (!$success) {
        throw new PDOException('$statement->execute() returned false for costs table creation');
    }
}

function generateUniversityProfiles() {
    global $university_directory;
    $files = scandir($university_directory);
    foreach($files as $file) {
        if (preg_match('/\.json$/', $file)) {
            try {
                echo "reading file $file<br>";
                $profile = parseUniversityProfile($file);
                addUniversity($profile);
            } catch (Exception $e) {
                echo "Error when adding university: " . $e->getMessage() . "<br>";
            }
        }
    }
}

function parseUniversityProfile($filename) {
    global $university_directory;
    $string = file_get_contents($university_directory . $filename);
    if (!is_null($string)) {
        $result = json_decode($string, $assoc=true);
        if (is_null($result) || json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error when parsing file $filename");
        }
        return $result;
    }
    throw new Exception("file $filename does not exist");
}

function addUniversity($values) {
    $connection = createConnection();
    $statement = $connection->prepare("INSERT INTO universities VALUES (:id, :name, :description, :address, :setting,
                                                                        :size, :ranking, :location, :deadline,
                                                                        :contactPage, :phone, :email, :avgGPA)");
    $university = [];
    foreach($values as $key=>$value) {
        if ($key !== "programs" && $key !== "scholarships" && $key !== "cost") {
            $university[$key] = $value;
        }
    }

    $success = $statement->execute($university);
    if ($success && $statement->rowCount() === 1) {
        addUniversityPrograms($connection, $values);
        addUniversityScholarships($connection, $values);
        addUniversityCost($connection, $values);
    }
    echo "University " . $values["id"] . " successfully added to database<br>";
}

function addUniversityPrograms($connection, $university) {
    $statement = $connection->prepare("INSERT INTO programs VALUES (:id, :name, :minimumGPA, :university)");
    $statement->bindValue("id", null);  // MySQL will assign a valid id automatically
    $statement->bindValue("university", $university["id"]);
    foreach($university["programs"] as $program) {
        $statement->bindValue("name", $program["name"]);
        $statement->bindValue("minimumGPA", $program["minimumGPA"]);
        $success = $statement->execute();
        if (!$success && $statement->rowCount() !== 1) {
            throw new PDOException("Error when adding program " . $program["name"] . " to database<br>");
        }
    }
}

function addUniversityScholarships($connection, $university) {
    $statement = $connection->prepare("INSERT INTO scholarships VALUES (:id, :name, :minimumGPA, :residence,
                                                                        :amount, :financialNeed, :university)");
    $statement->bindValue("id", null);  // MySQL will assign a valid id automatically
    $statement->bindValue("university", $university["id"]);
    foreach($university["scholarships"] as $scholarship) {
        $statement->bindValue("name", $scholarship["name"]);
        $statement->bindValue("minimumGPA", $scholarship["minimumGPA"]);
        $statement->bindValue("residence", $scholarship["residence"]);
        $statement->bindValue("amount", $scholarship["amount"], PDO::PARAM_INT);
        $statement->bindValue("financialNeed", $scholarship["financialNeed"], PDO::PARAM_INT);
        $success = $statement->execute();
        if (!$success && $statement->rowCount() !== 1) {
            throw new PDOException("Error when adding scholarship " . $scholarship["name"] . " to database<br>");
        }
    }
}

function addUniversityCost($connection, $university) {
    $statement = $connection->prepare("INSERT INTO costs VALUES (:id, :resident, :nonResident, :university)");
    $statement->bindValue("id", null);  // MySQL will assign a valid id automatically
    $statement->bindValue("university", $university["id"]);
    $cost = $university["cost"];
    $statement->bindValue("resident", $cost["resident"]);
    $statement->bindValue("nonResident", $cost["nonResident"]);
    $success = $statement->execute();
    if (!$success && $statement->rowCount() !== 1) {
        throw new PDOException("Error when adding cost for university " . $university["id"] . " to database<br>");
    }
}

/*
 * Return the university with the id $id from the database, as an associative array. The programs and scholarships
 * are return inside the university as an indexed array of associative arrays. The cost is returned as an associative
 * array. See the json files for the universities to see exactly how the data is returned.
 *
 * If no university with the given id exists, then an empty array is returned. If an error occurs, null is returned.
 */
function getUniversity($id) {
    $connection = createConnection();

    $getUni = $connection->prepare("SELECT * FROM universities WHERE id = ?");

    $getPrograms = $connection->prepare("SELECT name, minimumGPA FROM programs WHERE university = ?");

    $getScholarships = $connection->prepare("SELECT name, minimumGPA, residence, amount, financialNeed FROM
                                             scholarships WHERE university = ?");

    $getCost = $connection->prepare("SELECT resident, nonResident FROM costs WHERE university = ?");

    $success = $getUni->execute([$id]);
    if ($success) {
        $rows = $getUni->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows) === 0) {
            return [];
        }
        $university = $rows[0];

        $success = $getPrograms->execute([$id]) && $getScholarships->execute([$id]) && $getCost->execute([$id]);
        if ($success) {
            $university["programs"] = $getPrograms->fetchAll(PDO::FETCH_ASSOC);
            $university["scholarships"] = $getScholarships->fetchAll(PDO::FETCH_ASSOC);
            $university["cost"] = $getCost->fetchAll(PDO::FETCH_ASSOC)[0];
            return $university;
        }
        else {
            echo "Error when trying to get data for university $id from database <br>";
        }
    }
    else {
        echo "Error when trying to get university $id from database <br>";
    }
    return null;
}
