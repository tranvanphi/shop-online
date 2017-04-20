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
        <a href="<?php echo base_url('user/listorder');?>" class="list-group-item  active">Quản lý đơn hàng</a>
        <a href="<?php echo base_url('user/address');?>" class="list-group-item">Sổ Địa chỉ</a>
      </div>
      
      </div>
   </div>
   <div class="col-md-9">
      <div class="form-info-user">
      <h2>Đơn hàng của tôi</h2>
         <div class="table-responsive">
      
         <?php if(!empty($transaction)):?>
            <table class="table table-hover">
               <thead>
                  <th>Số thứ tự</th>
                  <th>Ngày mua</th>
                  <th>Sản phẩm</th>
                  <th>Tổng tiền</th>
                  <th>Trạng thái giao hàng</th>                      
               </thead>
               <tbody>
                  <?php foreach($transaction as $row => $transac):?>
                  <?php $status = ($transac->status == 0)? 'chưa giao hàng' : 'giao hàng thành công';?>
                  <tr>
                     <td><?php echo $row?></td>
                     <td><?php echo $transac->created?></td>
                     <td><?php echo $transac->name?></td>
                     <td><?php echo $transac->amount?></td>
                     <td><?php echo $status?></td>
                  </tr>
                  <?php endforeach;?>

                  
               </tbody>
            </table>
         <?php else:?>
            <p style="margin-top:20px; font-size:25px;color: red;">bạn chưa mua sản phẩm nào!</p>
         <?php endif;?>
         </div>
      </div>
   </div>
</div>