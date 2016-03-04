<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

  public function process($url_json_string)
  {
    echo "<br>URL JSON String " . $url_json_string;
    $json_string = urldecode($url_json_string);
    echo "<br>JSON String " . $json_string;

    $stdClass = json_decode($json_string);
    echo "<br>";
    print_r($stdClass);
    echo "<br>After<br>";
    $array = json_decode(json_encode($stdClass));

    if (array_key_exists('command', $array))
    {
      $the_command = $array->command; # $array['command'];
      switch($the_command)
      {
      	case 'login':
          $username = $array->username;
          $password = $array->password;

          $this->load->model('users_model');

          $user = $this->users_model->login($username, $password);

          print_r($user);
          break;
      }
    }
    else {
      echo "Error! No command exists!";
      print_r($array);

    }


  }

  public function test_process()
  {
    $jstring = json_encode(array('command' => 'login', 'username' => 'admin', 'password' => 'password'));
    print_r($jstring);
    echo "<br><br>";
    $test = $this->process($jstring);

  }


}
