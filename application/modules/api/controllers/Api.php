<?php
 ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Api extends CI_Controller {
 

    function __construct() {
        parent::__construct();
        $this->load->model('model_api', 'm_api'); 
        $this->load->helper('string');
        
    }


    public function index()	{
	
       return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	

    public function login()
	{
		$this->form_validation->set_rules('username', 'username', 'required|max_length[256]');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]|max_length[256]');
		return Validation::validate($this, '', '', function($token, $output)
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$id = $this->m_api->login($username, $password);
			if ($id != false) {
				$token = array();
				$token['id'] = $id;
				$output['status'] = true;
				$output['username'] = $username;
				$output['token'] = JWT::encode($token, $this->config->item('jwt_key'));
                                $ip = $this->input->ip_address();
                                $output['ip'] = $ip;
            }
			else
			{
				$output['errors'] = '{"type": "invalid"}';
			}
			return $output;
		});
	}
 
         public function register()
	{

		    	$username = $this->input->post('name');
		    	$nohp = $this->input->post('nohp');
			$kota = $this->input->post('kota');
			$id = $this->m_users->register($username, $kota, $nohp);
			$token = array();
				$token['id'] = $id;
				$output['status'] = true;
				$output['nohp'] = $nohp;
				$output['username'] = $username;
                $ip = $this->input->ip_address();
                $output['ip'] = $ip;
                
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($output));
	
	}
}