<?php
// Global result of form validation
$valid = false;
// Global array of validation messages. For valid fields, message is ""
$val_messages = Array('email'=>"", 'animals'=>"", 'date'=>"");

// Output the results if all fields are valid.
function the_results()
{
  global $valid;
  global $email, $date, $animals;

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    if($valid){
      echo "<div class='results'>

          <div class='result-text'> Your email address is: $email </div>
      
          <div class='result-text'> Your favorite animals are: <ul>". printAnimals() ."</ul></div>
      
          <div class='result-text'>Your favourite date is: $date </div>
  
      </div>";
    }

  }
}

// Check each field to make sure submitted data is valid. If no boxes are checked, isset() will return false
function validate()
{
    global $valid;
    global $val_messages;
    global $email, $date, $animals;
    $emailpattern = '#^(.+)@([^\.].*)\.([a-z]{2,})$#';
    $datepattern = '#^\d{4}/((0[1-9])|(1[0-2]))/((0[1-9])|([12][0-9])|(3[01]))$#';
    if($_SERVER['REQUEST_METHOD']== 'POST')
    {
      
      if(preg_match($emailpattern, $email) == 1 && preg_match($datepattern, $date) == 1 && count($animals) >= 3){
        $valid = true;
      } else {
          if (preg_match($emailpattern, $email) == 0){
            $val_messages['email'] = "email is not in correct format";
          } 
          if (count($animals) < 3){
            $val_messages['animals'] = "please choose at least three animals";
          } 
          if (preg_match($datepattern, $date) == 0){
            $val_messages['date'] = "please enter a valid date in the format yyy/mm/dd";
          }
      }
      
    }
}

// Display error message if field not valid. Displays nothing if the field is valid.
function the_validation_message($type) {
 
  global $val_messages;
  global $email, $date, $animals;

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
      echo $val_messages[$type];
  }
}

function printAnimals(){
  global $animals;
  $printAnimals = "";
  if($_SERVER['REQUEST_METHOD']== 'POST')
  {
    foreach ($animals as $an){
      $printAnimals .= "<li>". $an . " </li>";
    }
  }
  return $printAnimals;
}

?>
