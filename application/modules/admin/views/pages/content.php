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
						<h3>Content</h3>
					</div> <!-- .widget-header -->						
					<div class="widget-content">
						<div class="field-group">
							<label for="myfile">Content:</label>
							<div class="field">								
								<!--
								<textarea name="content_textbox" id="content_textbox" cols="50" rows="15"><?php //echo $page['content']; ?></textarea>
								-->
								<!--Mardown Editor-->
								<div class="wmd-panel">
									<div id="wmd-button-bar"></div>
									<textarea class="wmd-input" id="wmd-input" name="content_textbox"><?php echo $page['content']; ?></textarea>
									<input type="hidden" name="text_content" id="text_content" value="" />
								</div>
								<div id="wmd-preview" class="wmd-panel wmd-preview"></div>
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
<script type="text/javascript">
/*
$(function() {        
	$("#content_textbox").htmlarea(); // Initialize jHtmlArea's with all default values
});
*/
(function () {
                var converter1 = Markdown.getSanitizingConverter();
                
                converter1.hooks.chain("preBlockGamut", function (text, rbg) {
					
                    return text.replace(/^ {0,3}""" *\n((?:.*?\n)+?) {0,3}""" *$/gm, function (whole, inner) {					
						document.getElementById("text_content").innerHTML = inner;
                        return "<blockquote>" + rbg(inner) + "</blockquote>\n";
                    });
                });
                
                var editor1 = new Markdown.Editor(converter1);
                
                editor1.run();
			})();
</script>