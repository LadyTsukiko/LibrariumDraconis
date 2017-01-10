
	<form action="index.php?action=login" method="post">
		<p><input class="field" placeholder="<?php echo $username; ?>" name="login" required></p>
		<p><input class="field" type="password" placeholder="<?php echo $password; ?>" name="pw" required></p>
        <?php echo $message; ?>
		<p><input class="button confirm" type="submit" value="<?php echo $login; ?>" required></p>
	</form>

	<p><?php echo $regmes1; ?>
	<a href="index.php?action=register"><?php echo $regmes2;?></a>
	</p>


