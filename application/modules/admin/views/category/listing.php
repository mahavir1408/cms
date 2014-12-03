<style>
.fr {
float:right;
}
</style>
<div id="content">		
	<div id="contentHeader"><h1>Category</h1></div> <!-- #contentHeader -->	
	<div class="container">
		<div class="grid-24">
			<?php echo set_breadcrumb(); ?>
			<div class="clear">&nbsp;</div>
			<a class="btn btn-primary" href="/admin/category/add-category"><span class="icon-folder-stroke"></span>Add Category</a>						
			<div class="clear">&nbsp;</div>
			<div class="widget widget-table">						
				<div class="widget-header">
					<span class="icon-list"></span>
					<h3 class="icon chart">Category</h3>		
				</div>
				<div class="widget-content">							
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Category</th>
							<th>Slug</th>
							<th>Created by</th>
							<th>Created date</th>
							<th>Is Published</th>
							<th>Settings</th>
						</tr>
					</thead>
					<tbody>
					<?php if(isset($categories) && !empty($categories)) { ?>
					<?php foreach($categories AS $category) { ?>
					<tr class="odd gradeX">
						<td><?php echo $category['category_id']; ?></td>
						<td><?php echo ucwords($category['display_name']); ?></td>
						<td><?php echo $category['slug']; ?></td>
						<td><?php echo ucwords($category['username']); ?></td>
						<td><?php echo $category['created_at']; ?></td>
						<td><?php ($category['is_published'])?print("Yes"):print("No"); ?></td>
						<td>							
							<a class="btn btn-success btn-small" href="/admin/category/edit-category/<?php echo $category['category_id']; ?>">Edit</a>
							<div class="fr">
								<a class="btn btn-success btn-small" href="/admin/category/seo/<?php echo $category['pageid']; ?>">SEO</a>
								<a class="btn btn-success btn-small" href="/admin/category/image/<?php echo $category['pageid']; ?>">IMAGE</a>
								<a class="btn btn-success btn-small" href="/admin/category/content/<?php echo $category['pageid']; ?>">CONTENT</a>
								<a class="btn btn-success btn-small" href="/admin/category/delete/<?php echo $category['pageid']; ?>">DELETE</a>
								<?php 
									if($category['is_published']){											
										$publishText = "Unpublish";
										$publishClass = "btn-success";
									}else{
										$publishText = "Publish";
										$publishClass = "btn-error"; 
									}
								?>
								<a class="btn <?php echo $publishClass; ?> btn-small" href="/admin/category/publish/<?php echo $category['pageid']; ?>"><?php echo $publishText; ?></a>
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