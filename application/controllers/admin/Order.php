<?php
Class Order extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Order_model');
	}
}