<?php 
	$xhtml = '';
	if(isset($message))
	{
		$xhtml .= "<div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                        <p>The <a class='alert-link' href='javascript:void(0)'>".$message."</p>
                    </div>";
	}
	echo $xhtml;
