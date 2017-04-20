<?php
//get link public
function PUBLIC_URL($url = null)
{
	$flag = '';
	if($url == null)
	{
		$flag = base_url('public/'.$url);
	}else
	{
		$flag = base_url('public/'.$url.'/');
	}
	return $flag;
}


//get link admin
function Admin_url($url = '')
{
	$flag = '';
	if($url == null)
	{
		$flag = base_url('admin/'.$url);
	}else
	{
		$flag = base_url('admin/'.$url.'/');
	}
	return $flag;
}


//function print array
function pre($array, $exit = true)
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	if ($exit) 
	{
		die('exit progam');
	}
}


//function create btn
function cmsButton($name, $link, $icon, $type= 'new')
{
	$xhtml = '<li>';
	if($type == 'new')
	{
		$xhtml .= 	'<a href="'.$link.'">
						<img src="'.$icon.'">
						<span>'.$name.'</span>
					</a>';
	}else if($type == 'submit')
	{
		$xhtml .= 	'<a href="#" onclick="javascript:submitForm(\''.$link.'\')">
						<img src="'.$icon.'">
						<span>'.$name.'</span>
					</a>';
	}

	$xhtml .= '</li>';
	return $xhtml;
}


//function create icon for button
function cmsIcon($name = '')
{
	$xhtml = '';
	if($name != '')
	{
		$xhtml .= PUBLIC_URL('admin').'images/icons/control/16/'.$name.'.png';
	}
	return $xhtml;
}

//function create link for button
function cmsCreatelink($controller = 'admin',$name)
{	
	$temp = "".$controller."/".$name."";
	$xhtml = Admin_url($temp);
	return $xhtml;
}

// Create Input
function cmsInput($type, $name, $id, $value = null, $class = 'form-control', $size = null,$style = null){
	$strSize	=	($size==null) ? '' : "size='$size'";
	$style		=	($style==null) ? '' : "style='$style'";
	$strClass	=	($class==null) ? '' : "class='$class'";
	$strValue	=	($value==null) ? '' : "value='$value'";
	
	$xhtml = "<input name='$name' id='$id' type='$type' $strValue $strClass $strSize $style>";
	return $xhtml;
}


// Create Selectbox
function cmsSelectbox($name, $class='form-control',$id="", $arrValue, $keySelect = 'default',$style = null)
{
	
	$xhtml = '<select style="'.$style.'" name="'.$name.'" id="'.$id.'" class="'.$class.'" >';
	foreach($arrValue as $key => $value){
		if($key == $keySelect && is_numeric($keySelect)){
			$xhtml .= '<option selected="selected" value = "'.$key.'">'.$value.'</option>';
		}else{
			$xhtml .= '<option value = "'.$key.'">'.$value.'</option>';
		}
	}
	$xhtml .= '</select>';
	return $xhtml;
	
}

// Create Selectbox have childrent
function cmsSelectBoxChild($name, $arrValue, $keySelect = 'default')
{
	$xhtml = '<select name='.$name.'><option value=""></option>';
	foreach($arrValue as $key => $value)
	{
		$xhtml .= '<optgroup label="'.$value->name.'">';
		if(count($value->subs) > 0){
			foreach ($value->subs as $ke => $va) 
			{
				if($va->id == $keySelect && is_numeric($keySelect))
				{
					$xhtml .= '<option selected="selected" value="'.$va->id.'">'.$va->name.'</option>';			
				}else{
					$xhtml .= '<option value="'.$va->id.'">'.$va->name.'</option>';
				}
			}
	
		}
		$xhtml .= '</optgroup >';
	}
	$xhtml .= '</select>';
	return $xhtml;
}



function cmsImage($array,$type = 'product/')
{
	$url = base_url('uploads/').$type;
	$xhtml = '';
	foreach ($array as $key => $value) 
	{
		$xhtml .= "<div class='img_thumb' alt='".$value."'>
					    <img class='img-responsive' src='".$url.$value."' alt='".$value."'>
					    
					</div>";
	}
	return $xhtml;
}

