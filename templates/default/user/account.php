    	<td valign="top" align="left">
    		<table class="uc" width="100%" cellpadding="5" cellspacing="0">
    			<tr>
    				<td class="title"><strong><?php echo lang('editing_account'); ?></strong></td>
    			</tr>
<?php if ($error){ ?>
                <tr>
                    <td class="error text">
                        <?php echo $error; ?>
                    </td>
                </tr>
<?php } else if($success){ ?>
                <tr>
                    <td class="error text">
                        <?php echo $success; ?>
                    </td>
                </tr>
<?php } ?>
    			<tr>
    				<td class="post">
    					<?php echo lang('editing_account_msg'); ?>
    				</td>
    			</tr>
				<form method="post">
    			<tr>
    				<td class="form">
							<dl class="input">
								<dt>
									<?php echo lang('username'); ?><br />
									<span><?php echo lang('change_username_disallowed'); ?></span>
								</dt>
								<dd><strong><?php echo $user_data['username']; ?></strong></dd>

							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
							<dl class="input">
								<dt><?php echo lang('email'); ?></dt>
								<dd><input type="text" name="email" class="border" style="width: 40%" value="<?php echo switchs(addslashes($_POST['email']), $user_data['email']); ?>"></dd>

							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
							<dl class="input">
								<dt><?php echo lang('new_password'); ?></dt>
								<dd><input type="password" name="npassword" class="border" style="width: 40%"></dd>

							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
							<dl class="input">
								<dt><?php echo lang('new_password_again'); ?></dt>
								<dd><input type="password" name="npassworda" class="border" style="width: 40%"></dd>

							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
							<dl class="input">
								<dt>
									<?php echo lang('current_password'); ?><br />

									<span>
										<?php echo lang('confirm_current_password'); ?>
									</span>
								</dt>
								<dd><input type="password" name="current" class="border" style="width: 40%"></dd>
							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
							<dl class="input">
								<dt>&nbsp;</dt>
								<dd><input type="submit" class="button" name="account" value="submit"></dd>
							</dl>
						</form>
     				</td>
    			</tr>
			</table>
    	</td>
	</tr>
</table>
