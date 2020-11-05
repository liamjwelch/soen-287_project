<?php
require 'inc/functions.php';

$pageTitle = "AHED";

//initializes all of the variables necessary for creation
$first_name= $last_name = $phone_number = $email_address = $major = ''; 

//check that the request method is post
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //variable = type, field and filter
    //trim removes whitespace from beginning and end of field input
    //filter sanitize 
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    $phone_number = trim(filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_NUMBER_INT));
    $email_address = trim(filter_input(INPUT_POST, 'email_address', FILTER_SANITIZE_STRING));
    //to be initialized
    //$major = trim(filter_input(INPUT_POST, 'major', FILTER_SANITIZE_STRING));
    //these are required fields so we must know that they are not empty
      if(empty($first_name) || empty($last_name) || empty($phone_number) || empty($email_address)
    //  || empty($major)
      )
       {
        //if any of the fields are empty print error message
        $error_msg = "Please complete all required fields";
    } else {
      //otherwise persist data to DB
        if (add_task($first_name, $last_name, $phone_number, $email_address,$major)) {
          $error_msg = "Student added successfully!";
        } else {
            $error_msg = "Could not add student!";
        }
    }
}
?>
<!DOCTYPE html>
    <head>

        <title><?php echo $pageTitle ?></title>
    </head>
    <div align="center">
    <body text-align="center">
      <div align="center">

        
      <form class="form-container form-add" method="post" action="studentProfile.php">
        
        <h1>Student Profile</h1>
                    <?php
                if(isset($error_msg)) {
                    echo "<p class='message'>" . $error_msg . "</p>";
                }
            ?>
        
        <fieldset style="width:30%">
        
          
          <legend>Student Profile</legend>
          <div align="left">
          <label for="name"></label>
          <br>
          <input name="first_name" id="first_name" placeholder="First Name"
          value="<?php echo htmlspecialchars($first_name); ?>" max="20">
          <input name="last_name" id="last_name" placeholder="Last Name"
          value="<?php echo htmlspecialchars($last_name); ?>" max="20">
          <br>
          <br>          
          <label>Phone Number</label>
          <input name="phone_number" id="phone_number" placeholder="Format: 123-456-7890"
          value="<?php echo htmlspecialchars($phone_number); ?>" max="10">
          <br>
          <br>
          <label>Email Address</label>
          <input name="email_address" id="email_address" placeholder="email address"
          value="<?php echo htmlspecialchars($email_address); ?>" max="75">
        </div>
        
        </fieldset>
        
        <fieldset style="width:30%">
          
          <legend>Match me</legend>
          <div align="left">
          <label>Choose major:</label>
          <br>
          <select name="major" id="major">
              <option
              value="<?php echo htmlspecialchars($major); ?>">CompSci</option>
              <option
              value="<?php echo htmlspecialchars($major); ?>">English</option>
              <option
              value="<?php echo htmlspecialchars($major); ?>">Software Engineering</option>
          </select>
          
        
        </div>
        
        </fieldset>
        
        <p>Let us find the university of your dreams...</p>

        <input class="button button--primary button--topic-php" type="submit" value="Submit" />
        <button type="submit">Start Over</button>
        
      </form>

      

      
    </body>

</div>

</html>









