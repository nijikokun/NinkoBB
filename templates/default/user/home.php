    	<td valign="top" align="left">
    		<table class="uc" width="100%" cellpadding="5" cellspacing="0">
    			<tr>
    				<td class="title"><?php echo lang('user_cp'); ?></td>
    			</tr>
    			<tr>
    				<td class="post">
    					<?php echo lang('user_welcome'); ?>
    				</td>
    			</tr>
                <tr>
                    <td class="post">
                        <dt><?php echo lang('your_activity'); ?></dt>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt><?php echo lang('joined'); ?></dt>
                            <dd><?php echo date($config['date_format'], $user_data['join_date']); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt>
                                <?php echo lang('last_visit'); ?><br />
                                <span><?php echo lang('last_visit_msg'); ?></span>
                            </dt>
                            <dd><?php echo date($config['date_format'], $user_data['last_seen']); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt>
                                <?php echo lang('total_posts'); ?><br />
                                <span><?php echo lang('total_posts_msg'); ?></span>
                            </dt>
                            <dd><?php echo forum_count(false, $user_data['id']); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt>
                                <?php echo lang('last_post'); ?><br />
                                <span><?php echo lang('last_post_msg'); ?></span>
                            </dt>
                            <dd>
<?php
$last = last_post(false, $user_data['id']);

if($last['reply'] == 0)
{
    echo "Topic: <a href='{$config['url_path']}/read.php?id={$last['id']}'>" . stripslashes(htmlspecialchars($last['subject'])) . "</a>";
}
else
{
    $topic_data = topic($last['reply']);
    
    echo "Posted in Topic: <a href='{$config['url_path']}/read.php?id={$topic_data['id']}'>" . stripslashes(htmlspecialchars($topic_data['subject'])) . "</a>";
    
}
?>
                            </dd>
                        </dl>
                    </td>
                </tr>
			</table>
    	</td>
	</tr>
</table>
