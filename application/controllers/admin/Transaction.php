<?php
Class Transaction extends My_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('Transaction_model');
	}


	function index()
	{
		$this->data['title'] = 'Giao dịch';
        //pagination settings
        $config['base_url'] = Admin_url('transaction/index');
        $config['total_rows'] = $this->db->count_all('transaction');
        $config['per_page'] = "3";
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
        
        // get product list
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['transactionList'] = $this->Transaction_model->getTransactionlist($config["per_page"], $this->data['page']);
        
        $this->data['pagination_cre'] = $this->pagination->create_links();
        

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        // load view
        $this->data['temp'] = 'admin/transaction/index';
		$this->load->view('admin/layout', $this->data);
	}

	function view($id)
	{
		$this->load->model('Order_model');
		$infoTransaction = $this->Transaction_model->infoTransaction($id);
		foreach ($infoTransaction as $row) 
		{
			$product = $this->Order_model->infoOrder($id);
			$row->products = $product;
		}
		$this->data['infoTransaction'] = $infoTransaction;

		$this->load->view('admin/Transaction/view',$this->data);
	}


	//function search user
    function search()
    {
        $this->data['title'] = 'Tìm giao dịch';
        
        $search = $this->input->post('search');
        
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search ;
        $search = str_replace("%20"," ",$search);

        $config = array();
        $config['base_url'] = Admin_url("transaction/search/$search");

        $config['total_rows'] = $this->Transaction_model->getTransactioncount($search);
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
        $this->data['transactionList'] = $this->Transaction_model->getTransactionSearch($config["per_page"], $this->data['page'], $search);
        
        $this->data['pagination_cre'] = $this->pagination->create_links();
        $this->data['search'] = $search;
        $message = $this->session->flashdata('message');
        // load view
        $this->data['temp'] = 'admin/transaction/index';
        $this->load->view('admin/layout', $this->data);
    }


	function delete($id)
    {
        $where = array('id' => $id);
        $info = $this->Transaction_model->infoTransaction($where);
        if(empty($info))
        {
            $this->session->set_flashdata('message','không tồn tại sản phẩm này!!!');
            redirect(Admin_url('Transaction'));
        }
        

        $this->Transaction_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công !!!');
        redirect(Admin_url('Transaction'));
    }

    function delAll()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $k => $v) 
        {
            $this->delete($v);
        }

    }

    function update()
    {
    	$id = $this->input->post('id');
    	$status = $this->input->post('status');
    	if($status == 0){
    		$data = array('status' => 1);
    	}else{
    		$data = array('status' => 0);
    	}
    	$this->Transaction_model->updateTransaction($id,$data);
    	redirect(Admin_url('Transaction'));
    }
}