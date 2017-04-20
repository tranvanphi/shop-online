<?php 
    //id
    $id = $this->uri->rsegment('3');
    if(isset($id))
    {
        $inputID        = cmsInput('hidden','id', 'param_id', $id);
    }


    $inputName = cmsInput('text','name','product-name',$info->name,'form-control');
    $inputPrice = cmsInput('text','price','product-price',$info->price,'form-control');
    $inputTotal = cmsInput('text','total','product-total',$info->total,'form-control');
    $inputWarranty = cmsInput('text','warranty','product-warranty',$info->warranty,'form-control');
    $inputDiscount = cmsInput('text','discount','product-discount',$info->discount,'form-control');
    $textareaContent = $info->content;
    $keySelect = $info->catalog_id;
    $selectCatalog_id = cmsSelectBoxChild('catalog_id', $catalog,$keySelect);

    if(!empty($info->image_list))
    {
        $img = json_decode($info->image_list);
        $im = '';
        foreach ($img as $key => $value) 
        {
           $im .= $value.',';
        }
        $im = substr($im,0,-1);
        
        $imagelist = cmsImage($img);
    }
    

?>

<div class="content content-boxed">
<div class="block">
    <div class="block-header bg-gray-lighter">
        <h3 class="block-title">Chỉnh sửa sản phẩm</h3>
    </div>
    <div class="block-content block-content-full">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                <form class="form-horizontal push-30-t push-30" action="" method="post" enctype="multipart/form-data">
                    <?php echo $inputID;?>

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
                                <input type="file" name="image_list[]" id="image_list" multiple>
                                <label for="product-price">Hình ảnh</label>
                            </div>

                            <?php echo (isset($imagelist)) ? $imagelist : '' ?>
                        </div>
                        <input class="hidden" name="imglistremove" value="<?php echo (isset($im)) ? $im : ''?>">
                    </div>
                    <input class="hidden" name="listImg" value="<?php $info->image_list?>">
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
                            <!-- CKEditor Container -->
                            <!-- <textarea id="content" name="content" rows="4" cols="50"><?php //echo $textareaContent;?></textarea> -->
                            <textarea id="js-ckeditor" name="content"><?php echo $textareaContent;?></textarea>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button class="btn btn-sm btn-primary" type="submit">Cập nhật</button>
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

</script>

<style type="text/css">
    .img_thumb{
        position: relative;
        display: inline-block;
        margin: 3px;
    }
    .img_thumb>img{
        height:100px;
        width: 120px;
    }

    .close_img{
        position: absolute;
        color: red;
        top:0px;
        left:100px;
    }
</style>

