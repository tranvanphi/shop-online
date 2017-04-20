<?php 

Class MY_Controller extends CI_Controller
{
	// value send data to view
	public $data = array();

	function __construct()
	{
		parent::__construct();

		$controller = $this->uri->segment(1);
		switch ($controller) 
		{
			case 'admin':
				{
					// process data when access page Admin
					$this->_check_login();
					break;
				}
			default:
				{
				// process data when access page site
				//get catalog
				$this->load->model('Catalog_model');
				$where = array('parent_id' => 0); 
		        $catalogList = $this->Catalog_model->infoCatalog($where);
		        
		        foreach ($catalogList as $row) 
		        {  
		            $where = array('parent_id' => $row->id);
		            $subs = $this->Catalog_model->infoCatalog($where);
		            $row->subs = $subs;
		        }
		        // pre($catalogList,false);
		        $this->data['catalogList'] = $catalogList;

		        $this->load->model('News_model');
		        $newsList = $this->News_model->getNewslist(5,0);
		        $this->data['newsList'] = $newsList;

		        //library cart
		        $this->load->library('cart');
		        $this->data['totalItems'] = $this->cart->total_items();

		        //check login
		        $userLoginId = $this->session->userdata('userLoginId');
		        
		        if($userLoginId)
		        {
		        	$this->load->model('User_model');
		        	$userInfo = $this->User_model->infoUser($userLoginId);
		        	$this->data['userInfo'] = $userInfo;
		        }
				break;
				}
		}
	}


	// check status login of page
	private function _check_login()
	{
		$controller = strtolower($this->uri->rsegment(1));
		$login = $this->session->userdata('login');
		if(!$login && $controller != 'login')
		{
			redirect(Admin_url('login'));
		}
		if($login && $controller == 'login')
		{
			redirect(Admin_url('dashboard'));
		}
	}
}