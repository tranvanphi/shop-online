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

    // email
    if(!empty(set_value('email')))
    {
        $inputEmail  = cmsInput('text','email', 'param_email', set_value('email'));
    }else if(!empty($info))
    {
        $inputEmail  = cmsInput('text','email', 'param_email', $info->email);
    }else{
        $inputEmail  = cmsInput('text','email', 'param_email', '');
    }

    // phone
    if(!empty(set_value('phone')))
    {
        $inputPhone  = cmsInput('text','phone', 'param_phone', set_value('phone'));
    }else if(!empty($info))
    {
        $inputPhone  = cmsInput('text','phone', 'param_phone', $info->phone);
    }else{
        $inputPhone  = cmsInput('text','phone', 'param_phone', '');
    }

    // address
    if(!empty(set_value('address')))
    {
        $inputAddress  = cmsInput('text','address', 'param_Address', set_value('address'));
    }else if(!empty($info))
    {
        $inputAddress  = cmsInput('text','address', 'param_Address', $info->address);
    }else{
        $inputAddress  = cmsInput('text','address', 'param_Address', '');
    }

    $inputPassword      = cmsInput('password','password', 'param_password');
    $inputRepassword    = cmsInput('password','repassword', 'param_repassword');
    


?>
<div class="content content-narrow">
    <div calss="col-md-6 col-md-offset-3">
    <div class="block">
        <div class="block-header">
            
            <h3 class="block-title">
                <?php 
                    if(isset($id))
                    {
                        echo 'Chỉnh sửa thông tin người dùng';
                    }else{
                        echo 'Thêm người dùng';
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
                            <?php echo $inputEmail;?>
                            <label for="param_email">Email</label>
                        </div>
                        <?php
                            if(!empty(form_error('email')))
                            {
                                echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('email')."</div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $inputPhone;?>
                            <label for="param_phone">Số điện thoại</label>
                        </div>
                        <?php
                            if(!empty(form_error('phone')))
                            {
                                echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('phone')."</div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-material floating">
                            <?php echo $inputAddress;?>
                            <label for="param_address">Địa chỉ</label>
                        </div>
                        <?php
                            if(!empty(form_error('address')))
                            {
                                echo "<div class='help-block text-right animated fadeInDown' style='color:red;'>".form_error('address')."</div>";
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
                        <button class="btn btn-sm btn-primary" type="submit" onclick="javascript:submitForm(<?php echo Admin_url('catalog/formAction')?>)">Cập nhật </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>