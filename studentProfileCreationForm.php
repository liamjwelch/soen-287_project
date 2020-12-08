<?php

require_once "database/users.php";
require_once "database/universities.php";
require_once "database/students.php";

    session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // TODO validate the fields for student profile
    if (isset($_POST["token"]) && strlen($_POST["token"]) === 50 && isset($_POST["email"]) && !empty($_POST["email"])) {
        try {
            createStudent($_POST["email"], $_POST["token"], $_POST["city"], $_POST["state"], $_POST["country"],
                          $_POST["program"], $_POST["gpa"], $_POST["preferredSetting"], $_POST["preferredSize"],
                          $_POST["preferredRanking"], $_POST["householdIncome"], $_POST["budget"],
                          $_POST["description"]);
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["loggedin"] = true;
            header("location: homepage.php");
            exit();
        }
        catch (Exception $e) {
            echo $e->getMessage() . "<br>"; // TODO improve that
        }
    }
    else {
        // TODO handle that case
    }
}
else if(isset($_GET["token"]) && strlen($_GET["token"]) === 50 && isset($_GET["email"]) && !empty($_GET["email"])) {
    $email = urldecode($_GET["email"]);
    if (!isTokenValid($email, $_GET["token"])) {
        header("location: tokenInvalid.php");
        exit();
    }
}
else {
    // if there isn't a valid token and email in the URL, the user probably got here by mistake, just redirect to homepage
    header("location: homepage.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/studentProfileCreation.css">
</head>
<body>
<form id='regForm' action='' method="post">

        <p class="message"><?php echo getUserFirstName($email) . ", finish setting up your profile"; ?></p>
        <input type="hidden" name="token" value="<?= $_GET["token"] ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="preferredRanking" value="50" required>
      
    <!-- As found on
    https://www.w3schools.com/howto/howto_js_form_steps.asp --->

      <!-- One 'tab' for each step in the form: -->
      <!-- 1 -->
      <div class='tab'>Your current contact information:
      <p><input oninput="this.className = ''" placeholder='City...'  name='city' maxlength="50"></p>
      <p><input oninput="this.className = ''" placeholder='State...'  name='state' maxlength="50"></p>    
      <p><input oninput="this.className = ''" placeholder='Country...' name='country' maxlength="50"></p>
      </div>

      <!-- 2 -->
      <div class='tab'>Academic/Financial information:
      <p>
      <select name='program' id='majorDropdown'>
        <option value="placeholder">Please select your desired program</option>
            <?php
            foreach(getAllProgramNames() as $program) {
                 echo "<option value='$program'>$program</option>";
            }
            ?>
      </select></p>

    <p><input oninput="this.className = ''" type='number' min='1' max='4' placeholder='GPA' name='gpa'></p>
    <p><input oninput="this.className = ''" type='number' placeholder='Household income...' name='householdIncome'></p>
    <p><input oninput="this.className = ''" type='number' placeholder='Budget?' name='budget'></p>
    <p id="js-validation-msg"></p>
    </div>

    <!-- 3 -->
    <div class='tab'>Tell us a bit about yourself:
      <p><textarea name='description' id='bio' rows='4' placeholder='Provide just a few details, you can add more to your profile later!'></textarea></p>
    </div>
    <div class='tab'>Now, for the exciting part... 
      <p>Let's decide on some attributes of your dream school, to match with our superior AI driven Match-Me algorithm.</p>
      <p>Close your eyes, and picture the school of your dreams. Click Next when you are ready to make those dreams a reality.</p>
    </div>

    <!-- 4 -->
    <div id='setting' class='tab'><p>Preferred Setting:</p>

    <div class='tooltip'>
    <label> 
    <!-- https://users.encs.concordia.ca/~sera2010/images/port_montreal_aggrandi.jpg --> 
    <input type='radio' name='preferredSetting' value='city' checked>  
    <image class='setting' type='image' src='images/montreal.jpeg' alt='Submit' width='250' height='150'></image>
    <span class='tooltiptext'>Want to work hard and play hard? Schools like McGill in Montreal, Canada might be the city vibe you're looking for.</span>
    </label>
    </div>

    <div class='tooltip'>
    <!-- https://www.languagescanada.ca/web/default/files/public/public/2014%20UGuelph%20Aerial.jpg -->
    <label>
    <input type='radio' name='preferredSetting' value='suburban' checked>  
    <image class='setting' type='image' src='images/suburban.jpeg' alt='Submit' width='250' height='150'></image>
    </label>
    <span class='tooltiptext'>Slower pace with still plenty of local ammenites? An urban choice such as Harvard in Cambridge, MA. Might be what you've been looking for.</span>
    </div>

    <div class='tooltip'>
    <label>
    <input type='radio' name='preferredSetting' value='rural' checked>  
    <!-- https://choosecolorado.com/wp-content/uploads/2017/08/rural-colorado-mountains-distance-1530x779.jpg -->
    <image class='setting' type='image' src='images/rural.jpeg' alt='Submit' width='250' height='150'></image>
    <span class='tooltiptext'>A mix of the great outdoors and academic life? Schools like Standford in Outdoors, PA have you covered.</span>
    </label>
    </div>

    </div>

    <!-- 5 -->
    <div id='setting' class='tab'><p>Class Size:</p>

    <div class='tooltip'>
    <label> 
    <!-- https://images.phillypublishing.com/onwardstate/uploads/2014/09/Freshman-Convocation-8.25.12-71.jpg -->
    <input type='radio' name='preferredSize' value='10000' checked>  
    <image class='setting' type='image' src='images/highPopulation.jpeg' alt='Submit' width='250' height='150'></image>
    <span class='tooltiptext'>Want lots of people to meet? Join an institution which hosts a large student population, full of teams, organizations.</span>
    </label>
    </div>

    <div class='tooltip'>
    <!-- https://www.languagescanada.ca/web/default/files/public/public/2014%20UGuelph%20Aerial.jpg -->
    <label>
    <input type='radio' name='preferredSize' value='2000-5000' checked>  
    <image class='setting' type='image' src='images/mediumPopulation.jpg' alt='Submit' width='250' height='150'></image>
    </label>
    <span class='tooltiptext'>Not too big, not too small? Just right. For people who don't want to sit infront of a jumbotron for first year lectures, medium population schools are what you're looking for.</span>
    </div>

    <div class='tooltip'>
    <label>
    <input type='radio' name='preferredSize' value='1000' checked>  
    <!-- https://choosecolorado.com/wp-content/uploads/2017/08/rural-colorado-mountains-distance-1530x779.jpg -->
    <image class='setting' type='image' src='images/lowPopulation.jpg' alt='Submit' width='250' height='150'></image>
    <span class='tooltiptext'>Want to rub elbows with your professors? Less students can mean premium education in close contact to your peers and professors.</span>
    </label>
    </div>

    </div>
    <!-- 6 -->
    <div id='setting' class='tab'>
      <p>Well done! Please click submit to finish the registration process. Upon submission we will begin matching you to the university of your dreams!</p>
    </div>

  <div style='overflow:auto;'>
    <div style='float:right;'>
      <button type='button' id='prevBtn' onclick='nextPrev(-1)'>Previous</button>
      <button type='button' id='nextBtn' onclick='nextPrev(1)'>Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style='text-align:center;margin-top:40px;'>
    <span class='step'></span>
    <span class='step'></span>
    <span class='step'></span>
    <span class='step'></span>
    <span class='step'></span>
    <span class='step'></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName('tab');
  x[n].style.display = 'block';
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById('prevBtn').style.display = 'none';
  } else {
    document.getElementById('prevBtn').style.display = 'inline';
  }
  if (n == (x.length - 1)) {
    document.getElementById('nextBtn').innerHTML = 'Submit';
    document.getElementById('nextBtn').name = 'formSubmit';
  } else {
    document.getElementById('nextBtn').innerHTML = 'Next';
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName('tab');
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = 'none';
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById('regForm').submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName('tab');
  y = x[currentTab].getElementsByTagName('input');
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == '') {
      // add an 'invalid' class to the field:
      y[i].className += ' invalid';
      // and set the current valid status to false
      valid = false;
    }
  }

  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }

   if (!validateGPA()) {
        var message = "GPA must be a number between 0 and 4.3";
        var display = document.getElementById("js-validation-msg");
        display.innerHTML = message;
        return false;
    }

       if (validateGPA()) {
        var message = "";
        var display = document.getElementById("js-validation-msg");
        display.innerHTML = message;
    }
    
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the 'active' class of all steps...
  var i, x = document.getElementsByClassName('step');
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(' active', '');
  }
  //... and adds the 'active' class on the current step:
  x[n].className += ' active';
}


function validateGPA() {
    var gpa = document.forms[0].gpa.value;
    return gpa >= 0 && gpa <= 4.3;
}
</script>
</main>
</body>
</html>
