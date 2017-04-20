<?php
Class AdminGroup extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AdminGroup_model');
	}	

	//get list admin group
	public function index()
	{
		$input 	= array();
		$list 	= $this->AdminGroup_model->get_list($input);
		$total 	= $this->AdminGroup_model->get_total();
		// get content of message
		$message = $this->session->flashdata('message');

		$this->data['title'] 		= 'Nhóm quản trị';
		$this->data['titleArea'] 	= 'Quản trị viên/Quản lý nhóm admin';
		$this->data['total'] 	= $total;
		$this->data['list'] 	= $list;
		$this->data['message'] = $message;

		$this->data['temp'] 	= 'admin/admin/admin_group';
		$this->load->view('admin/layout', $this->data);
	}

}