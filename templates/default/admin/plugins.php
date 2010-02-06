		<td valign="top" align="left">
			<table class="ac" width="100%" cellpadding="5" cellspacing="0">
				<tr>
					<td colspan="3" class="title"><?php echo lang('admin_cp'); ?> - <?php echo lang('manage_plugins'); ?></td>
				</tr>
<?php if ($error){ ?>
                <tr>
                    <td class="error" colspan="3">
                        <?php echo $error; ?>
                    </td>
                </tr>
<?php } else if($success){ ?>
                <tr>
                    <td class="error" colspan="3">
                        <?php echo $success; ?>
                    </td>
                </tr>
<?php } ?>
				<tr>
					<td class="item key"><?php echo lang('plugin_c'); ?></td>
					<td colspan="2" class="item key"><?php echo lang('actions'); ?></td>
				</tr>
<?php 
foreach($plugins as $plugin)
{ 
	if(!is_array($plugin) || $plugin['name'] == "") { continue; }
		
	// Trim subject
	$content = character_limiter(trim(stripslashes($plugin['description'])), 35);
		
	// Build topic url
	$post_url = "{$config['url_path']}/read.php?id={$row['reply']}&page={$n}";
		
	// Is the plugin active?
	if(is_loaded($plugin['plugin']))
	{
		$style = "background-color: #90FF90;";
	}
		
	if(!isset($plugin['error']))
	{
?>
                <tr>
                    <td nowrap="nowrap" width="80%" style="<?php echo $style; ?>" class="item"> 
						<?php echo $plugin['name']; ?> - <span class="item"><?php echo $content; ?><br />
						<small>Plugin by <?php echo $plugin['author']; ?></small>
                    </td>
                    <td nowrap="nowrap" align="center" style="<?php echo $style; ?>" class="item key">
                        <a href="<?php echo $config['url_path']; ?>/admin.php?a=plugins&activate=<?php echo $plugin['plugin']; ?>"><?php echo lang('activate'); ?></a>
                    </td>
                    <td nowrap="nowrap" align="center" style="<?php echo $style; ?>" class="item key">
                        <a href="<?php echo $config['url_path']; ?>/admin.php?a=plugins&deactivate=<?php echo $plugin['plugin']; ?>"><?php echo lang('deactivate'); ?></a>
                    </td>
                </tr>
<?php
	}
	else
	{
?>
                <tr>
                    <td nowrap="nowrap" width="80%" style="<?php echo $style; ?>" class="item"> 
						<?php echo $plugin['name']; ?> <br />
						<?php echo $plugin['error']; ?>
                    </td>
                    <td nowrap="nowrap" align="center" style="<?php echo $style; ?>" class="item key"></td>
                    <td nowrap="nowrap" align="center" style="<?php echo $style; ?>" class="item key"></td>
                </tr>
<?php
	}
}	
?>
			</table>
    	</td>
	</tr>
</table>
