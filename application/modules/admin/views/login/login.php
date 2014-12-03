<body class="error-page">	
<div id="error-header"></div>
<div id="error-wrapper">	
	<form action="" method="post" name="login">
	<!--<div id="error-code">Administrator Login</div>-->
	<?php if(validation_errors()){ ?>
	<div class="notify notify-error"><?php echo validation_errors(); ?></div>	
	<?php } ?>
	<div id="error-actions">
		<input type="text" size="29" id="username" name="username" placeholder="Username"><br /><br />		
		<input type="password" size="29" id="password" name="password" placeholder="Password"><br /><br />
		<button class="btn btn-primary">Login</button>
	</div>	
	</form>
</div> <!-- #error-wrapper -->
</body>
</html>
