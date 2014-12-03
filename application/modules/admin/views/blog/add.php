<script type="text/javascript">
$(function() {        
	$("#blog_content").htmlarea(); // Initialize jHtmlArea's with all default values
});
</script>
<div id="content">				
	<div id="contentHeader">
		<h1>Blog</h1>
	</div> <!-- #contentHeader -->		
	<div class="container">
		<!--TAB VIEW-->
		<div class="grid-16">
			<div class="widget widget-tabs">			
				<div class="widget-header">
					<h3 class="icon aperture">Blog</h3>							
					<ul class="tabs right">	
						<li class="active"><a href="#tab-1">Content</a></li>	
						<li class=""><a href="#tab-2">SEO</a></li>	
						<li class=""><a href="#tab-3">Images</a></li>
					</ul>					
				</div> <!-- .widget-header -->
				<form class="form uniformForm" name="blogfrm" action="" method="post" enctype="multipart/form-data">
					<div class="widget-content" id="tab-1" style="display: none;">
						
						<div class="field-group">
							<label for="myfile">H1 tag:</label>
							<div class="field">
								<input type="text" name="h1_tag" value="" />									
							</div>
						</div>
						<div class="field-group">	
							<label for="myfile">Blog content:</label>			
							<div class="field">
								<textarea name="blog_content" id="blog_content" cols="50" rows="15"></textarea>
							</div>
						</div>
						<div class="field-group">		
							<label for="Leader">Leader:</label>		
							<div class="field">
								<textarea cols="50" rows="5" id="leader" name="leader"></textarea>
							</div>		
						</div>
					</div> <!-- .widget-content -->
				
					<div class="widget-content" id="tab-2" style="display: block;">						
						<div class="field-group">
							<label for="myfile">Meta Title:</label>
							<div class="field">
								<input type="text" name="meta_title" value="" />
								<em>The Meta(page) title and h1 does not have to be exactly the same, but you should consider having the most important terms in both places.
									Having a particular word in the page title, h1 and content is considered good SEO practice, but duplicating the entire title is not needed unless all words in the title is actually important search terms.
									The title is what people judge it on 'from afar' like seeing it on Google, so it can make sense to be more verbose in titles. The h1 on the other hand is for people already on the page and therefor it can be much more to the point. You should not 'sacrifice' that option for SEO
								</em>
							</div>
						</div>
						<div class="field-group">		
							<label for="Meta Description">Meta Description:</label>		
							<div class="field">
								<textarea cols="50" rows="5" id="meta_description" name="meta_description"></textarea>
							</div>		
						</div>						
						<div class="field-group">		
							<label for="myfile">Select a Category:</label>	
							<div class="field">									
								<select id="tag" name="tag" style="opacity: 0;">
								<?php
									foreach($categories as $index => $category){
										$categoryId = $category['id'];
										$categoryName = $category['name'];
										echo "<option value='$categoryId'>$categoryName</option>";
									}
								?>
								</select>
							</div>								
						</div>	
						
						<div class="field-group">	
							<label for="myfile">URL:</label>			
							<div class="field">
								<input type="text" name="url" value="" />
							</div>
						</div>
						<div class="field-group">										
							<div class="field">
								<input type="submit" name="save" value="Save" />
							</div>
							<div class="field">
								<input type="submit" name="publish" value="Publish" />
							</div>
						</div>						
					</div> <!-- .widget-content -->		
					<div class="widget-content" id="tab-3" style="display: block;">	
						<div class="field-group">	
							<label for="myfile">File Input:</label>	
							<div class="field">
								<div class="uploader" id="uniform-myfile">
									<input type="file" id="blogImage" name="blogImage" size="19" style="opacity: 0;">
									<span class="filename" style="-moz-user-select: none;">No file selected</span>
									<span class="action" style="-moz-user-select: none;">Choose File</span></div>
							</div>	
						</div>
					</div>
				</form>				
			</div>
		</div>			
	</div> <!-- .container -->		
</div> <!-- #content -->