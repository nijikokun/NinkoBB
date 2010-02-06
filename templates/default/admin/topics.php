		<td valign="top" align="left">
			<table class="ac" width="100%" cellpadding="5" cellspacing="0">
				<tr>
					<td colspan="6" class="title"><?php echo lang('admin_cp'); ?> - Manage Topics / Topics</td>
				</tr>
<?php if ($error){ ?>
                <tr>
                    <td class="error">
                        <?php echo $error; ?>
                    </td>
                </tr>
<?php } else if($success){ ?>
                <tr>
                    <td class="error">
                        <?php echo $success; ?>
                    </td>
                </tr>
<?php } ?>
				<tr>
					<td class="item key"><?php echo lang('subject_c'); ?></td>
					<td align="center" class="item key"><?php echo lang('starter_c'); ?></td>
					<td align="center" class="item key"><?php echo lang('status'); ?></td>
					<td align="center" class="item key"><?php echo lang('posts_c'); ?></td>
					<td colspan="2" class="item key"><?php echo lang('actions'); ?></td>
				</tr>
<?php 
foreach($topics as $row){ 
		// reset
		$status = "";
		
		// Trim subject
		$subject = character_limiter(trim(stripslashes($row['subject'])), $config['max_length']);
		
		// Build topic url
		$topic_url = "{$config['url_path']}/read.php?id={$row['id']}";
		
		// Topic starter data
		$topic_author = user_data($row['starter_id']);
		
		// Topic status
		if($row['closed'])
		{
			$status = 'closed, ';
		}
		
		if($row['sticky'])
		{
			$status .= 'sticky';
		}
?>
                <tr>
                    <td nowrap="nowrap" width="40%" class="item">
                        <span class="smallfont">
                            <a href="<?php echo $topic_url; ?>"> 
                            <?php echo $subject; ?>
                            </a>
                        </span>
                    </td>
                    <td nowrap="nowrap" align="center" class="item">
                        <?php echo $topic_author['styled_name']; ?>
                    </td>
                    <td nowrap="nowrap" align="center" class="item grey">
                        <?php echo $status ?>
                    </td>
                    <td nowrap="nowrap" align="center" class="item grey">
                        <?php echo forum_count($row['id']); ?>
                    </td>
                    <td nowrap="nowrap" align="center" class="item key">
                        <a href="<?php echo $config['url_path']; ?>/message.php?edit=<?php echo $row['id']; ?>">Edit</a>
                    </td>
                    <td nowrap="nowrap" align="center" class="item key">
                        <a href="<?php echo $config['url_path']; ?>/admin.php?a=topics&delete=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
<?php } ?>

<?php if($topics_pagination){ ?>
				<tr>
					<td colspan="6"><?php echo $topics_pagination; ?></td>
				</tr>
<?php } ?>
			</table>
    	</td>
	</tr>
</table>
