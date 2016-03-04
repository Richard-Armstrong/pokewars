<?php
class Users_model extends MY_Model  {

	//Define protected attributes.
	public $protected_attributes = array( 'id');
	public $_table = 'users';
	public $primary_key = 'id';

	public function login($username, $password)
	{
		$sql = "select * from users where username='" . $username . "' and password='" . $password . "'";
		$q = $this->db->query($sql);

		if ($q->num_rows() > 0 )
		{
			$rs = $q->result();
			$retVal = $rs[0];
		}
		else
		{
			$retVal = "Record not found";
		}

		return $retVal;

	}

}

?>
