<div class="content content-boxed">

    <!-- Top Products and Latest Orders -->
    <div class="row">
        <div class="col-lg-6">
            <!-- Top Products -->
            <div class="block block-opt-refresh-icon4">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Sản phẩm mới</h3>
                </div>
                <?php //pre($productList,false);?>
                <div class="block-content">
                    <table class="table table-borderless table-striped table-vcenter">
                        <tbody>
                            <?php foreach($productList as $row):?>
                            <tr>
                                <td class="text-center" style="width: 100px;"><a href="<?php echo Admin_url('product/editProduct/'.$row->id);?>"><strong><?php echo $row->id?></strong></a></td>
                                <td><a href="<?php echo Admin_url('product/editProduct/'.$row->id);?>"><?php echo $row->name?></a></td>
                                <td class="hidden-xs text-center">
                                    <?php echo ($row->price - $row->discount)?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Top Products -->
        </div>
        <div class="col-lg-6">
            <!-- Latest Orders -->
            <div class="block block-opt-refresh-icon4">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                        <li>
                            <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Giao dịch cuối</h3>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-striped table-vcenter">
                        <tbody>
                            <?php foreach($transactionList as $row):?>
                            <tr>
                                <td class="text-center" style="width: 100px;"><strong><?php echo $row->id?></strong></td>
                                <td class="hidden-xs"><?php echo $row->user_name?></td>
                                <?php 
                                    if($row->status == 1){
                                        $str = "<span class='label label-success'>Đã thanh toán</span>";
                                    }else{
                                        $str = "<span class='label label-danger'>Chưa thanh toán</span>";
                                    }

                                ?>
                                <td><?php echo $str;?></td>
                                <td class="text-right"><strong><?php echo $row->amount?></strong></td>
                            </tr>
                            <?php endforeach;?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Latest Orders -->
        </div>
    </div>
    <!-- END Top Products and Latest Orders -->
</div>


<!-- Page JS Plugins -->
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/chartjs/Chart.min.js"></script>

<!-- Page JS Code -->
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/pages/base_pages_ecom_dashboard.js"></script>

<script>
    jQuery(function () {
        // Init page helpers (Appear + CountTo plugins)
        App.initHelpers(['appear', 'appear-countTo']);
    });
</script>