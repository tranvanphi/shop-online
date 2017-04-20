<?php
Class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}

	//function check exist user 
	public function check_username()
	{
		$username = $this->input->post('username');
		$where = array('username' => $username);
		if($this->Admin_model->checkExist($where))
		{
			$this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
			return FALSE;
		}return TRUE;
	}

	//get list admin
	public function index()
	{

		$list 	= $this->Admin_model->getList();
		$total 	= $this->Admin_model->countList();
		// get content of message
		$message = $this->session->flashdata('message');

		$this->data['title'] 		= 'Ban quản trị';
		$this->data['total'] 	= $total;
		$this->data['list'] 	= $list;
		$this->data['message'] = $message;

		$this->data['temp'] 	= 'admin/admin/index';
		$this->load->view('admin/layout', $this->data);
	}

	// Add and Edit admin
	public function formAction()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->data['title'] 		= 'Thêm admin';
		$id = $this->uri->rsegment('3');
		
		if(isset($id))
		{
			//when edit admin
			$id = intval($id);
			$this->data['title'] 	= 'Chỉnh sửa admin';
	
			$info = $this->Admin_model->infoAdmin($id);
			if(!$info)
			{
				// creat message noited
				$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này !!!');
				redirect(Admin_url('admin'));
			}
			$this->data['info'] = $info;

			if($this->input->post())
			{

				$this->form_validation->set_rules('name', 'Họ và Tên', 'required|min_length[8]');
				$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_UsernameAdmin_edit');

				$password = $this->input->post('password');
				if(!empty($password))
				{
					$this->form_validation->set_rules('password', 'Mật khẩu', 'min_length[6]');
					$this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'matches[password]');
				}
				if($this->form_validation->run())
				{
					$id 	= $this->input->post('id');
					$name 	= $this->input->post('name');
					$username = $this->input->post('username');
					$data 	= array(
								'name' 		=> $name,
								'username' 	=> $username
							);
					if(!empty($password))
					{
						$data['password'] = md5($password);
					}
					if($this->Admin_model->updateAdmin($id, $data))
					{
						// creat message noited
						$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công !');
					}else{
						$this->session->set_flagdata('message', 'Cập nhật dữ liệu không thành công !!!');
					}
					// change to page url admin
					redirect(Admin_url('admin'));
				}

			}
		}else
		{
			// when ceate new admin
			if($this->input->post())
			{
				$this->form_validation->set_rules('name', 'Họ và Tên', 'required|min_length[8]');
				$this->form_validation->set_rules('username', 'Tài khoản đăng nhập', 'required|callback_check_username');
				$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
				$this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'required|matches[password]');
				$this->form_validation->set_rules('AdminGroup_id', 'Nhóm Admin', 'required');

				if($this->form_validation->run())
				{
					$name = $this->input->post('name');
					$username = $this->input->post('username');
					$pass = $this->input->post('password');
					$group = $this->input->post('AdminGroup_id');
					$data = array(
								'name' 		=> $name,
								'username' 	=> $username,
								'password'	=> md5($pass),
								'admin_group_id' => $group
							);
					if($this->Admin_model->addAdmin($data))
					{
						// creat message noited
						$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
					}else{
						$this->session->set_flagdata('message', 'Thêm mới dữ liệu không thành công !!!');
					}
					// change to page url admin
					redirect(Admin_url('admin'));
				}
			}
		}
		
		$this->load->model('AdminGroup_model');
		$list = $this->AdminGroup_model->getList();
		$this->data['list'] = $list;

		$message = $this->session->flashdata('message');
        $this->data['message'] = $message;

		$this->data['temp'] 	= 'admin/admin/form';
		$this->load->view('admin/layout', $this->data);
	}

	//function delete admin
	public function delete($id)
	{
		echo $id;
		$info = $this->Admin_model->infoAdmin($id);
		if(empty($info))
		{
			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này !!!');
			redirect(Admin_url('admin'));
		}
		$this->Admin_model->deleteAdmin($id);
		$this->session->set_flashdata('message', 'Xóa dữ liệu thành công !!!');
		redirect(Admin_url('admin'));
	}

	//function check exist when edit admin
	public function check_UsernameAdmin_edit()
    {
        $username = $this->input->post('username');
        $id = $this->input->post('id');
        $where = array(
            'username' =>$username,
            'id !=' => $id
        );
    
        if($this->Admin_model->checkExist($where)){
            $this->form_validation->set_message(__FUNCTION__,'Có tên đăng nhập trùng');
            return false;
        }
        return true;
    }

	

	//function logout
	function logout()
	{
		if($this->session->userdata('login'))
		{
			$this->session->unset_userdata('login');
		}redirect(Admin_url('login'));
	}

	

	
}