<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
		<?php foreach($slideList as $row => $list):?>
			<?php if($row == 0):?>
				<div class="item active">
					<img src="<?php echo base_url('uploads/slide/').$list->image_link?>" alt="...">
				</div>
			<?php else:?>
				<div class="item">
					<img src="<?php echo base_url('uploads/slide/').$list->image_link?>" alt="...">
				</div>
			<?php endif;?>
		<?php endforeach;?>
	</div>
</div>
