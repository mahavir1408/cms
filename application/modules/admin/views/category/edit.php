<div id="content">				
	<div id="contentHeader"><h1>Edit Category</h1></div> <!-- #contentHeader -->		
	<div class="container">
		<!--TAB VIEW-->
		
		<div class="grid-16">
			<?php echo set_breadcrumb(); ?>
			<div class="clear">&nbsp;</div>			
			<form class="form uniformForm" name="categoryfrm" action="" method="post">
				<div class="widget">
					<div class="widget-header">
						<span class="icon-article"></span>
						<h3>Edit Category</h3>
					</div> <!-- .widget-header -->						
					<div class="widget-content">
						<?php if(validation_errors()){ ?>
						<div class="notify notify-error"><a class="close" href="javascript:;">x</a><h3>Error</h3><?php echo validation_errors(); ?></div>	
						<?php } ?>
						<div class="field-group">
							<label for="display_name">Display Name:</label>
							<div class="field">
								<input type="text" name="display_name" value="<?php ($category['display_name'])?print($category['display_name']):""; ?>" />									
							</div>
						</div>
						<div class="field-group">	
							<label for="uri">URI:</label>			
							<div class="field">
								<input type="text" name="uri" value="<?php ($category['slug'])?print($category['slug']):""; ?>" />
							</div>
						</div>
						<div class="field-group">		
							<label>Publish:</label>	
							<div class="field">											
								<select id="publish" name="publish" style="opacity: 0;">
									<option value="1" <?php ($category['is_published'] == 1)?print("selected='true'"):""; ?>>Yes</option>
									<option value="0" <?php ($category['is_published'] == 0)?print("selected='true'"):""; ?>>No</option>									
								</select>
							</div>		
						</div>
						<div class="field-group">										
							<div class="field">
								<input type="submit" name="save" value="Save" />
							</div>							
						</div>
					</div> <!-- .widget-content -->						
				</div> <!-- .widget -->					
			</form>
		</div>			
	</div> <!-- .container -->		
</div> <!-- #content -->