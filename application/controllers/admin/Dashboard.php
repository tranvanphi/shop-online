<?php

Class Dashboard extends MY_Controller
{
	public function index()
	{

		$this->load->model('Product_model');
		$this->data['productList'] = $this->Product_model->getProductlist(10,0);

		$this->load->model('Transaction_model');
		$this->data['transactionList'] = $this->Transaction_model->getTransactionlist(10,0);


		$this->data['title'] 		= 'Bảng điều khiển';
		$this->data['temp'] = 'admin/dashboard/index';
		$this->load->view('admin/layout', $this->data);

	}
}