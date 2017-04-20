<?php 

Class Login extends MY_Controller
{
	function index()
	{
		$this->data['title'] 		= 'Đăng nhập hệ thống';
		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post())
		{
			$this->form_validation->set_rules('login-username', 'Tên đăng nhập', 'required');
			$this->form_validation->set_rules('login-password', 'Mật khẩu', 'required');
			$this->form_validation->set_rules('login', 'login','callback_check_login');
			if($this->form_validation->run())
			{
				$login = $this->session->set_userdata('login',true);
				redirect(Admin_url('dashboard'));
			}
		}
		$this->load->view('admin/login/index',$this->data);
	}

	//function check username and password
	public function check_login()
	{
		$username = $this->input->post('login-username');
		$password = md5($this->input->post('login-password'));
		$this->load->model('Admin_model');
		$where = array(
					'username' => $username,
					'password' => $password	
				);
		if($this->Admin_model->checkExist($where))
		{
			return true;
		}else{
			$this->form_validation->set_message(__FUNCTION__, 'Đăng nhập không thành công');
			return false;
		}
		
	}
}