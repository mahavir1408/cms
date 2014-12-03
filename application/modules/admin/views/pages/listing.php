<style>
.fr {
float:right;
}
</style>
<div id="content">		
	<div id="contentHeader">
		<h1>Pages</h1>
	</div> <!-- #contentHeader -->	
	<div class="container">
		<div class="grid-24">
			<?php echo set_breadcrumb(); ?>
			<div class="clear">&nbsp;</div>		
			<a class="btn btn-primary" href="/admin/pages/create-page"><span class="icon-document-alt-stroke"></span>Create Page</a>
			<div class="clear">&nbsp;</div>
			<div class="widget widget-table">					
				<div class="widget-header">
					<span class="icon-list"></span>
					<h3 class="icon chart">Pages</h3>		
				</div>				
				<div class="widget-content">							
					<table class="table table-bordered table-striped">							
					<tbody>
						<?php if(isset($pages) && !empty($pages)) { ?>
						<?php foreach($pages AS $page) { ?>
						<tr class="odd gradeX">
							<td><?php echo ucwords($page['user_full_name']); ?></td>
							<td><?php echo ucwords($page['category_name']); ?></td>
							<td><?php echo ucfirst($page['h1_text']); ?></td>
							<td>										
								<div class="fr">
									<a class="btn btn-success btn-small" href="/admin/pages/seo/<?php echo $page['pageid']; ?>">SEO</a>
									<a class="btn btn-success btn-small" href="/admin/pages/image/<?php echo $page['pageid']; ?>">IMAGE</a>
									<a class="btn btn-success btn-small" href="/admin/pages/content/<?php echo $page['pageid']; ?>">CONTENT</a>
									<a class="btn btn-success btn-small" href="/admin/pages/delete/<?php echo $page['pageid']; ?>">DELETE</a>
									<?php 
										if($page['is_published']){	
											$publishURL = "unpublish";
											$publishText = "Unpublish";
											$publishClass = "btn-success";
										}else{
											$publishURL = "publish";
											$publishText = "Publish";
											$publishClass = "btn-error"; 
										}
									?>
									<a class="btn <?php echo $publishClass; ?> btn-small" href="/admin/pages/<?php echo $publishURL."/".$page['pageid']; ?>"><?php echo $publishText; ?></a>
                  <!--
                  <form method="post" action="/admin/pages/<?php echo $publishURL."/".$page['pageid']; ?>">
                    <button class="btn <?php echo $publishClass; ?> btn-small" ><?php echo $publishText; ?></button>
                  </form>
                  -->
								</div>
							</td>																	
						</tr>
					<?php } ?>
					<?php } ?>
					</tbody>
					</table>							
				</div> <!-- .widget-content -->						
			</div>
			<?php ($pagination)?print($pagination):""; ?>
		</div> 
	</div> <!-- .container -->		
</div> <!-- #content -->