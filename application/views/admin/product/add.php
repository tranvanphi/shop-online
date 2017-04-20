<?php 
    //name product
    $inputName = cmsInput('text','name','product-name','','form-control');
    
    //catalog product
    $selectCatalog_id = cmsSelectBoxChild('catalog_id', $catalog);
   
    //price product
    $inputPrice = cmsInput('text','price','product-price','','form-control');

    //price product
    $inputTotal = cmsInput('text','total','product-total','','form-control');

    //warranty product
    $inputWarranty = cmsInput('text','warranty','product-warranty','','form-control');

    $inputDiscount = cmsInput('text','discount','product-discount','','form-control');
?>

<div class="content content-boxed">
<div class="block">
    <div class="block-header bg-gray-lighter">
        <h3 class="block-title">Thêm sản phẩm</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                <form class="form-horizontal push-30-t push-30" action="<?php echo Admin_url('product/addProduct')?>" method="post" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <?php echo $inputName;?>
                                <label for="product-name">Tên sản phẩm</label>
                            </div>
                            <?php
                            if(!empty(form_error('name')))
                            {
                                echo "<div id='val-username3-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('name')."</div>";
                            }
                        ?>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">   
                            <div class="form-material">
                                <?php echo $selectCatalog_id?>
                                <label for="example2-select2">Danh mục</label>
                            </div>
                            <?php
                                if(!empty(form_error('catalog_id')))
                                {
                                    echo "<div id='val-catalog_id-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('catalog_id')."</div>";
                                }
                            ?>
                        </div>        
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <!-- <input type="file" name="image_list" id="image_list1" multiple> -->
                                <input type="file" name="image_list[]" id="image_list" multiple>
                                <label for="product-price">Hình ảnh</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <?php echo $inputPrice?>
                                <label for="product-price">Giá cả</label>
                            </div>
                            <?php
                            if(!empty(form_error('price')))
                            {
                                echo "<div id='val-price-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('price')."</div>";
                            }
                        ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <?php echo $inputDiscount?>
                                <label for="product-price">Giảm giá</label>
                            </div>
                            
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <?php echo $inputWarranty?>
                                <label for="product-price">Bảo hành</label>
                            </div>
                            
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <?php echo $inputTotal ?>
                                <label for="product-total">Số lượng</label>
                            </div>
                            <?php
                                if(!empty(form_error('total')))
                                {
                                    echo "<div id='val-total-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('total')."</div>";
                                }
                            ?>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 push-10">
                            <div class="form-material form-material-primary">
                                <label>Mô tả</label>
                            </div>
                            <?php
                            if(!empty(form_error('content')))
                            {
                                echo "<div id='val-content-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('content')."</div>";
                            }
                        ?>
                        </div>
                        <div class="col-xs-12 push-10">
                            <textarea id="js-ckeditor" name="content"></textarea>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button class="btn btn-sm btn-primary" type="submit">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Page JS Plugins -->
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/dropzonejs/dropzone.min.js"></script>
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script src="<?php echo PUBLIC_URL('admin')?>assets/js/plugins/ckeditor/ckeditor.js"></script>

<!-- Page JS Code -->
<script>
    jQuery(function () {
        // Init page helpers (BS Maxlength + Select2 + Tags Inputs + CKEditor + Appear + CountTo plugins)
        App.initHelpers(['maxlength', 'select2', 'tags-inputs', 'ckeditor', 'appear', 'appear-countTo']);
    });

    var urlAction = '@Url.Action("Action", "Controller", null, Request.Url.Scheme, null)';
    function submitform()
    {
        // $('#form_img').attr('action','<?php //echo Admin_url('upload/doUpload');?>');
    }
  
</script>

