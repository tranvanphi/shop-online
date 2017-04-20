<?php 

	//filer name product
	if(!empty($name) && $name != "NIL")
	{
		$inputNameFiter = cmsInput('text','name','filter_iname',$name,'','','width:155px;');
	}else{
		$inputNameFiter = cmsInput('text','name','filter_iname','','','','width:155px;');
	}

	//filter catalog
	if(!empty($catalog_id))
	{
		$selectFiler = cmsSelectBoxChild('catalog', $catalog,$catalog_id);
	}else{
		$selectFiler = cmsSelectBoxChild('catalog', $catalog);
	}
?>
<div class="content content-boxed">
    <!-- Header Tiles -->
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <a class="block block-link-hover3 text-center" href="<?php echo Admin_url('product/addProduct')?>">
                <div class="block-content block-content-full">
                    <div class="h1 font-w700 text-success"><i class="fa fa-plus"></i></div>
                </div>
                <div class="block-content block-content-full block-content-mini bg-gray-lighter text-success font-w600">Thêm sảm phẩm</div>
            </a>
        </div>
        
        <div class="col-sm-6 col-md-6">
            <a class="block block-link-hover3 text-center" href="#">
                <div class="block-content block-content-full">
                    <div class="h1 font-w700" data-toggle="countTo" data-to="<?php echo $total_rows?>"></div>
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
        	<form class="list_filter form" action="<?php echo Admin_url('product/search')?>" method="post">
        		<table class="table table-header-bg">
        		<tbody>
						
					<tr>
						
						<td class="text-left" style="width: 5%;"><label for="filter_id">Tên</label></td>
						<td class="text-left" style="width: 20%;">
							<?php echo $inputNameFiter?>
						</td>

						<td class="text-left" style="width: 10%;"><label for="filter_status">Thể loại</label></td>
						<td class="text-left" style="width: 20%;">
							<?php echo $selectFiler?>
						</td>

						<td class="text-right">
						<input type="submit" class="btn btn-primary" value="Lọc">

						<input type="reset" class="btn btn-success" value="Reset" onclick="window.location.href = '<?php echo Admin_url('product/index')?>'; ">

                        <a url="<?php echo Admin_url('product/delAll');?>" class="btn btn-dangger" id="submit">Xoá hết</a>
						</td>	
					</tr>

				</tbody>
				</table>
        	</form>
            <table class="js-table-checkable table table-hover">
                <thead>
                    <tr>
                    	<th class="text-center" style="width: 70px;">
                            <label class="css-input css-checkbox css-checkbox-primary remove-margin-t remove-margin-b">
                                <input type="checkbox" id="check-all" name="check-all"><span></span>
                            </label>
                        </th>
                        <th class="text-center">Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th class="hidden-xs">Ngày thêm</th>
                        <th class="hidden-xs" style="width: 15%;">Trạng thái</th>
                        <th class="text-center" style="width: 10%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                	foreach($productList as $key => $value):
                	$status = ($value->total)-($value->buyed) > 0 ? "<span class='label label-info'>Còn hàng</span>":"<span class='label label-danger'>Hết hàng</span>";

                	$price = '';
                	if($value->discount > 0)
                	{
                		$price .= number_format($value->price - $value->discount);
                		
                	}else{
                		$price .= number_format($value->price);
                	}
                ?>
                    <tr class="row_<?php echo $value->id?>">
                    	<td class="text-center">
                            <label class="css-input css-checkbox css-checkbox-primary">
                                <input type="checkbox" id="row_<?php echo $value->id?>" name="id[]" value="<?php echo $value->id?>"><span></span>
                            </label>
                        </td>
                        <td class="text-center"><?php echo $value->id?></td>
                        <td class="font-w600"><?php echo $value->name?></td>
                        <td class="font-w600">
                        	<?php echo $price?>
                        </td>
                        <td class="hidden-xs text-center"><?php echo $value->created?></td>
                        
                        <td class="hidden-xs">
                            <?php echo $status?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit Client"><a href="<?php echo Admin_url('product/editProduct/'.$value->id);?>"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Client"><a href="<?php echo Admin_url('product/delete/'.$value->id);?>"><i class="fa fa-times"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    	
                </tbody>

            </table>
            <nav class="text-right">
                <?php echo $pagination_cre?>
            </nav>
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

        $('#submit').click(function(){
            if(!confirm('Bạn chắc chắn muốn xóa tất cả dữ liệu ?'))
            {
                return false;
            }

            var ids = new Array();
            $('[name="id[]"]:checked').each(function()
            {
                ids.push($(this).val());
            });
            var url = $(this).attr('url');
            $.ajax({
                url: url,
                type: 'POST',
                data : {'ids': ids},
                success: function()
                {
                    $(ids).each(function(id, val)
                    {
                        //xoa cac the <tr> chua danh muc tung ung
                        $('tr.row_'+val).fadeOut();         
                    });
                }
                
            })
            return false;
        });
    });
</script>