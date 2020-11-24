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
                                                                  deadline VARCHAR(10),
                                                                  contactPage VARCHAR(250),
                                                                  phone CHAR(10),
                                                                  email VARCHAR(50)
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
                                                              name VARCHAR(50) NOT NULL, minimum_gpa DECIMAL(3,2),
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
                                                                  name VARCHAR(50) NOT NULL, minimum_gpa DECIMAL(3,2),
                                                                  residence VARCHAR(50), amount INT NOT NULL,
                                                                  financial_need INT, university VARCHAR(50),
                                                                  FOREIGN KEY (university) REFERENCES universities(id))");
    $success = $statement->execute();
    if (!$success) {
        throw new PDOException('$statement->execute() returned false for scholarships table creation');
    }
}

function createCostsTable() {
    $connection = createConnection();
    $statement = $connection->prepare("CREATE TABLE costs (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, resident INT,
                                                          non_resident INT, cost INT, university VARCHAR(50),
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
        return json_decode($string, $associative=true);
    }
    throw new Exception("file $filename does not exist");
}

function addUniversity($values) {
    $connection = createConnection();
    $statement = $connection->prepare("INSERT INTO universities VALUES (:id, :name, :description, :address, :setting,
                                                                        :size, :ranking, :location, :deadline,
                                                                        :contactPage, :phone, :email)");
    $statement->bindValue("id", $values["id"]);
    $statement->bindValue("name", $values["name"]);
    $statement->bindValue("description", $values["description"]);
    $statement->bindValue("address", $values["address"]);
    $statement->bindValue("setting", $values["setting"]);
    $statement->bindValue("size", $values["size"], PDO::PARAM_INT);
    $statement->bindValue("ranking", $values["ranking"], PDO::PARAM_INT);
    $statement->bindValue("location", $values["location"]);
    $statement->bindValue("deadline", $values["deadline"]);
    $statement->bindValue("contactPage", $values["contactPage"]);
    $statement->bindValue("phone", $values["phone"]);
    $statement->bindValue("email", $values["email"]);
    $success = $statement->execute();
    if ($success && $statement->rowCount() === 1) {
        addUniversityPrograms($connection, $values);
        addUniversityScholarships($connection, $values);
        addUniversityCost($connection, $values);
    }
    echo "University " . $values["id"] . " successfully added to database<br>";
}

function addUniversityPrograms($connection, $university) {
    $statement = $connection->prepare("INSERT INTO programs VALUES (:id, :name, :minimum_gpa, :university)");
    $statement->bindValue("id", null);  // MySQL will assign a valid id automatically
    $statement->bindValue("university", $university["id"]);
    foreach($university["programs"] as $program) {
        $statement->bindValue("name", $program["name"]);
        $statement->bindValue("minimum_gpa", $program["minimum_gpa"]);
        $success = $statement->execute();
        if (!$success && $statement->rowCount() !== 1) {
            throw new PDOException("Error when adding program " . $program["name"] . " to database<br>");
        }
    }
}

function addUniversityScholarships($connection, $university) {
    $statement = $connection->prepare("INSERT INTO scholarships VALUES (:id, :name, :minimum_gpa, :residence, 
                                                                        :amount, :financial_need, :university)");
    $statement->bindValue("id", null);  // MySQL will assign a valid id automatically
    $statement->bindValue("university", $university["id"]);
    foreach($university["scholarships"] as $scholarship) {
        $statement->bindValue("name", $scholarship["name"]);
        $statement->bindValue("minimum_gpa", $scholarship["minimum_gpa"]);
        $statement->bindValue("residence", $scholarship["residence"]);
        $statement->bindValue("amount", $scholarship["amount"], PDO::PARAM_INT);
        $statement->bindValue("financial_need", $scholarship["financial_need"], PDO::PARAM_INT);
        $success = $statement->execute();
        if (!$success && $statement->rowCount() !== 1) {
            throw new PDOException("Error when adding scholarship " . $scholarship["name"] . " to database<br>");
        }
    }
}

function addUniversityCost($connection, $university) {
    $statement = $connection->prepare("INSERT INTO costs VALUES (:id, :resident, :non_resident, :cost, :university)");
    $statement->bindValue("id", null);  // MySQL will assign a valid id automatically
    $statement->bindValue("university", $university["id"]);
    $cost = $university["cost"];
    $statement->bindValue("resident", $cost["resident"]);
    $statement->bindValue("non_resident", $cost["non_resident"]);
    $statement->bindValue("cost", $cost["cost"]);
    $success = $statement->execute();
    if (!$success && $statement->rowCount() !== 1) {
        throw new PDOException("Error when adding cost for university " . $university["id"] . " to database<br>");
    }
}
