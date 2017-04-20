<?php 
    //filer in user
    if(!empty($search) && $search != "NIL")
    {
        $inputSearch = cmsInput('text','search','filter_search',$search,'','','width:255px;');
    }else{
        $inputSearch = cmsInput('text','search','filter_search','','','','width:255px;');
    }
?>
<div class="content content-boxed">
    
    <?php $this->load->view('admin/message/index');?>
    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-content">
            <form class="list_filter form" action="<?php echo Admin_url('transaction/search')?>" method="post">
                <table class="table table-header-bg">
                    <tbody>
                            
                        <tr>
                            
                            <td class="text-left" style="width: 10%;"><label for="filter_id">Tìm kiếm</label></td>
                            <td class="text-left" style="width: 40%;">
                                <?php echo $inputSearch;?>
                            </td>

                            <td class="text-right">
                            <input type="submit" class="btn btn-primary" value="Lọc">
                            <input type="reset" class="btn btn-success" value="Reset" onclick="window.location.href = '<?php echo Admin_url('transaction/index')?>'; ">
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
                        <th class="text-center">Mã số</th>
                        <th>Người giao dịch</th>
                        <th>Số tiền</th>
                        <th>Số điện thoại</th>
                        <th>Cổng thanh toán</th>
                        <th class="hidden-xs">trạng thái</th>
                        
                        <th class="text-center" style="width: 10%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($transactionList as $key => $value):
                ?>
                    <tr>
                        <td class="text-center">
                            <label class="css-input css-checkbox css-checkbox-primary">
                                <input type="checkbox" id="row_1" name="row_1"><span></span>
                            </label>
                        </td>
                        <td class="text-center"><?php echo $value->id?></td>
                        <td class="text-center"><?php echo $value->user_name;?></td>
                        <td class="font-w600"><?php echo $value->amount?></td>
                        <td class="font-w600"><?php echo $value->user_phone?></td>
                        <td class="font-w600">
                            <?php echo $value->payment;?>
                        </td>
                        <td class="hidden-xs">
                            <?php if($value->status == 0)
                            {echo 'chưa thanh toán';
                            }else if($value->status == 1){
                                echo 'đã thanh toán';
                            }?>
                        </td>
                      
                        <td class="text-center">
                            <div class="btn-group">
                                
                                <button class="btn btn-xs btn-default" type="button" data-toggle="modal" title="Xem chi tiết giao dịch" onclick="showModal('<?php echo Admin_url('transaction/view').$value->id;?>')"><i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="xóa giao dịch"><a href="<?php echo Admin_url('transaction/delete/'.$value->id);?>"><i class="fa fa-times"></i></a></button>
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
<?php $this->load->view('admin/modal/index');?>

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

    function showModal($url)
    { 
        $('#edit-normal').modal('toggle');
        $.ajax({
            cache: false,
            type: 'POST',
            url: $url,
            dataType: "HTML",
            success: function(data) 
            {
                $('#edit-normal').find('.content1').html(data);
            }
        });
        
    }

</script>