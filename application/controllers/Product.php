<?php
Class Product extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->library('pagination');
	}


	//show catalog of product
	function catalog()
	{
		//get list slide only show in page home
		$id = intval($this->uri->rsegment(3));
		$where = array('id' => $id);
		$this->load->model('Catalog_model');
		$catalog = $this->Catalog_model->infoCatalog($where);
		if(!$catalog)
		{
			redirect();
		}
		
		if($catalog[0]->parent_id == 0)
		{
			$where = array('parent_id' => $id);
			$catalogSubs = $this->Catalog_model->getListCatalogWhere($where);
			if(!empty($catalogSubs))
			{
				$catalogSubIds = array();
				foreach ($catalogSubs as $key => $value) 
				{
					$catalogSubIds[] = $value->id;
				}
				$where = $catalogSubIds;
			}else{
				$where = array($id);
			}
		}
		
		$this->data['catalog'] = $catalog;

		$total_rows = $this->Product_model->getCountWhere($where);
		$config['base_url'] = base_url('product/catalog/'.$id);
        $config['total_rows'] = $total_rows;
        $config['per_page'] = "8";
        $config["uri_segment"] = 4;

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
        $this->data['productList'] = $this->Product_model->getProductListWhere($config["per_page"], $this->data['page'], $where);
        
        $this->data['pagination_cre'] = $this->pagination->create_links();
		
		$this->data['title'] = 'Danh sách sản phẩm';		
		$this->data['temp']	= 'site/product/catalog';
		$this->load->view('site/layout', $this->data);
	}

	function search()
	{
        
        $search = $this->input->post('key-search');

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search ;
        $search = str_replace("%20"," ",$search);

        $config = array();
        $config['base_url'] = base_url("product/search/".$search);

        $config['total_rows'] = $this->Product_model->getProductCount($search);
        $config['per_page'] = "8";
        $config["uri_segment"] = 4;
       

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
        
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['total_rows'] = $config['total_rows'];
        $this->data['productList'] = $this->Product_model->getProductSearch($config["per_page"], $this->data['page'], $search);
        $this->data['search'] = $search;
        
        $this->data['pagination_cre'] = $this->pagination->create_links();

        //load view
        $this->data['title'] 		= "Tìm sản phẩm ".$search;
       	$this->data['temp'] = 'site/product/search';
		$this->load->view('site/layout', $this->data);
	}


	
	function view()
	{
		$id = $this->uri->rsegment(3);
		$where = array('id' => $id);
		$product = $this->Product_model->infoProduct($where);
		
		if(!$product)
		{
			redirect();
		}	
		$nameProduct = $product[0]->name;
		$this->data['product'] = $product[0];
		$imageList = json_decode($product[0]->image_list);
		$this->data['imageList'] =$imageList; 

		$where = array('id' => $product[0]->catalog_id);
		$this->load->model('Catalog_model');
		$catalog = $this->Catalog_model->infoCatalog($where);
		$this->data['catalog'] = $catalog[0];

		//get list product like catalog
		$id_catalog = $catalog[0]->id;
		$productLikeCatalog = $this->Product_model->getProductListWhere(5,0,$id_catalog);
		$this->data['productLikeCatalog'] = $productLikeCatalog;

		//update number view of product
		$numview = $product[0]->view + 1;
		$where = array('view' => $numview);
		$this->Product_model->updateProduct($id,$where);

		$this->data['title'] 		= $nameProduct;
		$this->data['temp']	= 'site/product/view';
		$this->load->view('site/layout', $this->data);
	}

	
}