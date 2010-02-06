<?php
/**
 * register.php
 * 
 * Sign up form!
 * @author Nijiko Yonskai <me@nijikokun.com>
 * @version 1.2
 * @copyright (c) 2010 ANIGAIKU
 * @package ninko
 */
 
include("include/common.php");

// Are they already logged in?
if($_SESSION['logged_in'])
{
	header('Location: index.php');
}

// Defaults
$error = false;
$success = false;

// Have they submitted the form yet?
if(isset($_POST['submit']))
{
	// did they fall for the honeypot?
	if($_POST['username'])
	{
		$error = "bot.";
	}
	else
	{
		load_hook('registration_check');
		
		if(!$error)
		{
			// Age conversion
			$age = "{$_POST['month']}/{$_POST['day']}/{$_POST['year']}";
			
			// The results
			$result = add_user($_POST['blatent'], $_POST['password'], $_POST['pagain'], $_POST['email'], $age);
			
			// Check the results?
			if(is_string($result))
			{
				// String is instant error.
				$error = $result;
			}
			else
			{
				if($result === false)
				{
					$error = lang('error_unknown');
				}
				else
				{
					if(is_numeric($result))
					{
						switch($result)
						{
							case 1: header('location: index.php'); break;
							case 904: $success = lang_parse('success_reg_email_msg', array($_POST['email'])); break;
							default: header('location: index.php'); break;
						}
					}
					else
					{
						header('location: index.php');
					}
				}
			}
		}
	}
}
else if(isset($_GET['e']))
{
	$result = validate_user($_GET['e'], $_GET['k']);
	
	if($result === false)
	{
		$error = lang('error_unknown');
	}
	else if($result === true)
	{
		print_out(lang('account_verified'), lang('redirect'));
	}
	else
	{
		if(is_numeric($result))
		{
			switch($result)
			{
				case 908: $error = lang('error_user_doesnt_exist'); break;
				case 905: $error = lang_parse('error_invalid_given', array(lang('email'))); break;
				case 906: $error = lang_parse('error_no_given', array(lang('key'))); break;
				case 907: $error = lang_parse('error_invalid_given', array(lang('key'))); break;
				case 904: $error = lang_parse('error_no_given', array(lang('email'))); break;
				default: print_out(lang('account_verified'), lang('redirect')); break;
			}
		}
		else
		{
			print_out(lang('account_verified'), lang('redirect'));
		}
	}
}

// Guess not
include($config['template_path'] . "header.php");

?>
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
	</table>
	<?php load_hook('registration_form'); ?>
	<table width="80%" cellpadding="5" cellspacing="0">
		<tr>
			<td>
				<div class="title">
					<?php echo lang('agreement_title'); ?>
				</div>
				<div style="padding:2px" class="post">
					<?php echo lang('agreement_terms'); ?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="submit" value="register" class="button rounded" />
			</td>
		</tr>
	</table>
</form>
</body>
</html>