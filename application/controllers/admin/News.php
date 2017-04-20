<?php
Class News extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('News_model');
	}


	public function index()
    {
        $this->data['title'] = 'Tin tuc';
        //pagination settings
        $config['base_url'] = Admin_url('news/index');
        $config['total_rows'] = $this->db->count_all('news');
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
        
        // get news list
        $this->data['total_rows'] = $config['total_rows'];
        $this->data['newsList'] = $this->News_model->getNewslist($config["per_page"], $this->data['page'], NULL);
        
        $this->data['pagination_cre'] = $this->pagination->create_links();
        

        
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        // load view
        $this->data['temp'] = 'admin/news/index';
		$this->load->view('admin/layout', $this->data);
    }


   	//function search news
    function search()
    {
        $this->data['title'] = 'Lọc tin tuc';
        
        $search = $this->input->post('search');
        
        $search = ($this->uri->segment(4)) ? $this->uri->segment(4) : $search ;
        $search = str_replace("%20"," ",$search);

        $config = array();
        $config['base_url'] = Admin_url("news/search/$search");

        $config['total_rows'] = $this->News_model->getNewscount($search);
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
        $this->data['newsList'] = $this->News_model->getNewslist($config["per_page"], $this->data['page'], $search);
        
        $this->data['pagination_cre'] = $this->pagination->create_links();
        $this->data['search'] = $search;
        $message = $this->session->flashdata('message');
        // load view
        $this->data['temp'] = 'admin/news/index';
        $this->load->view('admin/layout', $this->data);
    }



    // Add and Edit admin
    public function formAction()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->data['title']        = 'Thêm bài viết';
        $id = $this->uri->rsegment('3');
        
        if(isset($id))
        {
            //when edit admin
            $id = intval($id);
            $this->data['title']    = 'Chỉnh sửa bài viết';
    
            $info = $this->News_model->infoNews($id);
            if(!$info)
            {
                // creat message noited
                $this->session->set_flashdata('message', 'Không tồn tại bài viết này !!!');
                redirect(Admin_url('admin'));
            }
            $this->data['info'] = $info;

            if($this->input->post())
            {
                $this->form_validation->set_rules('title', 'tiêu đề bài viết', 'required|min_length[6]');
                $this->form_validation->set_rules('content', 'nội dung bài viết', 'required');
          

                if($this->form_validation->run())
                {
                    $title   = $this->input->post('title');
                    $content   = $this->input->post('content');
                    $intro   = $this->input->post('intro');


                    $this->load->library('upload_library');
	                $uploadPath = './uploads/news';
	                $image_link = '';
	               	$image_link = $this->upload_library->upload($uploadPath, 'image_link');
	               	$image_link = $image_link['file_name'];

                    $data = array(
                                'title'      	=> $title,
                                'content'     	=> $content,
                                'intro'     	=> $intro,
                                'image_link' 	=> $image_link
                            );
                    if($this->News_model->updateNews($id,$data))
                    {
                        $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công !');
                    }else{
                        $this->session->set_flagdata('message', 'Cập nhật dữ liệu không thành công !!!');
                    }
                    // change to page url admin
                    redirect(Admin_url('news'));
                }
            }
        }else
        {
            // when ceate new admin
            if($this->input->post())
            {
                $this->form_validation->set_rules('title', 'tiêu đề bài viết', 'required|min_length[6]');
                $this->form_validation->set_rules('content', 'nội dung bài viết', 'required');
          

                if($this->form_validation->run())
                {
                    $title   = $this->input->post('title');
                    $content   = $this->input->post('content');
                    $intro   = $this->input->post('intro');


                    $this->load->library('upload_library');
	                $uploadPath = './uploads/news';
	                $image_link = '';
	               	$image_link = $this->upload_library->upload($uploadPath, 'image_link');
	               	$image_link = $image_link['file_name'];

                    $data = array(
                                'title'      	=> $title,
                                'content'     	=> $content,
                                'intro'     	=> $intro,
                                'image_link' 	=> $image_link
                            );
                    if($this->News_model->addNews($data))
                    {
                        $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công !');
                    }else{
                        $this->session->set_flagdata('message', 'Thêm mới dữ liệu không thành công !!!');
                    }
                    // change to page url admin
                    redirect(Admin_url('news'));
                }
            }
        }

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp']     = 'admin/news/form';
        $this->load->view('admin/layout', $this->data);
    }


}