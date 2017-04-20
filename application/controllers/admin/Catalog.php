<?php
Class Catalog extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Catalog_model');
		$this->load->library('pagination');
	}

	function index()
	{
		$this->data['title'] = 'Danh mục sản phẩm';

		$config['base_url'] = Admin_url('catalog/index');
        $config['total_rows'] = $this->db->count_all('catalog');
        $config['per_page'] = "10";
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
        $this->data['catalogList'] = $this->Catalog_model->getCataloglist($config["per_page"], $this->data['page'], NULL);
        $this->data['pagination_cre'] = $this->pagination->create_links();
        
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] = 'admin/catalog/index';
		$this->load->view('admin/layout', $this->data);
	}

	// Add and Edit catalog
	public function formAction()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->data['title'] 		= 'Thêm catalog';
		$id = $this->uri->rsegment('3');
		
		if(isset($id))
		{
			//when edit catalog
			$id = intval($id);
			$this->data['title'] 	= 'Chỉnh sửa danh mục';
			$where = array('id' => $id);
			$info = $this->Catalog_model->infoCatalog($where);
			if(!$info)
			{
				// creat message noited
				$this->session->set_flashdata('message', 'Không tồn tại danh mục này !!!');
				redirect(Admin_url('catalog'));
			}
			$this->data['info'] = $info[0];

			if($this->input->post())
			{
				$this->form_validation->set_rules('name', 'Tên danh mục', 'required|callback_checkNameCatalogEdit');
				if($this->form_validation->run())
				{
					$parent_id		= $this->input->post('parent_id');
					$name 			= $this->input->post('name');
					$sort_order 	= $this->input->post('sort_order');
					$data 	= array(
								'name' 		=> $name,
								'parent_id'	=> $parent_id,
								'sort_order'=> $sort_order
							);
					
					if($this->Catalog_model->updateCatalog($id, $data))
					{
						// creat message noited
						$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công !');
					}else{
						$this->session->set_flagdata('message', 'Cập nhật dữ liệu không thành công !!!');
					}
					//change to page url admin
					redirect(Admin_url('catalog'));
				}
			}

		}else
		{
			// when ceate new catalog
			if($this->input->post())
			{
				$this->form_validation->set_rules('name', 'Tên danh mục', 'required|callback_checkNameCatalog');

				if($this->form_validation->run())
				{
					$name = $this->input->post('name');
					$parent_id = $this->input->post('parent_id');
					$sort_order = $this->input->post('sort_order');
					$data = array(
								'name' 		=> $name,
								'parent_id'	=> $parent_id,
								'sort_order' => $sort_order
							);
					if($this->Catalog_model->addCatalog($data))
					{
						// creat message noited
						$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
					}else{
						$this->session->set_flagdata('message', 'Thêm mới dữ liệu không thành công !!!');
					}
					// change to page url admin
					redirect(Admin_url('catalog'));
				}
			}
		}
		
        $where = array('parent_id' => 0); 
        $list = $this->Catalog_model->infoCatalog($where);
		$this->data['list'] 		= $list;

		$this->data['temp'] 	= 'admin/catalog/form';
		$this->load->view('admin/layout', $this->data);
	}


	//function delete catalog
	public function delete($id)
	{
		echo $id;
		$where = array('id' => $id);
		$info = $this->Catalog_model->infoCatalog($where);
		if(empty($info))
		{
			$this->session->set_flashdata('message', 'Không tồn tại danh mục này !!!');
			redirect(Admin_url('catalog'));
		}
		$this->load->model('Product_model');
		$where1 = array('catalog_id' => $id);
		$infoP = $this->Product_model->infoProduct($where1);
		if($infoP)
		{
			$this->session->set_flashdata('message', 'Danh mục này có chứa sản phẩm !!!');
			redirect(Admin_url('catalog'));
		}
		$this->Catalog_model->delete($id);
		$this->session->set_flashdata('message', 'Xóa dữ liệu thành công !!!');
		redirect(Admin_url('Catalog'));
	}


	function checkNameCatalog()
	{
        $name = $this->input->post('name');
        $where = array('name' =>$name);
        if($this->Catalog_model->checkExist($where)){
            $this->form_validation->set_message(__FUNCTION__,'có tên sản phẩm trùng');
            return false;
        }
        return true;
	}


	function checkNameCatalogEdit()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
        $where = array(
            'name' =>$name,
            'id !=' => $id
        );
        if($this->Catalog_model->checkExist($where)){
            $this->form_validation->set_message(__FUNCTION__,'có tên danh mục trùng');
            return false;
        }
        return true;
	}
}