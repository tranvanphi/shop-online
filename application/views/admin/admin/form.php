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

    // username
    if(!empty(set_value('username')))
    {
        $inputUsername  = cmsInput('text','username', 'param_username', set_value('username'));
    }else if(!empty($info))
    {
        $inputUsername  = cmsInput('text','username', 'param_username', $info->username);
    }else{
        $inputUsername  = cmsInput('text','username', 'param_username', '');
    }

    $inputPassword      = cmsInput('password','password', 'param_password');
    $inputRepassword    = cmsInput('password','repassword', 'param_repassword');
    // select parent_id
    $arrValue = array(0 => 'chọn nhóm');
    $keySelect = '';
    foreach ($list as $key => $value) {
        $arrValue[$value->id] =$value->name;
    }
    if(!empty($info))
    {
        $keySelect = $info->admin_group_id;

        if($keySelect == 0)
        {
            unset($arrValue[$info->id]);
        }
        $selectAdminGroup_id = cmsSelectbox('AdminGroup_id', 'form-control','param_admin_group_id', $arrValue,$keySelect, 250);
    }else{
        $selectAdminGroup_id = cmsSelectbox('AdminGroup_id', 'form-control','param_admin_group_id', $arrValue,$keySelect, 250);
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
                        echo 'chỉnh sửa thông tin admin';
                    }else{
                        echo 'thêm admin';
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
                            <label for="param_name">Họ và tên</label>
                        </div>
                        <?php
                        if(!empty(form_error('name')))
                        {
                            echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('name')."</div>";
                        }
                    ?>
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $inputUsername;?>
                            <label for="param_username">Tên đăng nhập</label>
                        </div>
                        <?php
                            if(!empty(form_error('username')))
                            {
                                echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('username')."</div>";
                            }
                        ?>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $inputPassword;?>
                            <label for="param_password">Mật khẩu</label>
                        </div>
                        <?php
                            if(!empty(form_error('password')))
                            {
                                echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('password')."</div>";
                            }
                        ?>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $inputRepassword;?>
                            <label for="param_repassword">Nhập lại mật khẩu</label>
                        </div>
                        <?php
                            if(!empty(form_error('repassword')))
                            {
                                echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('repassword')."</div>";
                            }
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $selectAdminGroup_id;?>
                            <label for="param_admin_group_id">Nhóm</label>
                        </div>
                        <?php
                            if(!empty(form_error('AdminGroup_id')))
                            {
                                echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('AdminGroup_id')."</div>";
                            }
                        ?>
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