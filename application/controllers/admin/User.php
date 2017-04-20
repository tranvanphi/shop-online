<?php
Class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('User_model');
	}	



	public function index()
    {
        $this->data['title'] = 'Thành viên';
        //pagination settings
        $config['base_url'] = Admin_url('user/index');
        $config['total_rows'] = $this->db->count_all('user');
        $config['per_page'] = "2";
        $config["uri_segment"] = 4;

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);


        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        
        // get user list
        $this->data['total_rows']   = $config['total_rows'];
        $this->data['userList']     = $this->User_model->getUserlist($config["per_page"], $this->data['page'], null);

        $this->data['pagination_cre'] = $this->pagination->create_links();
        
        $message = $this->session->flashdata('message');
        // load view
        $this->data['temp'] = 'admin/user/index';
		$this->load->view('admin/layout', $this->data);
    }


    //function search user
    function search()
    {
        $this->data['title'] = 'Lọc người dùng';
        
        $search = $this->input->post('search');
        
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search ;
        $search = str_replace("%20"," ",$search);

        $config = array();
        $config['base_url'] = Admin_url("user/search/$search");

        $config['total_rows'] = $this->User_model->getUsercount($search);
        $config['per_page'] = "2";
        $config["uri_segment"] = 5;
       

        //integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        
        $this->data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $this->data['total_rows'] = $config['total_rows'];
        $this->data['userList'] = $this->User_model->getUserlist($config["per_page"], $this->data['page'], $search);
        
        $this->data['pagination_cre'] = $this->pagination->create_links();
        $this->data['search'] = $search;
        $message = $this->session->flashdata('message');
        // load view
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/layout', $this->data);
    }


    // Add and Edit admin
    public function formAction()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->data['title']        = 'Thêm người dùng';
        $id = $this->uri->rsegment('3');
        
        if(isset($id))
        {
            //when edit admin
            $id = intval($id);
            $this->data['title']    = 'Chỉnh sửa người dùng';
    
            $info = $this->User_model->infoUser($id);
            if(!$info)
            {
                // creat message noited
                $this->session->set_flashdata('message', 'Không tồn tại người dùng này !!!');
                redirect(Admin_url('admin'));
            }
            $this->data['info'] = $info;

            if($this->input->post())
            {

                $this->form_validation->set_rules('name', 'Họ và Tên', 'required|min_length[8]');
                $this->form_validation->set_rules('email', 'email', 'required|callback_check_EmailUser_edit');
                $this->form_validation->set_rules('phone', 'số điện thoại', 'required');
                $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

                $password = $this->input->post('password');
                if(!empty($password))
                {
                    $this->form_validation->set_rules('password', 'Mật khẩu', 'min_length[6]');
                    $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'matches[password]');
                }
                if($this->form_validation->run())
                {
                    $id     = $this->input->post('id');
                    $name   = $this->input->post('name');
                    $email   = $this->input->post('email');
                    $phone   = $this->input->post('phone');
                    $address   = $this->input->post('address');
                    $data   = array(
                                'name'      => $name,
                                'email'     => $email,
                                'phone'     => $phone,
                                'address'   => $address
                            );
                    if(!empty($password))
                    {
                        $data['password'] = md5($password);
                    }
                    if($this->User_model->updateUser($id, $data))
                    {
                        // creat message noited
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công !');
                    }else{
                        $this->session->set_flagdata('message', 'Cập nhật dữ liệu không thành công !!!');
                    }
                    // change to page url admin
                    redirect(Admin_url('user'));
                }

            }
        }else
        {
            // when ceate new admin
            if($this->input->post())
            {
                $this->form_validation->set_rules('name', 'Họ và Tên', 'required|min_length[8]');
                $this->form_validation->set_rules('email', 'email', 'required|callback_check_EmailUser');
                $this->form_validation->set_rules('phone', 'số điện thoại', 'required');
                $this->form_validation->set_rules('address', 'Địa chỉ', 'required');
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('repassword', 'Nhập lại mật khẩu', 'required|matches[password]');

                if($this->form_validation->run())
                {
                    $name   = $this->input->post('name');
                    $email   = $this->input->post('email');
                    $phone   = $this->input->post('phone');
                    $address   = $this->input->post('address');
                    $pass = $this->input->post('password');
                    $data = array(
                                'name'      => $name,
                                'email'     => $email,
                                'phone'     => $phone,
                                'address'   => $address,
                                'password'  => md5($pass)
                            );
                    if($this->User_model->addUser($data))
                    {
                        // creat message noited
                        $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
                    }else{
                        $this->session->set_flagdata('message', 'Thêm mới dữ liệu không thành công !!!');
                    }
                    // change to page url admin
                    redirect(Admin_url('user'));
                }
            }
        }

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp']     = 'admin/user/form';
        $this->load->view('admin/layout', $this->data);
    }

    //function check exist when edit user
    public function check_EmailUser_edit()
    {
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $where = array(
            'email' =>$email,
            'id !=' => $id
        );
    
        if($this->User_model->checkExist($where)){
            $this->form_validation->set_message(__FUNCTION__,'Đã tồn tại đỉa chỉ email này rồi !!');
            return false;
        }
        return true;
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

    //function delete admin
    public function delete($id)
    {
        echo $id;
        $info = $this->User_model->infoUser($id);
        if(empty($info))
        {
            $this->session->set_flashdata('message', 'Không tồn tại người dùng này !!!');
            redirect(Admin_url('user'));
        }
        $this->User_model->deleteUser($id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công !!!');
        redirect(Admin_url('user'));
    }
}