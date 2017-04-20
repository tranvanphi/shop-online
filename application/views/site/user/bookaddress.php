<div class="row">
   <div class="col-md-3">
      <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading" style="font-size: 16px; font-weight: 600;"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $userInfo->name;?></div>
   

      <!-- List group -->
      <div class="list-group">
        <a href="<?php echo base_url('user');?>" class="list-group-item">
          Thông tin tài khoản
        </a>
        <a href="<?php echo base_url('user/listorder');?>" class="list-group-item">Quản lý đơn hàng</a>
        <a href="<?php echo base_url('user/address');?>" class="list-group-item active">Sổ Địa chỉ</a>
      </div>
      
      </div>
   </div>
   <div class="col-md-9">
      <div class="form-info-user">
      <h2>Sổ địa chỉ</h2>
         <div class="bookaddress">
            <form action="<?php echo base_url('user/address');?>" method="post">
               <div class="form-group">
                  <input type="hidden" name="id" value="<?php echo $userInfo->id;?>">
                   <label for="phone-form">Số điện thoại</label>
                   <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo $userInfo->phone;?>">
                   <div class="clear"></div>
                    <div id="password_error" class="error"><?php echo form_error('phone');?></div>
                 </div>
                 <div class="form-group">
                   <label for="address-form">Address</label>
                   <textarea class="form-control" name="address"><?php echo $userInfo->address;?></textarea>
                   <div class="clear"></div>
                    <div id="password_error" class="error"><?php echo form_error('address');?></div>
                 </div>
                 <button type="submit" class="btn btn-info">Cập nhật</button>
            </form>
         </div>
      </div>
   </div>
</div>