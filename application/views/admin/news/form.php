<?php 

    //id
    $id = $this->uri->rsegment('3');
    if(isset($id))
    {
        $inputID        = cmsInput('hidden','id', 'param_id', $id);
    }

    //title news
    $inputTitle = cmsInput('text','title','news-title','','form-control');

    $inputIntro = cmsInput('text','intro','news-intro','','form-control');

    // name
    if(!empty(set_value('title')))
    {
        $inputTitle     = cmsInput('text','title','news-title',set_value('title'));
    }else if(!empty($info))
    {
        $inputTitle      = cmsInput('text','title', 'param-title', $info->title);
    }else{
        $inputtitle      = cmsInput('text','title', 'param-title', '');
    }


    if(!empty($info->image_link))
    {
        $url = base_url('uploads/').'news/';
        $imagelink = "<div class='img_thumb' alt='".$info->image_link."'>
                        <img class='img-responsive' style='width:120px;height:100px;' src='".$url.$info->image_link."' alt='".$info->image_link."'>
                        
                    </div>";
    }

?>

<div class="content content-boxed">
<div class="block">
    <div class="block-header bg-gray-lighter">
        <h3 class="block-title"><?php 
                    if(isset($id))
                    {
                        echo 'Chỉnh sửa thông tin bài viết';
                    }else{
                        echo 'Thêm bài viết';
                    }
                ?></h3>
    </div>
    <div class="block-content block-content-full">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                <form class="form-horizontal push-30-t push-30" action="#" method="post" enctype="multipart/form-data">
                    <?php if(isset($inputID)){echo $inputID;}?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <?php echo $inputTitle;?>
                                <label for="news-title">Tiêu đề bài viết</label>
                            </div>
                            <?php
                            if(!empty(form_error('title')))
                            {
                                echo "<div id='val-username3-error' class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('title')."</div>";
                            }
                        ?>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <input type="file" name="image_link" id="image_link">
                                <label for="product-price">Hình ảnh</label>
                            </div>
                        </div>
                        <?php echo (isset($imagelink)) ? $imagelink : '' ?>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material form-material-primary">
                                <?php echo $inputIntro;?>
                                <label for="news-intro">Miêu tả</label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 push-10">
                            <div class="form-material form-material-primary">
                                <label>Nội dung</label>
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
                            <textarea id="js-ckeditor" name="content">
                            <?php 
                                if(isset($info->content))
                                {echo $info->content;}
                            ?></textarea>
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

