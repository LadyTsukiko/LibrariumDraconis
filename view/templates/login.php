
	<h3>Please Login</h3>
	<?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
	<form action="index.php?action=login" method="post">
		<p><label class="login-label" ><?php echo $username; ?></label> <input class="field" name="login"></p>
		<p><label class="login-label" ><?php echo $password; ?></label> <input class="field" type="password" name="pw"></p>
		<p><input class="button confirm" type="submit" value="<?php echo $login; ?>"></p>
	</form>

	<a href="index.php?action=register"><?php echo $regmes;?></a>
