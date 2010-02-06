    	<td valign="top" align="left">
    		<table class="ac" width="100%" cellpadding="5" cellspacing="0">
    			<tr>

    				<td class="title"><?php echo lang('admin_cp'); ?></td>
    			</tr>
    			<tr>
    				<td class="post">
    					<?php echo lang('admin_welcome'); ?>
    				</td>
    			</tr>
                <tr>
                    <td class="title">
                        <?php echo lang('forum_statistics'); ?>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt>
                                <?php echo lang('topics_c'); ?><br />
                                <span><?php echo lang('today'); ?></span>
                            </dt>
                            <dd><?php echo forum_count("*"); ?></dd>
                            <dd><?php echo forum_count("*", false, false, false, false, true); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="post">
                        <dl class="input">
                            <dt>
                                <?php echo lang('posts_c'); ?><br />
                                <span><?php echo lang('today'); ?></span>
                            </dt>
                            <dd><?php echo forum_count(false, false, false, false, true); ?></dd><br />
                            <dd><?php echo forum_count(false, false, false, false, true, true); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="title">
                        <dl class="input">
                            <dt><?php echo lang('total_topics_posts'); ?></dt>
                            <dd><?php echo forum_count(false, false, true); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt>
                                <?php echo lang('user_registrations'); ?><br />
                                <span><?php echo lang('today'); ?></span>
                            </dt>
                            <dd><?php echo count_users('1'); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt>
                                <?php echo lang('user_registrations'); ?><br />
                                <span><?php echo lang('week'); ?></span>
                            </dt>
                            <dd><?php echo count_users('7'); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="form">
                        <dl class="input">
                            <dt>
                                <?php echo lang('user_registrations'); ?><br />
                                <span><?php echo lang('month'); ?></span>
                            </dt>
                            <dd><?php echo count_users('30'); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="post">
                        <dl class="input">
                            <dt>
                                <?php echo lang('user_registrations'); ?><br />
                                <span><?php echo lang('year_c'); ?></span>
                            </dt>
                            <dd><?php echo count_users('365'); ?></dd>
                        </dl>
                    </td>
                </tr>
                <tr>
                    <td class="title">
                        <dl class="input">
                            <dt>
                                <?php echo lang('total_user_registrations'); ?>
                            </dt>
                            <dd><?php echo count_users(); ?></dd>
                        </dl>
                    </td>
                </tr>
			</table>
    	</td>
	</tr>
</table>
