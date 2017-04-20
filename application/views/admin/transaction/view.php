<div class="col-md-12">
	<form action="<?php echo Admin_url('transaction/update')?>" method="post">

	<?php foreach($infoTransaction as $row):?>
		<input type="hidden" name="id" value="<?php echo $row->idTransaction?>">
		<input type="hidden" name="status" value="<?php echo $row->status?>">
		<div class="form-group">
            <div class="col-sm-12">
                <div class="form-material">
                    
                    
                    <label for="material-text">Tên người giao dịch</label>
                    <?php echo $row->name;?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-material">
                    
                    
                    <label for="material-text">Email</label>
                    <?php echo $row->email;?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-material">
                    
                    
                    <label for="material-text">Số điện thoại</label>
                    <?php echo $row->phone;?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-material">
                    <label for="material-text">Số tiền</label>
                    <?php echo number_format($row->amount);?> d
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-material">
                    
                    
                    <label for="material-text">Ghi chú</label>
                    <?php echo $row->message;?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-material">
                    <label for="material-text">Sản phẩm:</label>
                    <?php   foreach ($row->products as $value) 
                            {
                                echo 'Tên sản phẩm:'.$value->name.'-- Số lượng:'.$value->qty.'-- Giá:'.$value->amount.'<br>';
                            }
                    ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <div class="form-material">
                    
                    
                    <label for="material-text">Trạng thái giao dịch</label>
                    <?php if($row->status == 0){echo 'chưa thanh toán';}else{echo 'đã thanh toán';}?>
                </div>
            </div>
        </div>
    <?php endforeach;?>
        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-check"></i> Cập nhật trạng thái</button>
	</form>
	
</div>