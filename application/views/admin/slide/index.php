<?php 

	//filer name product
	if(!empty($name) && $name != "NIL")
	{
		$inputNameFiter = cmsInput('text','name','filter_iname',$name,'','','width:155px;');
	}else{
		$inputNameFiter = cmsInput('text','name','filter_iname','','','','width:155px;');
	}
?>
<div class="content content-boxed">
    <!-- Header Tiles -->
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <a class="block block-link-hover3 text-center" href="<?php echo Admin_url('admin/formAction')?>">
                <div class="block-content block-content-full">
                    <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
                </div>
                <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Thêm Slide</div>
            </a>
        </div>
        
        <div class="col-sm-6 col-md-6">
            <a class="block block-link-hover3 text-center" href="#">
                <div class="block-content block-content-full">
                    <div class="h1 font-w700" data-toggle="countTo" data-to="<?php echo $total?>"></div>
                </div>
                <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Số lượng</div>
            </a>
        </div>
    </div>
    <!-- END Header Tiles -->
    <?php $this->load->view('admin/message/index');?>
	<!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-content">
            <table class="js-table-checkable table table-hover">
                <thead>
                    <tr>
                    	<th class="text-center" style="width: 70px;">
                            <label class="css-input css-checkbox css-checkbox-primary remove-margin-t remove-margin-b">
                                <input type="checkbox" id="check-all" name="check-all"><span></span>
                            </label>
                        </th>
                        <th class="text-center">Id</th>
                        <th>Tên slide</th>
                        <th>Hinh ảnh</th>
                        <th class="text-center" style="width: 10%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                	foreach($list as $key => $value):
                ?>
                    <tr>
                    	<td class="text-center">
                            <label class="css-input css-checkbox css-checkbox-primary">
                                <input type="checkbox" id="row_1" name="row_1"><span></span>
                            </label>
                        </td>
                        <td class="text-center"><?php echo $value->id?></td>
                        <td><?php echo $value->name?></td>
                        <td><img src="<?php echo base_url('uploads/slide/').$value->image_link;?>"></td>
                        
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Chỉnh sửa"><a href="<?php echo Admin_url('slide/formAction/'.$value->id);?>"><i class="fa fa-pencil"></i></a></button>
                                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Client"><a href="<?php echo Admin_url('slide/delete/'.$value->id);?>"><i class="fa fa-times"></i></a></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    	
                </tbody>

            </table>
        </div>
    </div>
    <!-- END All Products -->
</div>

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/datatables/jquery.dataTables.min.css">
<!-- Page JS Plugins -->
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- Page JS Code -->
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/pages/base_tables_datatables.js"></script>

<script>
    jQuery(function () {
    	// Init page helpers (Appear + CountTo plugins)
        App.initHelpers(['appear', 'appear-countTo']);

        // Init page helpers (Table Tools helper)
        App.initHelpers('table-tools');
    });
</script>