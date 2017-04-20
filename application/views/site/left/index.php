<!-- <div class="box-left">
    <div class="title tittle-box-left">
		<h2> Tìm kiếm theo giá </h2>
	</div> -->
	<!-- <div class="content-box">
        <form class="t-form form_action" method="post" style="padding:10px" action="<?php// echo base_url('product/searchPrice')?>" name="search">
            <div class="form-row">
				<label for="param_price_from" class="form-label" style="width:70px">Giá từ:<span class="req">*</span></label>
					<div class="form-item" style="width:90px"> -->
						<?php 
							//$Arr = array('chon gia',100 => 100,200 => 200,300 => 300,400 => 400,500 => 500,600 => 600,700 => 700,800 =>800,900 => 900);
							//$selectFrom = cmsSelectbox('price_from','input','price_from',$Arr);
							//echo $selectFrom . ' Đ';
						?>
						<!-- <select class="input" id="price_from" name="price_from">
						    <option value="0">0 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="2000000">2,000,000 đ</option>
						    <option value="3000000">3,000,000 đ</option>
						    <option value="3000000">3,000,000 đ</option>
						    <option value="3000000">3,000,000 đ</option>
						    <option value="3000000">3,000,000 đ</option>
						    <option value="3000000">3,000,000 đ</option>
						</select> -->
						<!-- <div class="clear"></div>
						<div class="error" id="price_from_error"></div>
					</div>
					<div class="clear"></div>
			</div> -->
			<!-- <div class="form-row">
				<label for="param_price_from" class="form-label" style="width:70px">Giá tới:<span class="req">*</span></label>
					<div class="form-item" style="width:90px">
						<?php 
							//$selectTo = cmsSelectbox('price_to','input','price_to',$Arr);
							//echo $selectTo . ' Đ';
						?> -->
						<!-- <select class="input" id="price_to" name="price_to">
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						    <option value="1000000">1,000,000 đ</option>
						</select> -->
						<!-- <div class="clear"></div>
						<div class="error" id="price_from_error"></div>
					</div>
					<div class="clear"></div>
			</div>
			<div class="form-row">
				<label class="form-label">&nbsp;</label>
				<div class="form-item">
			        <input type="submit" class="button" name="search" value="Tìm kiềm" style="height:30px !important;line-height:30px !important;padding:0px 10px !important">
				</div>
				<div class="clear"></div>
			</div>
        </form>
    </div>
</div> -->

<div class="box-left">
    <div class="title tittle-box-left">
		<h2> Danh mục sản phẩm </h2>
	</div>
	<div class="content-box"><!-- The content-box -->
	    <ul class="catalog-main">
	    <?php foreach($catalogList as $row):?>
            <li><span><a href="<?php echo base_url('product/catalog/').$row->id;?>" title="Tivi"><?php echo $row->name;?></a></span>
            	<?php if(!empty($row->subs)):?>
                <!-- lay danh sach danh muc con -->
             	<ul class="catalog-sub"> 
             		<?php foreach($row->subs as $sub):?>
             	 	<li><a href="<?php echo base_url('product/catalog/').$sub->id;?>" title="<?php echo $sub->name?>"><?php echo $sub->name?></a></li>		
                    <?php endforeach;?>	
                </ul>
            	<?php endif;?>
            </li>
	       	<?php endforeach;?>
	    </ul>	    
	</div><!-- End content-box -->
</div>
