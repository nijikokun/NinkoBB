<table width="80%" border="0" align="center" cellpadding="1" cellspacing="0">
	<tr> 
		<td width="25%" valign="top"  align="left" class="">
			<table class="uc" width="100%" cellpadding="2" cellspacing="0">
				<tr>
					<td class="title"><?php echo lang('your_cp'); ?></td>
				</tr>
				<tr><td class="<?php echo equals($action, "home", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/users.php?a=home"><?php echo lang('home_c'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "account", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/users.php?a=account"><?php echo lang('edit_account'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "avatar", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/users.php?a=avatar"><?php echo lang('edit_avatar'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "profile", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/users.php?a=profile"><?php echo lang('edit_profile'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "signature", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/users.php?a=signature"><?php echo lang('edit_signature'); ?></a>
				</td></tr>
			</table>		
		</td>
