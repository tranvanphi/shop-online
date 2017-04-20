<?php

Class Upload extends MY_Controller
{
	function index()
	{
		if($this->input->post('submit'))
      	{
       		$this->load->library('upload_library');
       		$upload_path = './uploads/user';
       		$data = $this->upload_library->upload($upload_path,'image');
 			pre($data,false);
		}
		$this->data['temp'] = 'admin/upload/index';
		$this->load->view('admin/layout',$this->data); 
  
	}


	function upload_file()
	{
		if($this->input->post('submit'))
		{
			$this->load->library('upload_library');
			$upload_path = './uploads/user';
			$data = $this->upload_library->upload_file($upload_path,'image_list');
			pre($data,false);
		}
		// Hien thi view
		$this->data['temp'] = 'admin/upload/index';
		$this->load->view('admin/layout',$this->data); 
	}
	


			



	

}

