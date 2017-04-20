<div class="row">
   <div class="col-md-6 col-md-offset-3">
      <form class="form-login" enctype="multipart/form-data" action="<?php echo base_url('user/register')?>" method="post">
         <h2>Đăng ký thành viên</h2>
         <div class="form-group">
            <label for="name-register">Tên người dùng</label>
            <input type="text" class="form-control" id="name-register" value="<?php echo set_value('name')?>" name="name" placeholder="Username">
            <div class="clear"></div>
            <div id="name_error" class="error"><?php echo form_error('name');?></div>
         </div>
         <div class="form-group">
            <label for="email-register">Địa chỉ Email</label>
            <input type="email" class="form-control" id="email-register" name="email" value="<?php echo set_value('email')?>" placeholder="Email">
            <div class="clear"></div>
            <div id="email_error" class="error"><?php echo form_error('email');?></div>
         </div>
         <div class="form-group">
            <label for="password-register">Mật khẩu</label>
            <input type="password" class="form-control" id="password-register" name="password" placeholder="Password">
            <div class="clear"></div>
            <div id="password_error" class="error"><?php echo form_error('password');?></div>
         </div>
         <div class="form-group">
            <label for="re-password-register">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="re-password-register" name="repassword" placeholder="Password">
            <div id="re_password_error" class="error"><?php echo form_error('repassword');?></div>
         </div>


         <button type="submit" class="btn btn-info btn-block">Đăng ký</button>
      </form>
   </div>
</div>