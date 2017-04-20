<?php

Class Dashboard extends MY_Controller
{
	public function index()
	{
		$this->data['title'] 		= 'Bảng điều khiển';
		$this->data['temp'] = 'admin/dashboard/index';
		$this->load->view('admin/layout', $this->data);
	}
}