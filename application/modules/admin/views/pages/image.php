<div id="content">		
	<div id="contentHeader">
		<h1>Page</h1>
	</div> <!-- #contentHeader -->	
	<div class="container">			
		<div class="grid-17">
			<?php echo set_breadcrumb(); ?><br />
			<div class="widget">
				<div class="widget-header">
					<span class="icon-image"></span>
					<h3>Image</h3>
				</div>
				<div class="widget-content">
					<?php 
						//echo "<pre>";print_r($imageData['image']);exit;
						if(isset($imageData['image']['file_name']) && !empty($imageData['image']['file_name'])){ 
							$imageSrc = IMAGES_BASE_URL."/".$imageData['image']['file_name'];
						} else {
							$imageSrc = IMAGES_BASE_URL."/no_img.png";
						}
					?>
					
					<img src="<?php echo $imageSrc; ?>" alt="<?php echo $imageData['image']['alt_text']; ?>" title="<?php echo $imageData['image']['title_text']; ?>" width="<?php echo $imageData['image']['width']; ?>" height="<?php echo $imageData['image']['height']; ?>" />					
				</div>
			</div>
		</div>
		<div class="grid-7">
			<div class="box" id="gallery_upload">
				<?php if(validation_errors()){ ?>
					<div class="notify notify-error"><?php echo validation_errors(); ?></div>	
				<?php } ?>						
				<form class="form uniformForm" enctype="multipart/form-data" method="POST">
					<div class="field-group">
						<label for="alt_text">Alt Text: </label>
						<div class="field">
							<input type="text" id="alt_text" name="alt_text" value="<?php echo $imageData['image']['alt_text']; ?>" />
						</div> <!-- .field -->
					</div> <!-- .field-group -->
					<div class="field-group">
						<label for="title_text">Title Text: </label>
						<div class="field">
							<input type="text" id="title_text" name="title_text" value="<?php echo $imageData['image']['title_text']; ?>" />
						</div> <!-- .field -->
					</div> <!-- .field-group -->
					<div class="field-group">
						<label>Width &amp Height:</label>			
						<div class="field">
							<input type="text" size="3" id="width" name="width" value="<?php echo $imageData['image']['width']; ?>" />
							<label for="Width">Width</label>
						</div>	
						<div class="field">
							<input type="text" size="3" id="height" name="height" value="<?php echo $imageData['image']['height']; ?>" />
							<label for="Height">Height</label>
						</div>
					</div>
					<div class="field-group">
						<label for="file_name">File Name: <em>hyphenated</em></label>
						<div class="field">
							<input type="text" id="file_name" name="file_name" value="<?php echo substr($imageData['image']['file_name'], 0,strrpos($imageData['image']['file_name'],'.'));?>" />
							<input type="hidden" id="old_file_name" name="old_file_name" value="<?php echo $imageData['image']['file_name'];?>" />
						</div> <!-- .field -->
					</div> <!-- .field-group -->
					<div class="field-group">
						<label for="userfile">Upload:</label>
						<div class="field">
							<div class="uploader" id="uniform-userfile"><input type="file" id="userfile" name="userfile" size="19" style="opacity: 0;"><span class="filename" style="-moz-user-select: none;">No file selected</span><span class="action" style="-moz-user-select: none;">Choose File</span></div>
						</div> <!-- .field -->
					</div> <!-- .field-group -->					
					<div class="field-group">										
						<div class="field">
							<input type="submit" value="Save" name="save">
							<input type="button" onclick="javascript:window.location='/admin/pages';" value="Cancel" name="cancel">
						</div>							
					</div>
				</form>
			</div> <!-- .box -->
		</div>
	</div>
</div>