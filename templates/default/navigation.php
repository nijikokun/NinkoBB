<?php if($login_error){ ?>
<table border="0" cellpadding="1" cellspacing="0" class="error">
 	<tr> 
    	<td width="60%" align="left" class="text">
			<?php echo $login_error; ?>
		</td>
	</tr>
</table>
<?php } ?>

<table border="0" cellpadding="1" cellspacing="0" class="navigation">
 	<tr> 
    	<td width="60%" align="left" class="bodyfont">
<?php if($_SESSION['logged_in']) { ?>
			<?php echo lang('welcome_back'); ?> <strong><?php echo $user_data['username']; ?></strong>
			( <a href="users.php?a=home"><?php echo lang('user_cp'); ?></a><?php if($user_data['admin']) { ?> | <a href="admin.php"><?php echo lang('admin_cp'); ?></a><?php } ?> ) 
			<?php load_hook('navigation_menu'); ?>
			<a href="logout.php"><?php echo lang('logout'); ?></a>
<?php } else { ?>
			<form method="post">
				<?php echo lang('username'); ?>: <input name="username" size="15" type="text" class="border" value="" /> 
				<?php echo lang('password'); ?>: <input name="password" size="15" type="password" class="border" value="" /> 
				<?php load_hook('navigation_login'); ?>
				<input type="submit" name="login" value="<?php echo lang('login'); ?>"> or <a href="<?php echo $config['url_path']; ?>/register.php"><?php echo lang('register'); ?></a>
			</form>
<?php } ?>
    	</td>
    	<td width="40%" align="right" class="bodyfont" valign="middle">
		<?php load_hook('navigation_right'); ?>
<?php if($in_topic){ ?>
	<?php if($closed && (!$_SESSION['admin'] || !$_SESSION['moderator'])){ ?>
			<a href="" class="white rounded"><?php echo lang('closed'); ?></a>
	<?php } else { ?>
			<a href="<?php echo $config['url_path']; ?>/message.php?page=<?php echo $page; ?>&amp;reply=<?php echo $topic['id']; ?>" class="white rounded"><?php echo lang('reply'); ?></a>
	<?php } ?>
<?php } else { ?>
			<a href="<?php echo $config['url_path']; ?>/message.php?reply=0" class="white rounded"><?php echo lang('start_new_topic'); ?></a>
<?php } ?>
			<?php if($pagination){ echo " | " . lang('pages') . ": "; echo $pagination; } ?>
		</td>
	</tr>
</table>
