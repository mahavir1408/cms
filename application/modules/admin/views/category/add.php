<div id="content">				
	<div id="contentHeader"><h1>Add Category</h1></div> <!-- #contentHeader -->		
	<div class="container">
		<!--TAB VIEW-->
		
		<div class="grid-16">
			<?php echo set_breadcrumb(); ?>
			<div class="clear">&nbsp;</div>			
			<form class="form uniformForm" name="categoryfrm" action="" method="post">
				<div class="widget">
					<div class="widget-header">
						<span class="icon-article"></span>
						<h3>Add Category</h3>
					</div> <!-- .widget-header -->						
					<div class="widget-content">
						<?php if(validation_errors()){ ?>
						<div class="notify notify-error"><a class="close" href="javascript:;">x</a><h3>Error</h3><?php echo validation_errors(); ?></div>	
						<?php } ?>
						<div class="field-group">
							<label for="display_name">Display Name:</label>
							<div class="field">
								<input type="text" name="display_name" value="" />									
							</div>
						</div>
						<div class="field-group">	
							<label for="uri">URI:</label>			
							<div class="field">
								<input type="text" name="uri" value="" />
							</div>
						</div>
						<div class="field-group">		
							<label>Publish:</label>	
							<div class="field">											
								<select id="publish" name="publish" style="opacity: 0;">
									<option value="1">Yes</option>
									<option value="0">No</option>									
								</select>
							</div>		
						</div>
						<div class="field-group">										
							<div class="field">
								<input type="submit" name="save" value="Save" />
								<input type="button" name="cancel" value="Cancel" onclick="javascript:window.location='/admin/category';" />
							</div>							
						</div>
					</div> <!-- .widget-content -->						
				</div> <!-- .widget -->					
			</form>
		</div>			
	</div> <!-- .container -->		
</div> <!-- #content -->