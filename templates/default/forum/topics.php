<?php load_hook('topic_before'); ?>
<table border="0" cellpadding="1" cellspacing="0" class="topic <?php echo $alt; ?>">
	<tr>
		<td valign="top" width="50px">
			<img src="<?php echo get_avatar($topic_author['id']); ?>" width="40px" height="40px" style="padding: 1px; border: 1px solid #E9E9E9;">
		</td>
		<td valign="top" colspan="2">
			<span class="url"><a href="<?php echo $topic_url; ?>"><?php echo $subject; ?></a></span><?php echo $status ?><?php load_hook('topic_subject'); ?><br />
			<?php echo $topic_author['styled_name']; ?> posted <?php echo nice_date(($row['time'] + $config['zone'])); ?>
			<?php load_hook('topic_info'); ?>
		</td>
		<td valign="top" class="details" width="30%" align="right"> 
			<span class="item posts"><?php echo forum_count($row['id']); ?> Posts</span><br />
			<span class="item last">
<?php if($last_post){ ?>
				Last post was <?php echo nice_date($last_post['time']); ?> <?php echo lang('by'); ?> <?php echo $last_post_udata['styled_name'] ?>
<?php } ?>
			</span>
		</td>
	</tr>
</table>
<?php load_hook('topic_after'); ?>