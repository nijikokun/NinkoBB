<?php if(!$reply){ ?>
<table width="50%" border="0" cellspacing="2" cellpadding="5" class="subject">
	<tr>
		<td colspan="2">
			<?php echo stripslashes(htmlentities($post['subject'])); ?> 
			<span class="info">(0 <?php echo lang('posts_c'); ?>)</span>
		</td>
	</tr>
</table>
<?php } ?>
<table width="50%" border="0" cellspacing="2" cellpadding="5" align="center" class="post" id="p-<?php echo $post['id']; ?>">
    <tr>
        <td valign="top" width="70%">
            <dl>
<?php if(!$user_data['banned'] && !$user_data['admin'] && !$user_data['moderator']){ ?>
                <img src="<?php echo get_avatar($user_data['id']); ?>" class="avatar" alt="pic" />
                <dt>
                    <?php echo $user_data['styled_name']; ?> 
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
<?php } else if($user_data['banned']) { ?>
                <dt>
                    <span class="banned"><?php echo $user_data['styled_name']; ?></span> 
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
                <dd>Banned</dd>
<?php } else if($user_data['moderator']) { ?>
                <img src="<?php echo get_avatar($user_data['id']); ?>" class="avatar" alt="pic" />
                <dt>
                    <span class="moderator"><?php echo $user_data['styled_name']; ?></span>
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
                <dd>Moderator</dd>
<?php } else { ?>
                <img src="<?php echo get_avatar($user_data['id']); ?>" class="avatar" alt="pic" />
                <dt>
                    <span class="admin"><?php echo $user_data['styled_name']; ?></span>
					<span class="date"><?php echo date($config['date_format'], ($post['time'] + $config['zone'])); ?></span>
                </dt>
                <dd>Administrator</dd>
<?php } ?>
                <dd><?php echo forum_count(false, $user_data['id']); ?> posts</dd>
                <dd><?php echo lang('joined'); ?> <?php echo date($config['date_format'], $user_data['join_date']); ?></dd>
            </dl>
        </td>
		<td align="right" valign="top"></td>
	</tr>
	<tr>
		<td colspan="2">
            <div id="pdata-<?php echo $post['id']; ?>" class="message">
				<?php echo parse($_POST['content']); ?>
            </div>
		</td>
	</tr>
    </tr>
</table>