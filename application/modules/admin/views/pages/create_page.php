<div id="content">				
	<div id="contentHeader">
		<h1>Page</h1>
	</div> <!-- #contentHeader -->		
	<div class="container">
		<!--TAB VIEW-->
		
		<div class="grid-16">
			<?php echo set_breadcrumb(); ?>
			<div class="clear">&nbsp;</div>			
			<form class="form uniformForm" name="pagefrm" action="" method="post">
				<div class="widget">
					<div class="widget-header">
						<span class="icon-article"></span>
						<h3>Create Page</h3>
					</div> <!-- .widget-header -->						
					<div class="widget-content">						
						<div class="field-group">
							<label for="myfile">H1 tag:</label>
							<div class="field">
								<input type="text" name="h1_tag" value="" />									
							</div>
						</div>
						<div class="field-group">	
							<label for="myfile">URL:<em>Short hyphenated string without ending with (.html)</em></label>			
							<div class="field">
								<input type="text" name="slug" value="" />
							</div>
						</div>
						<div class="field-group">		
							<label>Category:</label>	
							<div class="field">											
								<select id="category" name="category" style="opacity: 0;">
									<?php foreach($categories AS $category) { ?>
									<option value="<?php echo $category['category_id']; ?>"><?php echo ucwords($category['display_name']); ?></option>
									<?php } ?>
								</select>
							</div>		
						</div>
						<div class="field-group">										
							<div class="field">
								<input type="submit" name="save" value="Save" />
								<input type="button" name="cancel" value="Cancel" onclick="javascript:window.location='/admin/pages';" />
							</div>							
						</div>
					</div> <!-- .widget-content -->						
				</div> <!-- .widget -->					
			</form>
		</div>			
	</div> <!-- .container -->		
</div> <!-- #content -->