<?php
Class Cart extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$cart = $this->cart->contents();
		$this->data['cart'] = $cart;

		$this->data['temp'] = 'site/cart/index';
		$this->load->view('site/layout',$this->data);
	}


	function add()
	{
		$this->load->model('Product_model');
		echo $id = $this->uri->rsegment(3);
		$where = array('id' => $id);
		$product = $this->Product_model->infoProduct($where);
		pre($product,false);
		if(!$product)
		{
			redirect();
		}
		
		$qty = 1;
		if($product[0]->discount > 0)
		{
			$price_new = $product[0]->price - $product[0]->discount;
		}else{
			$price_new = $product[0]->price;
		}

		$price = $product[0]->price;

		$total = $product[0]->total - $product[0]->buyed;

		$data = array();
		$data['id'] = $product[0]->id;
		$data['qty'] = $qty;
		$data['name'] = url_title($product[0]->name);
		$data['discount'] = $product[0]->discount;
		$data['price'] = $price_new;
		$data['price_old'] = $price;
		$data['image_list'] = $product[0]->image_list;
		$data['total'] = $total;
		
		pre($data,false);
		$this->cart->insert($data);

		redirect(base_url('cart'));
	}

	function update()
	{
		$cart = $this->cart->contents();
		foreach ($cart as $key => $row) 
		{
			echo $total_qty = $this->input->post('qty_'.$row['id']);
			$data = array();
			$data['rowid'] = $key;
			$data['qty'] = $total_qty;
			$this->cart->update($data);
		}
		redirect(base_url('cart'));

	}


	function delete()
	{
		$id = $this->uri->rsegment(3);
		if($id > 0)
		{
			$cart = $this->cart->contents();
			foreach ($cart as $key => $row) 
			{
				if($row['id'] == $id)
				{
					$data = array();
					$data['rowid'] = $key;
					$data['qty'] = 0;
					$this->cart->update($data);
				}
			}
			
		}else{
			$this->cart->destroy();
		}

		redirect(base_url('cart'));

	}


	

}