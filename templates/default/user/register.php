<form method="post"  enctype="multipart/form-data">	
	<table width="80%" cellpadding="5" align="center" cellspacing="0">
		<tr>
			<td colspan="2" class="title">
					<?php echo lang('register_for'); ?> <?php echo $config['site_name']; ?>
			</td>
		</tr>
<?php if($success){ ?>
		<tr>
			<td colspan="2" class="error">
				<div class="text">
					<?php if($config['email_validation']){ ?>
						<?php lang('SUCCESS_REG_EMAIL_VALIDATE'); ?>
					<?php } ?>
					<?php echo $success; ?>
				</div>
			</td>
		</tr>
<?php } else if($error){ ?>
		<tr>
			<td colspan="2" class="error">
				<div class="text"><?php echo $error; ?></div>
			</td>
		</tr>
<?php } ?>
		<tr>
			<td colspan="2" class="post">
				<label for="blatent"><?php echo lang('register_username'); ?></label><br />
				<input type="hidden" name="username" class="border" />
				<input type="text" id="blatent" name="blatent" style="width: 99.3%;" class="border" value="<?php echo switchs(field_clean($_POST['blatent'])); ?>" />
			</td>
		</tr>
		<tr>
			<td class="post">
				<label for="password"><?php echo lang('password'); ?></label><br />
				<input type="password" id="password" name="password" style="width: 99.3%;" class="border">
			</td>
			<td class="post">
				<label for="pagain"><?php echo lang('password_again'); ?></label><br />
				<input type="password" id="pagain" name="pagain" style="width: 98%;" class="border">
			</td>
		</tr>
		<tr>
			<td colspan="2" class="post">
				<label for="email"><?php echo lang('email'); ?></label><br />
				<input type="text" id="email" name="email" style="width: 99.3%;" class="border" value="<?php echo switchs(field_clean($_POST['email'])); ?>" />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="post">
				<label for="year"><?php echo lang('birthday'); ?></label><br />
				<select name="month" id="month" style="padding: 2px; margin-right: 2px;" class="border">
<?php 
$i = 1;

$month_data = switchs($_POST['month']);

while($i <= 12)
{
	if($i < 10)
	{
		$num = '0'.$i;
	}
	else
	{
		$num = $i;
	}
	
	if($month_data == $num)
	{
		$insert = " selected";
	}
	else
	{
		$insert = "";
	}
	
	echo '<option value="'.$num.'"'.$insert.'>'.$num.'</option>';
	
	$i++;
}
?>
				</select>
					
				<select name="day" id="day" style="padding:2px" class="border">
<?php 
$i = 1;

$day_data = switchs($_POST['day']);

while($i <= 31)
{
	if($i < 10)
	{
		$num = '0'.$i;
	}
	else
	{
		$num = $i;
	}

	if($day_data == $num)
	{
		$insert = " selected";
	}
	else
	{
		$insert = "";
	}
	
	echo '<option value="'.$num.'"'.$insert.'>'.$num.'</option>';
	
	$i++;
}
?>
				</select>
				<input type="text" id="year" name="year" style="padding: 3px; width:10%;" class="border" value="<?php echo switchs(field_clean($_POST['year'])); ?>">
			</td>
		</tr>

		<?php load_hook('registration_form'); ?>
		
		<tr>
			<td class="post" colspan="2">
				<div class="title">
					<?php echo lang('agreement_title'); ?>
				</div>
				<div style="padding:2px" class="form">
					<?php echo lang('agreement_terms'); ?>
				</div>
			</td>
		</tr>
		<tr>
			<td class="form" colspan="2">
				<input type="submit" name="submit" value="register" class="button rounded" />
			</td>
		</tr>
	</table>
</form>
</body>
</html>