    	<td valign="top" align="left">
    		<table class="uc" width="100%" cellpadding="5" cellspacing="2">
    			<tr>

    				<td class="title">Editing Profile</td>
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
    					You are editing your personal information. This information may be displayed on other pages!
    					<form method="post">
    				</td>
    			</tr>
    			<tr>

    				<td class="form">
	    				<dl class="input">
							<dt><?php echo lang('first_name'); ?></dt>
							<dd><input type="text" class="border cp" name="first_name" value="<?php echo switchs($user_data['first_name'], $_POST['first_name']); ?>"></dd>
		    			</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">
	    				<dl class="input">
							<dt><?php echo lang('last_name'); ?></dt>
							<dd><input type="text" class="border cp" name="last_name" value="<?php echo switchs($user_data['last_name'], $_POST['last_name']); ?>"></dd>
		    			</dl>
    				</td>
    			</tr>
                <tr>
                    <td class="form">

                            <dl class="input">
                                <dt><?php echo lang('location'); ?></dt>
                                <dd><input type="text" class="border cp" name="location" value="<?php echo switchs($user_data['location'], $_POST['location']); ?>"></dd>
                            </dl>
                    </td>
                </tr>
    			<tr>
    				<td class="form">
	    				<dl class="input">
							<dt><?php echo lang('sex'); ?></dt>
							<dd>
<?php
// Determine the users sex by what we can deduce
if(!isset($_POST['gender']) && $user_data['sex'] == "")
{
    $default = "anonymous";
}
else if($_POST['gender'] != "" && $_POST['gender'] != $user_data['sex']) 
{
    $default = $_POST['gender'];
}
else
{
    $default = $user_data['sex'];
}
?>
								<select name="gender" class="border">
									<option value="male"<?php echo equals($default, "male", " selected", ""); ?>>Male</option>
									<option value="female"<?php echo equals($default, "female", " selected", ""); ?>>Female</option>
									<option value="anonymous"<?php echo equals($default, "anonymous", " selected", ""); ?>>Anonymous</option>
								</select>
							</dd>
		    			</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">

							<dl class="input">
								<dt><?php echo lang('msn'); ?></dt>
								<dd><input type="text" class="border cp" name="msn" value="<?php echo switchs($user_data['msn'], $_POST['msn']); ?>"></dd>
							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">

							<dl class="input">
								<dt><?php echo lang('aim'); ?></dt>
								<dd><input type="text" class="border cp" name="aim" value="<?php echo switchs($user_data['aim'], $_POST['aim']); ?>"></dd>
							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">

							<dl class="input">
								<dt><?php echo lang('interests'); ?></dt>
								<dd><textarea class="border cp" name="interests" rows="10"><?php echo htmlspecialchars(stripslashes(switchs($user_data['interests'], $_POST['interests']))); ?></textarea></dd>
							</dl>
    				</td>
    			</tr>
    			<tr>
    				<td class="form">

							<dl class="input">
								<dt>&nbsp;</dt>
								<dd><input type="submit" class="button rounded" name="profile" value="submit"></dd>
							</dl>
						</form>
     				</td>
    			</tr>
			</table>
    	</td>

	</tr>
</table>
