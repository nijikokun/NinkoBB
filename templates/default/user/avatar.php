    	<td valign="top" align="left">
    		<table class="uc" width="100%" cellpadding="5" cellspacing="0">
    			<tr>

    				<td class="title"><strong><?php echo lang('editing_avatar'); ?></strong></td>
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
    					<form method="post" enctype="multipart/form-data">
	    					<dl class="input">
								<dt>
									<?php echo lang('current_avatar'); ?>:<br />

									<span>
										<?php echo lang_parse('avatar_upload_limits', array($config['avatar_max_width'], $config['avatar_max_height'], $config['avatar_max_size'])); ?>
									</span>
								</dt>
								<dd>
<?php if($user_data['avatar']){ ?>
									<img src="<?php echo $current_avatar_link; ?>" alt="avatar" />
<?php } else { ?>
									<?php echo lang('no_avatar'); ?>
<?php } ?>
								</dd>
		    				</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
	    					<dl class="input">
								<dt>
									<?php echo lang("upload_from_computer"); ?>:
								</dt>

								<dd>
									<input name="avatar" type="file" />
								</dd>
		    				</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
							<dl class="input">
								<dt>&nbsp;</dt>
								<dd><input type="submit" class="button rounded" name="avatar" value="submit"></dd>
							</dl>
						</form>
     				</td>
    			</tr>
			</table>
    	</td>
	</tr>

</table>
