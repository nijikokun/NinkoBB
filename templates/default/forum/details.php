<table width="80%" border="0" cellspacing="0" cellpadding="5" align="center">
	<tr>
		<td width="40%" class="post"><?php echo lang('users_online'); ?></td>
	</tr>
	<tr>
		<td class="form" valign="top">
			<?php if($online_data['users']){ ?><?php echo $online_data['users']; ?><?php } else { echo lang('no_online'); } ?>
			<?php if(is_loaded('Guest Counter')){ if($bots_online_data['users']){ ?>, <?php echo $bots_online_data['users']; ?><?php } } ?>
		</td>
	</tr>
	<tr>
		<td width="30%" class="post"><?php echo lang('forum_statistics'); ?></td>
	</tr>
	<tr>
		<td class="form">
			<?php echo lang('registered_users'); ?>: <?php echo $user_count; ?> - 
<?php if(is_loaded('guest_counter')){ ?>
			<?php echo lang('guests_online'); ?>: <?php echo $guests_online_data['count']; ?> - 
<?php } ?>
			<?php echo lang('users_online'); ?>: <?php echo $online_data['count']; ?> - 
			<?php echo lang('admins_online'); ?>: <?php echo $admin_online_data['count']; ?> - 
			<?php echo lang('topics_c'); ?>: <?php echo $topic_count; ?> - 
			<?php echo lang('posts_c'); ?>: <?php echo $post_count; ?>
		</td>
	</tr>
</table>

<br />