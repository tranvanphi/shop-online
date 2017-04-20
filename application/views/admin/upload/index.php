
<h1>Upload file</h1>
<form method="post" action="<?php echo Admin_url('upload/upload_file')?>" enctype="multipart/form-data">
  <label>Ảnh minh họa:</label>
  <!-- <input type="file" name="image" id="image"> -->
  <input type="file" name="image_list[]" id="image_list" multiple>
  <input type="submit" class="button" value="Upload" name='submit' />
</form>
