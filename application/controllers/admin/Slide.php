<?php
Class Slide extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Slide_model');
	}


	//get list admin
	public function index()
	{

		$list 	= $this->Slide_model->getList();
		$total 	= $this->Slide_model->countList();
		// get content of message
		$message = $this->session->flashdata('message');

		$this->data['title'] 		= 'slide';
		$this->data['total'] 	= $total;
		$this->data['list'] 	= $list;
		$this->data['message'] = $message;

		$this->data['temp'] 	= 'admin/slide/index';
		$this->load->view('admin/layout', $this->data);
	}
}