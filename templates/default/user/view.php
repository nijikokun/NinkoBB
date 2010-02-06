<table border="0" cellpadding="1" cellspacing="0" class="post">
	<tr>
		<td valign="top" align="left" class="title">
    		<?php echo lang('viewing_profile'); ?> <?php echo $viewing['styled_name']; ?>
    	</td>
	</tr>
	<tr>
		<td valign="top" align="left">
			<table border="0" cellpadding="1" cellspacing="0">
				<tr>
					<td valign="top" align="center" class="form">
						<?php echo $viewing['styled_name']; ?><br />
						<img src="<?php echo get_avatar($viewing['id']); ?>" alt="avatar" />
						<?php if($viewing['banned']){ echo "<br /><span class='item'>Banned</span>"; } else if($viewing['admin']){ echo "<br /><span class='item'>Administrator</span>"; } ?>
					</td>
					<td valign="top" align="left" class="form">
						<div class="post">
							<?php echo lang('joined'); ?>: <?php echo date($config['date_format'], $viewing['join_date']); ?>
						</div>
						<div class="post">
							<?php echo lang('last_visit'); ?>: <?php echo date($config['date_format'], $viewing['last_seen']); ?>
						</div>
						<div class="post">
							<?php echo lang('total_posts'); ?>: <?php echo forum_count(false, $viewing['id']); ?>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
