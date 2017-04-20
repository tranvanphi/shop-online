<?php 

class User extends My_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}


	function index()
	{
		if(!$this->session->userdata('userLoginId'))
		{
			redirect(base_url());
		}
		$userLoginId = $this->session->userdata('userLoginId');
		$userInfo = $this->User_model->infoUser($userLoginId);
		if(!$userInfo)
		{
			redirect(base_url());
		}

		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post())
		{
			$password = $this->input->post('password');
			if($password)
			{
				$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
				$this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'required|matches[password]');

			}
			$this->form_validation->set_rules('name', 'Tên', 'required|min_length[6]');
			$this->form_validation->set_rules('gender', 'Giới tính', 'required');

			if($this->form_validation->run())
			{
				$id = $this->input->post('id');
				$data = array(
					'name' => $this->input->post('name'),
					'gender' => $this->input->post('gender')
					);

				if($password)
				{
					$data['password'] = md5($password);
				}

				if($this->User_model->updateUser($id,$data))
				{
					echo 'thanh cong';
				}else{
					echo 'khong thanh cong';
				}
				redirect(base_url('user'));
			}
		}

		$this->data['userInfo'] = $userInfo;
		$this->data['temp']	= 'site/user/index';
		$this->load->view('site/layout', $this->data);
	}



	function register()
	{
		if($this->session->userdata('userLoginId'))
		{
			redirect(base_url('user'));
		}

		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post())
		{
			$this->form_validation->set_rules('name', 'Tên', 'required|min_length[6]');
			$this->form_validation->set_rules('email', 'Email đăng nhập', 'required|valid_email|callback_check_EmailUser');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
			$this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'required|matches[password]');
			// $this->form_validation->set_rules('phone', 'So dien thoai', 'required');
			// $this->form_validation->set_rules('address', 'Dia chi', 'required|min_length[10]');

			if($this->form_validation->run())
			{
				$password = md5($this->input->post('password'));
				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					// 'phone' => $this->input->post('phone'),
					// 'address' => $this->input->post('address'),
					'password' => $password
					);
				if($this->User_model->addUser($data))
				{
					echo 'thanh cong';
				}else{
					echo 'khong thanh cong';
				}
				redirect(base_url());
			}

		}


		$this->data['temp']	= 'site/user/register';
		$this->load->view('site/layout', $this->data);
	}

	//function check exist user 
    public function check_EmailUser()
    {
        $email = $this->input->post('email');
        $where = array('email' => $email);
        if($this->User_model->checkExist($where))
        {
            $this->form_validation->set_message(__FUNCTION__, 'Email đã tồn tại');
            return FALSE;
        }return TRUE;
    }

    //function check login
    function login()
    {
    	if($this->session->userdata('userLoginId'))
		{
			redirect(base_url('user'));
		}
    	$this->data['title'] 		= 'Đăng nhập';
		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post())
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
			$this->form_validation->set_rules('login', 'login','callback_CheckLogin');
			if($this->form_validation->run())
			{
				//get info user
				$user = $this->_getUserInfo();
				$this->session->set_userdata('userLoginId',$user->id);
				redirect(base_url());
			}
		}

    	$this->data['temp']	= 'site/user/login';
		$this->load->view('site/layout', $this->data);
    }

    //function check username and password
	public function CheckLogin()
	{
		$user = $this->_getUserInfo();
		if($user)
		{
			return true;
		}else{
			$this->form_validation->set_message(__FUNCTION__, 'Đăng nhập không thành công');
			return false;
		}
		
	}

	//get info user after login success
	private function _getUserInfo()
	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$this->load->model('User_model');
		$where = array(
					'email' => $email,
					'password' => $password	
				);
		$user = $this->User_model->infoUserLogin($where);
		return $user;
	}

	//function logout
	function logout()
	{
		if($this->session->userdata('userLoginId'))
		{
			$this->session->unset_userdata('userLoginId');
		}redirect(base_url());
	}

	function address()
	{
		if(!$this->session->userdata('userLoginId'))
		{
			redirect(base_url());
		}
		$userLoginId = $this->session->userdata('userLoginId');
		$userInfo = $this->User_model->infoUser($userLoginId);
		if(!$userInfo)
		{
			redirect(base_url());
		}


		$this->load->library('form_validation');
		$this->load->helper('form');

		if($this->input->post())
		{
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'required');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'required');
			if($this->form_validation->run())
			{
				$id = $this->input->post('id');
				$data = array(
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address')
				);

				if($this->User_model->updateUser($id,$data))
				{
					echo 'thanh cong';
				}else{
					echo 'khong thanh cong';
				}
				redirect(base_url('user/address'));
			}
		}

		$this->data['userInfo'] = $userInfo;
		$this->data['temp']	= 'site/user/bookaddress';
		$this->load->view('site/layout', $this->data);
	}

	function listorder()
	{
		if(!$this->session->userdata('userLoginId'))
		{
			redirect(base_url());
		}
		$userLoginId = $this->session->userdata('userLoginId');
		$userInfo = $this->User_model->infoUser($userLoginId);
		if(!$userInfo)
		{
			redirect(base_url());
		}

		$this->load->model('transaction_model');
		$transaction = $this->transaction_model->getwhere_transaction($userInfo->id);



		
		$this->data['transaction'] = $transaction;
		$this->data['userInfo'] = $userInfo;
		$this->data['temp']	= 'site/user/myorder';
		$this->load->view('site/layout', $this->data);
	}

	
}