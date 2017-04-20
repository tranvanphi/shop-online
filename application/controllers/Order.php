<?php 

class Order extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	//get info custom
	function checkout()
	{
		$carts = $this->cart->contents();
		$totalItems = $this->cart->total_items();
		if($totalItems <= 0 )
		{
			echo 'nho hon 0';
			redirect();
		}
		
		//if user logined then get info user
		$userLoginId = 0;
		$user = '';
		if($this->session->userdata('userLoginId'))
		{
			$userLoginId = $this->session->userdata('userLoginId');
			$user = $this->User_model->infoUser($userLoginId);
		}
		$this->data['user'] = $user;


		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post())
		{
			$this->form_validation->set_rules('email', 'Email nhận hàng', 'required|valid_email');
			$this->form_validation->set_rules('name', 'Tên người nhận', 'required|min_length[6]');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'required');
			$this->form_validation->set_rules('phone', 'Số điện thoại', 'required');

			if($this->form_validation->run())
			{
				$payment = 'thanh toán khi nhận hàng';
				$totalAmount = $this->input->post('totalAmount');
				
				$data = array(
					'status' => 0, // chua thanh toan
					'user_id' => $userLoginId,
					'user_email' => $this->input->post('email'),
					'user_name' => $this->input->post('name'),
					'user_phone' => $this->input->post('phone'),
					'user_address' => $this->input->post('address'),
					'amount' => $totalAmount,
					'payment'	=> $payment

					);
				if($data['user_id'] > 0)
				{
					$data1 = array(
							'phone' => $this->input->post('phone'),
							'address' => $this->input->post('address')
						);
					$this->load->model('User_model');
					$this->User_model->updateUser($data['user_id'],$data1);
				}

				// pre($data,false);
				//add data to table transaction
				$this->load->model('Transaction_model');
				$this->Transaction_model->addTransaction($data);
				$transactionId = $this->db->insert_id();

				//add data to table order
				$this->load->model('Order_model');
				foreach ($carts as $row) 
				{
					$data = array(
						'transaction_id' => $transactionId, 
						'product_id' => $row['id'], 
						'qty' 		=> $row['qty'], 
						'amount' 		=> $row['subtotal'], 
						'status' 		=> 0
						);
					$this->Order_model->addOrder($data);
				}
				//delete carts
				// $this->cart->destroy();
				$this->session->set_flashdata('message','ban da dat hang thanh cong');
				redirect(base_url());
			}

		}
		
		
		$this->data['cart'] = $carts;
		$this->data['temp']	= 'site/order/checkout';
		$this->load->view('site/layout', $this->data);
	}
}