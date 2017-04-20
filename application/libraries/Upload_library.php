<?php
Class Upload_library 
{
	var $CI = '';
	function __construct()
	{
		$this->CI = & get_instance();
	}

	//upload file
	function upload($uploadPath = '', $fileName = '')
	{
		$config = $this->config($uploadPath);
		$this->CI->load->library('upload',$config);

		$file  = $_FILES[$fileName];
		
		$_FILES['userfile']['name']     = $this->randomString($file['name'],10);
		$_FILES['userfile']['type']     = $file['type'];
		$_FILES['userfile']['tmp_name'] = $file['tmp_name']; 
		$_FILES['userfile']['error']    = $file['error'];
		$_FILES['userfile']['size']     = $file['size'];

		if($this->CI->upload->do_upload())
		{
			$data = $this->CI->upload->data();
		}else{
			$data = $this->CI->upload->display_errors();
		}
		return $data;
	}

	//upload muti file
	function upload_file($uploadPath = '', $fileName = '')
	{
		$config =$this->config($uploadPath);

		$file  = $_FILES['image_list'];
		// pre($file,false);
		$count = count($file['name']);

		$image_list = array();
		for($i=0; $i<=$count-1; $i++) 
		{

			$_FILES['userfile']['name']     = $this->randomString($file['name'][$i],10); 
			$_FILES['userfile']['type']     = $file['type'][$i];
			$_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; 
			$_FILES['userfile']['error']    = $file['error'][$i];
			$_FILES['userfile']['size']     = $file['size'][$i];
			$this->CI->load->library('upload', $config);
			if($this->CI->upload->do_upload())
			{
				$data = $this->CI->upload->data();
				$image_list[] = $data['file_name'];
			}  
		}
		return $image_list;
	}

	//config upload
	function config($uploadPath = '')
	{
		$config = array();
		$config['upload_path'] 	= $uploadPath;
		$config['allowed_types'] = 'png|gif|jpg';
		$config['max_size']      = '1000';
		$config['max_width']     = '1028';
		$config['max_height']    = '1028';

		return $config;
	}


	//function rename file upload
	function randomString($fileName, $lenght = 5){
        $ext = pathinfo($fileName,PATHINFO_EXTENSION);
    
    
        $arrCharatect = array_merge(range(0, 9),range('A','Z'),range('a', 'z'));
        $arrCharatect = implode($arrCharatect,'');
        $arrCharatect = str_shuffle($arrCharatect);
    
        $result = substr($arrCharatect,0,$lenght). ".".$ext;
        return $result;
    }
}