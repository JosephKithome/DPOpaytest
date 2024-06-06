<?php
class Candidate {
  // Properties
  public $first_name;
  public $last_name;
  public $email;
  public $phone;

  // Getter Methods
  function get_first_name() {
    return $this->first_name;
  }
  function get_last_name() {
    return $this->last_name;
  }
  function get_email() {
    return $this->email;
  }
  function get_phone() {
    return $this->phone;
  }

  // Setter Methods
  function set_first_name($first_name) {
    $this->first_name = $first_name;
  }
  function set_last_name($last_name) {
    $this->last_name = $last_name;
  }
  function set_email($email) {
    // Basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new Exception('Invalid email format');
    }
    $this->email = $email;
  }
  function set_phone($phone) {
    // Basic phone validation
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
      throw new Exception('Invalid phone number format');
    }
    $this->phone = $phone;
  }
}

try {
  $c = new Candidate();
  $c->set_first_name('Joseph');
  $c->set_last_name('Kithome');
  $c->set_email('josephkithome.jmkgmail.com');
  $c->set_phone('254717064174');

  echo $c->get_first_name();
  echo "<br>";
  echo $c->get_last_name();
  echo "<br>";
  echo $c->get_email();
  echo "<br>";
  echo $c->get_phone();
  echo "<br>";

  // Output 
  // Joseph
  // Kithome
  // josephkithome.jmk@gmail.com
  // 254717064174

} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "<br>";
}
?>
