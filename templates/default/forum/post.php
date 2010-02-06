<?php if($starter){ ?>
<table width="50%" border="0" cellspacing="2" cellpadding="5" class="subject">
	<tr>
		<td colspan="2">
			<?php load_hook('message_subject_before'); ?>
			<span class="subject"><?php echo stripslashes(htmlentities($post['subject'])); ?></span> 
			<span class="info">(<?php echo forum_count($post['id']); ?> <?php echo lang('posts_c'); ?>)</span>
			<?php if($pagination){ ?><span class="info">(<?php echo lang('pages'); ?> <?php echo $pagination; ?>)</span><?php } ?>
			<?php load_hook('message_subject_inside'); ?>
<?php if($post['status']){ ?>
			<br /><?php echo $post['status']; ?>
			<?php load_hook('message_subject_after'); ?>
<?php } ?>
		</td>
	</tr>
</table>
<?php } ?>
<table width="50%" border="0" cellspacing="2" cellpadding="5" align="center" class="post" id="p-<?php echo $post['id']; ?>">
    <tr>
        <td valign="top" width="70%">
            <dl>
<?php if(!$author['banned'] && !$author['admin'] && !$author['moderator']){ ?>
                <img src="<?php echo $avatar_url; ?>" class="avatar" alt="pic" />
                <dt>
                    <?php echo $author['styled_name']; ?> 
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
<?php } else if($author['banned']) { ?>
                <dt>
                    <span class="banned"><?php echo $author['styled_name']; ?></span> 
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
                <dd>Banned</dd>
<?php } else if($author['moderator']) { ?>
                <img src="<?php echo $avatar_url; ?>" class="avatar" alt="pic" />
                <dt>
                    <span class="moderator"><?php echo $author['styled_name']; ?></span>
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
                <dd>Moderator</dd>
<?php } else { ?>
                <img src="<?php echo $avatar_url; ?>" class="avatar" alt="pic" />
                <dt>
                    <span class="admin"><?php echo $author['styled_name']; ?></span>
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
                <dd>Administrator</dd>
<?php } ?>
				<?php load_hook('message_user_info_after'); ?>
                <dd><?php echo forum_count(false, $author['id']); ?> posts</dd>
                <dd><?php echo lang('joined'); ?> <?php echo date($config['date_format'], $author['join_date']); ?></dd>
				<?php load_hook('message_user_info_after'); ?>
            </dl>
        </td>
		<td align="right" valign="top">
			<?php load_hook('message_user_right'); ?>
<?php if($_SESSION['admin'] || $_SESSION['moderator']){ ?>
<?php if($starter){ ?>
			<a href="message.php?edit=<?php echo $post['id']; ?>"><?php echo lang('edit'); ?></a> - 
			<a href="read.php?delete_topic=<?php echo $post['id']; ?>"><?php echo lang('delete'); ?></a> - 
<?php } else { ?>
			<a href="message.php?edit=<?php echo $post['id']; ?>"><?php echo lang('edit'); ?></a> - 
			<a href="read.php?delete=<?php echo $post['id']; ?>"><?php echo lang('delete'); ?></a> - 
<?php } } else if($user_data['id'] == $author['id']){ ?>
<?php if($starter){ ?>
			<a href="message.php?edit=<?php echo $post['id']; ?>"><?php echo lang('edit'); ?></a> - 
			<a href="read.php?delete_topic=<?php echo $post['id']; ?>"><?php echo lang('delete'); ?></a> - 
<?php } else { ?>
			<a href="message.php?edit=<?php echo $post['id']; ?>"><?php echo lang('edit'); ?></a> - 
			<a href="read.php?delete=<?php echo $post['id']; ?>"><?php echo lang('delete'); ?></a> - 
<?php } } ?>
<?php if($_SESSION['logged_in']) { ?>
			<a href="message.php?page=<?php echo $page; ?>&amp;reply=<?php echo $topic['id']; ?>&amp;q=<?php echo $post['id']; ?>"><?php echo lang('quote'); ?></a> - 
			<a id="qq" alt="<?php echo $post['id']; ?>" name="<?php echo $author['username']; ?>" value="<?php echo br2nl(stripslashes(str_replace('\r\n', '<br />', parse($post['message'], false)))); ?>"><?php echo lang('quick_quote'); ?></a>
<?php } ?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
            <div id="pdata-<?php echo $post['id']; ?>" class="message">
				<?php load_hook('message_before'); ?>
                <?php echo parse($post['message']); ?>
				<?php load_hook('message_after'); ?>
            </div>
		</td>
	</tr>
    </tr>
</table>