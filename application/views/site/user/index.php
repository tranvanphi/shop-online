<div class="row">
   <div class="col-md-3">
      <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading" style="font-size: 16px; font-weight: 600;"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $userInfo->name;?></div>
   
      <!-- List group -->
      <div class="list-group">
        <a href="<?php echo base_url('user');?>" class="list-group-item active">
          Thông tin tài khoản
        </a>
        <a href="<?php echo base_url('user/listorder');?>" class="list-group-item">Quản lý đơn hàng</a>
        <a href="<?php echo base_url('user/address');?>" class="list-group-item">Sổ Địa chỉ</a>
      </div>
      
      </div>
   </div>
   <div class="col-md-9">
     
      <h2>Thông tin tài khoản</h2>
      <form enctype="multipart/form-data" action="<?php echo base_url('user');?>" method="post" >
        <input type="hidden" name="id" value="<?php echo $userInfo->id;?>">
          <div class="form-group">
          <label for="name-edit-user">Họ tên</label>
          <input type="text" class="form-control" id="name-edit-user" name="name" value="<?php echo $userInfo->name;?>">
          </div>
          <div class="form-group">
          <label for="email-edit-user">Email</label>
          <input type="email" class="form-control" id="email-edit-user" placeholder="<?php echo $userInfo->email;?>" disabled>
          </div>
          <div class="form-group">
          <label for="radio-gender">Giới tính </label>
          <?php 
            if($userInfo->gender == 1){
               echo "<label class='radio-inline'>
                       <input type='radio' name='gender' id='radio-gender1' value='1' checked> Nam
                     </label>
                     <label class='radio-inline'>
                       <input type='radio' name='gender' id='radio-gender2' value='0'> Nữa
                     </label>";
            }else{
                echo "<label class='radio-inline'>
                       <input type='radio' name='gender' id='radio-gender1' value='1'> Nam
                     </label>
                     <label class='radio-inline'>
                       <input type='radio' name='gender' id='radio-gender2' value='0'  checked> Nữa
                     </label>";
            }
          ?>
          </div>

          <div class="checkbox">
          <label>
            <input type="checkbox" id="change-pass">Thay đổi mật khẩu
          </label>
          </div>

            <div class="form-pass-change">
              <div class="form-group">
              <label for="pass-new">Mật khẩu mới</label>
                <input type="password" class="form-control" name="password" id="pass-new" placeholder="Password">
                <div class="clear"></div>
                <div id="password_error" class="error"><?php echo form_error('password');?></div>
              </div>
              <div class="form-group">
              <label for="re-pass-new">Nhập lại</label>
                <input type="password" class="form-control" name="repassword" id="re-pass-new" placeholder="Repassword">
                <div class="clear"></div>
                <div id="password_error" class="error"><?php echo form_error('repassword');?></div>
              </div>
            </div>
          <button type="submit" class="btn btn-info">Cập nhật</button>
      </form>
      
   </div>
</div>

<style type="text/css">
    .form-pass-change{
        display: none;
    }
</style>



