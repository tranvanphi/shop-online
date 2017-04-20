<?php

Class Home extends MY_Controller
{
	function index()
	{
		//get list slide only show in page home
		$this->load->model('Slide_model');
		$slideList = $this->Slide_model->getList();

		// get product new add
		$this->load->model('Product_model');
		$productNew = $this->Product_model->getProductlist(6,0);

		//get product catalog
		//điện tử
		$id_Catalog3 = 39;
		$where = array('parent_id' => $id_Catalog3);
		$catalogSubs = $this->Catalog_model->getListCatalogWhere($where);
		if(!empty($catalogSubs))
		{
			$catalogSubIds = array();
			foreach ($catalogSubs as $key => $value) 
			{
				$catalogSubIds[] = $value->id;
			}
			$where3 = $catalogSubIds;
		}else{
			$where3 = array($id);
		}
		$productCatalog3 = $this->Product_model->getProductListWhere(6,0,$where3);
		$infoCatalog3 = $this->Catalog_model->infoCatalog(array('id'=>$id_Catalog3));

		//điện tử
		$id_Catalog1 = 40;
		$where = array('parent_id' => $id_Catalog1);
		$catalogSubs = $this->Catalog_model->getListCatalogWhere($where);
		if(!empty($catalogSubs))
		{
			$catalogSubIds = array();
			foreach ($catalogSubs as $key => $value) 
			{
				$catalogSubIds[] = $value->id;
			}
			$where1 = $catalogSubIds;
		}else{
			$where1 = array($id);
		}
		$productCatalog1 = $this->Product_model->getProductListWhere(6,0,$where1);
		$infoCatalog1 = $this->Catalog_model->infoCatalog(array('id'=>$id_Catalog1));

		//vi tính
		$id_Catalog2 = 41;
		$where = array('parent_id' => $id_Catalog2);
		$catalogSubs = $this->Catalog_model->getListCatalogWhere($where);
		if(!empty($catalogSubs))
		{
			$catalogSubIds = array();
			foreach ($catalogSubs as $key => $value) 
			{
				$catalogSubIds[] = $value->id;
			}
			$where2 = $catalogSubIds;
		}else{
			$where2 = array($id);
		}
		$productCatalog2 = $this->Product_model->getProductListWhere(6,0,$where2);
		$infoCatalog2 = $this->Catalog_model->infoCatalog(array('id'=>$id_Catalog2));

		$this->data['productNew'] = $productNew;
		$this->data['productCatalog3'] = $productCatalog3;
		$this->data['infoCatalog3'] = $infoCatalog3;
		$this->data['productCatalog1'] = $productCatalog1;
		$this->data['infoCatalog1'] = $infoCatalog1;
		$this->data['productCatalog2'] = $productCatalog2;
		$this->data['infoCatalog2'] = $infoCatalog2;
		$this->data['slideList'] = $slideList;


		$message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
		$this->data['temp']	= 'site/home/index';
		$this->load->view('site/layout', $this->data);
	}
}