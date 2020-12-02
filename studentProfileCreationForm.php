<?php
require "database/users.php";

session_start();
$title = "North America Higher Education Database";
$styles = ["css/studentProfile.css"];
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $greeting = "Welcome back, ". getUserFirstName($_SESSION["email"]) . "!";
}
else {
    $greeting = '<a href="login.php">Log in</a> or <a href="signup.php">sign up</a> to let us find the university of your dreams!';
}
$content = "

<body>

<!-- adapted from
 https://www.w3schools.com/howto/howto_js_form_steps.asp --->

<form id='regForm' action='/action_page.php'>
  <h2>Should Echo User's Name</h2>
  <!-- One 'tab' for each step in the form: -->
  <div class='tab'>Your current contact information:
    <p><input placeholder='Address...' oninput='this.className = ''' name='address' max='250'></p>
    <p><input placeholder='City...' oninput='this.className = ''' name='city'></p>    
    <p><input placeholder='Country...' oninput='this.className = ''' name='country'></p>
    <p><input placeholder='Postal Code...' oninput='this.className = ''' name='postalCode'></p>
  </div>
    <div class='tab'>Academic/Financial information:
    <p>
      <label>Major:</label>
      <select name='majors' id='majorDropdown'>
      <option value=''>To</option>
      <option value=''>be filled in</option>
      <option value=''>from DB</option>
      </select></p>
      <label>GPA:</label>
      <select name='gpa' id='gpaDropdown'>
      <option value=''>To</option>
      <option value=''>be filled in</option>
      <option value=''>from DB?</option>
      </select></p>  
    <p><input placeholder='Household income...' oninput='this.className = ''' name='houseHoldIncome'></p>    
    <p><input placeholder='Budget?' oninput='this.className = ''' name='budget'></p>
  </div>
  <div class='tab'>Tell us a bit about yourself:
    <p><textarea name='description' id='bio' rows='4' cols='50' oninput='this.className = ''' placeholder='Just a little something special! ;o)'></textarea></p>
  </div>
  <div class='tab'>Now, the for the exciting part... 
    <p>Let's decide on some attributes of your dream school, to match with our superior AI driven Match-Me algorithm.</p>
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
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName('step')[currentTab].className += ' finish';
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
</script>
";

include "template.php";