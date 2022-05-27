<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Model_api extends CI_Model {

 public function __construct() {
        parent::__construct();
    }

    
        public function login($email, $password)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			$result = $query->result();
			if (Password::validate_password($password, $result[0]->password))
			{
                            return $result[0]->id;
				
			}
			return false;
		}
		return false;
	}
}

/* End of file users.php */
/* Location: ./application/models/users.php */