<table width="80%" border="0" align="center" cellpadding="1" cellspacing="0">
	<tr> 
		<td width="25%" valign="top"  align="left" class="">
			<table class="uc" width="100%" cellpadding="2" cellspacing="0">
				<tr>
					<td class="title"><strong><?php echo lang('navigation'); ?></strong></td>
				</tr>
				<tr><td class="<?php echo equals($action, "home", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/admin.php?a=home"><?php echo lang('home_c'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "settings", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/admin.php?a=settings"><?php echo lang('forum_settings'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "users", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/admin.php?a=users"><?php echo lang('manage_users'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "topics", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/admin.php?a=topics"><?php echo lang('manage_topics'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "posts", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/admin.php?a=posts"><?php echo lang('manage_posts'); ?></a>
				</td></tr>
				<tr><td class="<?php echo equals($action, "plugins", "error", "post"); ?>">
					<a href="<?php echo $config['url_path']; ?>/admin.php?a=plugins"><?php echo lang('manage_plugins'); ?></a>
				</td></tr>
			</table>		
		</td>