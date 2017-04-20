<?php
Class Product extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('Product_model');
		$this->load->model('Catalog_model');
	}


	public function index()
    {
        $this->data['title'] = 'Sản phẩm';
        //pagination settings
        $config['base_url'] = Admin_url('product/index');
        $config['total_rows'] = $this->db->count_all('product');
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
        $this->data['productList'] = $this->Product_model->getProductlist($config["per_page"], $this->data['page'], NULL);
        
        $this->data['pagination_cre'] = $this->pagination->create_links();
        

        //load data catalog
        $this->load->model('Catalog_model');
        $where = array('parent_id' => 0); 
        $catalog = $this->Catalog_model->infoCatalog($where);
        
        foreach ($catalog as $row) 
        {  
            $where = array('parent_id' => $row->id);
            $subs = $this->Catalog_model->infoCatalog($where);
            $row->subs = $subs;
        }
        $this->data['catalog'] = $catalog;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        // load view
        $this->data['temp'] = 'admin/product/index';
		$this->load->view('admin/layout', $this->data);
    }
    

    // filter dat when pagination
    function search()
    {
        $this->data['title'] = 'Lọc sản phẩm';
        // get search string
        $name        = ($this->input->post("name"))? $this->input->post("name") : "NIL";  
        $catalog_id  = ($this->input->post("catalog"))? $this->input->post("catalog") : "NIL";
       	$searchTemp  = array('name' => $name, 'catalog_id' => $catalog_id);
        // pre($searchTemp,false);
        $tempURL = '';
        foreach ($searchTemp as $key => $value) {
            $tempURL .= $key.':'.$value.'-';
        }
        $search = substr($tempURL,0,-1);

        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search ;
        $posiHyphen        = strpos($search,'-');

        $name1   = substr($search,5,$posiHyphen-5);
        $catalog_id1 = substr($search,($posiHyphen+12));

        $filter = array(
                            '0' => $name1,
                            '1' => $catalog_id1
                        );
        $this->data['name'] = $name1;
        $this->data['catalog_id'] = $catalog_id1;
        // pagination settings
        $config = array();
        $config['base_url'] = Admin_url("product/search/$search");

        $config['total_rows'] = $this->Product_model->getCountproductsearch($filter);
        $config['per_page'] = "3";
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

        // get books list
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['productList'] = $this->Product_model->get_product_search($config['per_page'], $this->data['page'], $filter);

        $this->data['pagination_cre'] = $this->pagination->create_links();

        //load data catalog
        $this->load->model('Catalog_model');
        $where = array('parent_id' => 0); 
        $catalog = $this->Catalog_model->infoCatalog($where);
        
        foreach ($catalog as $row) 
        {
           
            $where = array('parent_id' => $row->id);
            $subs = $this->Catalog_model->infoCatalog($where);
            $row->subs = $subs;
        }
        $this->data['catalog'] = $catalog;
        //load view
       	$this->data['temp'] = 'admin/product/index';
		$this->load->view('admin/layout', $this->data);
    }


    //add product
    function addProduct()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->data['title'] = 'Thêm sản phẩm';
        // pre($_FILES,false);
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên sản phẩm', 'required|min_length[8]|callback_checkNameproduct');
            $this->form_validation->set_rules('catalog_id', 'Danh mục sản phẩm', 'required');
            $this->form_validation->set_rules('price', 'Giá sản phẩm', 'required');
            $this->form_validation->set_rules('total', 'Số lượng', 'required');
            if($this->form_validation->run())
            {
                $name       = $this->input->post('name');
                $content    = $this->input->post('content');
                // $content    = str_replace("","Peter",$content);
                $discount   = $this->input->post('discount');
                $warranty   = $this->input->post('warranty');
                $catalog_id = $this->input->post('catalog_id');
                $price      = $this->input->post('price');
                $total      = $this->input->post('total');
                
                $this->load->library('upload_library');
                $uploadPath = './uploads/product';
                $images_list = array();
                $images_list = $this->upload_library->upload_file($uploadPath, 'image_list');
                $images_list = json_encode($images_list);

                $data = array(
                        'name'       => $name,
                        'content'    => $content,
                        'catalog_id' => $catalog_id,
                        'warranty'   => $warranty,
                        'discount'   => $discount,
                        'image_list' => $images_list,
                        'price'      => $price,
                        'total'      => $total
                    );
               
                if($this->Product_model->addProduct($data))
                {
                    // creat message noited
                    $this->session->set_flashdata('message', 'Thêm mới sản phẩm thành công !');
                }else{
                    $this->session->set_flashdata('message', 'Thêm mới sản phẩm không thành công !!!');
                }
                //change to page url admin
                redirect(Admin_url('product'));
            }
        }
        //load data catalog
        $this->load->model('Catalog_model');
        $where = array('parent_id' => 0); 
        $catalog = $this->Catalog_model->infoCatalog($where);
        
        foreach ($catalog as $row) 
        {  
            $where = array('parent_id' => $row->id);
            $subs = $this->Catalog_model->infoCatalog($where);
            $row->subs = $subs;
        }
        $this->data['catalog'] = $catalog;

        $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/layout', $this->data);
    }


    function editProduct($id)
    {
        $id = $this->uri->rsegment(3);
        $where = array('id' => $id);
        $info = $this->Product_model->infoProduct($where);
        if(empty($info))
        {
            $this->session->set_flashdata('message','không tồn tại sản phẩm này!!!');
            redirect(Admin_url('product'));
        }
        $this->data['info'] = $info[0];

        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->data['title'] = 'Chỉnh sửa sản phẩm';
        
        $where = array('parent_id' => 0); 
        $catalog = $this->Catalog_model->infoCatalog($where); 
        foreach ($catalog as $row) 
        {  
            $where = array('parent_id' => $row->id);
            $subs = $this->Catalog_model->infoCatalog($where);
            $row->subs = $subs;
        }

        $this->data['catalog'] = $catalog;
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Tên sản phẩm', 'required|min_length[8]|callback_checkNameproductEdit');

            if($this->form_validation->run())
            {
                $name       = $this->input->post('name');
                $content    = $this->input->post('content');
                $discount   = $this->input->post('discount');
                $warranty   = $this->input->post('warranty');
                $catalog_id = $this->input->post('catalog_id');
                $price      = $this->input->post('price');
                $total      = $this->input->post('total');
                
                $data = array(
                        'name'       => $name,
                        'content'    => $content,
                        'catalog_id' => $catalog_id,
                        'warranty'   => $warranty,
                        'discount'   => $warranty,
                        'price'      => $price,
                        'total'      => $total
                    );

                $this->load->library('upload_library');
                $uploadPath = './uploads/product';
                $images_list = array();
                $images_list = $this->upload_library->upload_file($uploadPath, 'image_list');
        
                if(count($images_list) > 0)
                {
                    $imgremove = $this->input->post('imglistremove');
                    $imgremove = explode(',', $imgremove);
                    foreach ($imgremove as $key => $value) {
                        $link = $_SERVER['DOCUMENT_ROOT'].'\www\shop_sport\uploads\product/'.$value;
                        if(file_exists($link))
                        {
                            unlink($link);
                        }    
                    }

                    $images_list = json_encode($images_list);
                    $data['image_list'] = $images_list;
                }
                
                if($this->Product_model->updateProduct($id,$data))
                {
                    // creat message noited
                    $this->session->set_flashdata('message', 'Cập nhật sản phẩm thành công !');
                }else{
                    $this->session->set_flashdata('message', 'Cập nhật sản phẩm không thành công !!!');
                }
                //change to page url admin
                redirect(Admin_url('product'));
            }
        }


        $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function delete($id)
    {
        $where = array('id' => $id);
        $info = $this->Product_model->infoProduct($where);
        if(empty($info))
        {
            $this->session->set_flashdata('message','không tồn tại sản phẩm này!!!');
            redirect(Admin_url('product'));
        }
        // pre($info,false);
        $img = json_decode($info[0]->image_list);
        if(is_array($img) || is_object($img))
        {
            foreach ($img as $key => $value) 
            {
                $value;
                $link = $_SERVER['DOCUMENT_ROOT'].'\www\shop_sport\uploads\product/'.$value;
                if(file_exists($link))
                {
                    unlink($link);
                } 
            }
        }
        

        $this->Product_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công !!!');
        redirect(Admin_url('product'));
    }

    function delAll()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $k => $v) 
        {
            $this->delete($v);
        }

    }

    function checkNameproduct()
    {
        $name = $this->input->post('name');
        $where = array(
            'name' =>$name
        );
        if($this->Product_model->checkExist($where)){
            $this->form_validation->set_message(__FUNCTION__,'có tên sản phẩm trùng');
            return false;
        }
        return true;
    }

    function checkNameproductEdit()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $where = array(
            'name' =>$name,
            'id !=' => $id
        );
        if($this->Product_model->checkExist($where)){
            $this->form_validation->set_message(__FUNCTION__,'có tên san pham trùng');
            return false;
        }
        return true;
    }




}