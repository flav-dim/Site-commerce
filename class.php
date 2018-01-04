<?php
class form{
  private $data;

  public function __construct($data = array()){
    $this->data = $data;
  }
  public function input_text($a){
    echo '<p> <label for="'.$a.'">'.$a.'</label> : <input type="text" name="'.$a.'" placeholder="'.$a.'" id="'.$a.'"/></p>';
  }

  public function input_button($a){
    echo '<button type="submit" name="'.$a.'"</button>';
    //echo '<button type="" name="'.$a.'" placeholder="'.$a.'" id="'.$a.'"/>';
  }

  public function input_password($a){
    echo '<p> <label for="'.$a.'">'.$a.'</label> : <input type="password" name="'.$a.'" placeholder="'.$a.'" id="'.$a.'"/></p>';
  }

  public function submit(){
    echo '<p> <button type="submit" name="Submit">Submit</button></p>';
  }

  public function hidden($a){
    echo '<p> <button type="hidden" name="'.$a.'">Submit</button></p>';
  }


  // public function input_radio_yes($a){
  //   echo '<p> <input type="radio" id="YES" name='.$a.'"> <label for="YES">YES</label><p>';
  // }
  //
  // public function input_radio_no($a){
  //   echo '<p> <input type="radio" id="NO" name='.$a.'"> <label for="NO">NO</label><p>';
  // }
}
?>
