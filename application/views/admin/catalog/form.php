<?php 

    //id
    $id = $this->uri->rsegment('3');
    if(isset($id))
    {
        $inputID        = cmsInput('hidden','id', 'param_id', $id);
    }

    // name
    if(!empty(set_value('name')))
    {
        $inputName      = cmsInput('text','name', 'param_name', set_value('name'));
    }else if(!empty($info))
    {
        $inputName      = cmsInput('text','name', 'param_name', $info->name);
    }else{
        $inputName      = cmsInput('text','name', 'param_name', '');
    }

    // sort_order
    if(!empty(set_value('sort_order')))
    {
        $inputSort_order    = cmsInput('text','sort_order', 'param_sortOrder', set_value('sort_order'));
    }else if(!empty($info))
    {
        $inputSort_order    = cmsInput('text','sort_order', 'param_sortOrder', $info->sort_order);
    }else{
        $inputSort_order    = cmsInput('text','sort_order', 'param_sortOrder', '');
    }

    // select parent_id
    $arrValue = array(0 => 'danh mục cha');
    $keySelect = '';
    foreach ($list as $key => $value) {
        $arrValue[$value->id] =$value->name;
    }
    if(!empty($info))
    {
        $keySelect = $info->parent_id;

        if($keySelect == 0)
        {
            unset($arrValue[$info->id]);
        }
        $selectParent_id = cmsSelectbox('parent_id', 'form-control','param_parent_id', $arrValue,$keySelect, 250);
    }else{
        $selectParent_id = cmsSelectbox('parent_id', 'form-control','param_parent_id', $arrValue,$keySelect, 250);
    }

?>
<div class="content content-narrow">
    <div calss="col-md-6 col-md-offset-3">
    <div class="block">
        <div class="block-header">
            
            <h3 class="block-title">
                <?php 
                    if(isset($id))
                    {
                        echo 'chỉnh sửa danh mục';
                    }else{
                        echo 'thêm danh mục';
                    }
                ?></h3>
        </div>
        <div class="block-content block-content-narrow">
        
            <form class="form-horizontal push-10-t" action="#" method="post" enctype="multipart/form-data">
                <?php if(isset($inputID)){echo $inputID;}?>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $inputName;?>
                            <label for="param_name">Tên danh mục</label>
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
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $inputSort_order;?>
                            <label for="param_sortOrder">Thứ tự hiển thị</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $selectParent_id;?>
                            <label for="param_parent_id">Danh muc cha</label>
                        </div>
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col-sm-9">
                        <button class="btn btn-sm btn-primary" type="submit" onclick="javascript:submitForm(<?php echo Admin_url('catalog/formAction')?>)">Cập nhật </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>