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

  if(isset($_POST['formSubmit']) ) {
      header("Location: somewhereElse.php");

  }
  
$content = "

<form id='regForm' action='/action_page.php'>
      <h2>Should Echo User's Name</h2>

      <!-- One 'tab' for each step in the form: -->
      <!-- 1 -->
      <div class='tab'>Your current contact information:
      <p><input placeholder='Address...' oninput='this.className = ''' name='address' max='250'></p>
      <p><input placeholder='City...' oninput='this.className = ''' name='city'></p>    
      <p><input placeholder='Country...' oninput='this.className = ''' name='country'></p>
      <p><input placeholder='Postal Code...' oninput='this.className = ''' name='postalCode'></p>
      </div>

      <!-- 2 -->
      <div class='tab'>Academic/Financial information:
      <p>
      <select name='major' id='majorDropdown'>
      <option selected disabled>Major</option>
      <option value='to'>to</option>
      <option value='be'>be filled in</option>
      <option value='filled'>from DB</option>
      </select></p>
      <p>
      <select name='gpa' id='majorDropdown'>
      <option selected disabled>GPA</option>
      <option value='to'>To</option>
      <option value='be'>be filled in</option>
      <option value='filled'>from DB?</option>
      </select></p>  
    <p><input placeholder='Household income...' oninput='this.className = ''' name='householdIncome'></p>    
    <p><input placeholder='Budget?' oninput='this.className = ''' name='budget'></p>
    </div>

    <!-- 3 -->
    <div class='tab'>Tell us a bit about yourself:
      <p><textarea name='description' id='bio' rows='5' cols='75' oninput='this.className = ''' placeholder='Provide a brief bio to let your personality shine!'></textarea></p>
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
    <input type='radio' name='preferredSize' value='highPopulation' checked>  
    <image class='setting' type='image' src='images/highPopulation.jpeg' alt='Submit' width='250' height='150'></image>
    <span class='tooltiptext'>Want lots of people to meet? Join an institution which hosts a large student population, full of teams, organizations.</span>
    </label>
    </div>

    <div class='tooltip'>
    <!-- https://www.languagescanada.ca/web/default/files/public/public/2014%20UGuelph%20Aerial.jpg -->
    <label>
    <input type='radio' name='preferredSize' value='mediumPopulation' checked>  
    <image class='setting' type='image' src='images/mediumPopulation.jpg' alt='Submit' width='250' height='150'></image>
    </label>
    <span class='tooltiptext'>Not too big, not too small? Just right. For people who don't want to sit infront of a jumbotron for first year lectures, medium population schools are what you're looking for.</span>
    </div>

    <div class='tooltip'>
    <label>
    <input type='radio' name='preferredSize' value='lowPopulation' checked>  
    <!-- https://choosecolorado.com/wp-content/uploads/2017/08/rural-colorado-mountains-distance-1530x779.jpg -->
    <image class='setting' type='image' src='images/lowPopulation.jpg' alt='Submit' width='250' height='150'></image>
    <span class='tooltiptext'>Want to rub elbows with your professors? Less students can mean premium education in close contact to your peers and professors.</span>
    </label>
    </div>

    </div>
    <!-- 6 -->
    <div class='tab'>
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
  // If the valid status is true, mark the step as finished and valid:
  // if (valid) {
  //   document.getElementsByClassName('step')[currentTab].className += ' finish';
  // }
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

</body> 
";

include "template.php";