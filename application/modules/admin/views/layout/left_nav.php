<?php $menu=$this->config->config['menu'];?>
<div id="sidebar">		
		<ul id="mainNav">			
			<li id="navDashboard" class="nav <?php if($menu == 'dashboard') { ?>active<?php } ?>">
				<span class="icon-home"></span>
				<a href="/admin/dashboard">Dashboard</a>				
			</li>
			<li id="navDashboard" class="nav <?php if($menu == 'category') { ?>active<?php } ?>">
				<span class="icon-article"></span>
				<a href="/admin/category">Category</a>				
			</li>
			<li id="navDashboard" class="nav <?php if($menu == 'pages') { ?>active<?php } ?>">
				<span class="icon-article"></span>
				<a href="/admin/pages">Pages</a>				
			</li>	
			<!--
			<li id="navPages" class="nav">
				<span class="icon-document-alt-stroke"></span>
				<a href="javascript:;">Content Pages</a>				
				
				<ul class="subNav">
					<li><a href="about">About</a></li>					
				</ul>						
				
			</li>
			<li id="navType" class="nav">
				<span class="icon-info"></span>
				<a href="/admin/blog">Blog</a>
				<ul class="subNav">
					<li><a href="/admin/blog">Blog</a></li>	
					<li><a href="/admin/blog/add">Add Post</a></li>					
				</ul>
			</li>
			-->
			<li id="navType" class="nav">
				<span class="icon-info"></span>
				<a href="/admin/logout">Logout</a>	
			</li>			
		</ul>
				
	</div> <!-- #sidebar -->