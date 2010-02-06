<?php load_hook('quickreply_before'); ?>
<form action="<?php echo $topic_url; ?>" method="post">
<input type="hidden" name="reply" value="<?php echo $topic['id']; ?>">
<table border="0" cellspacing="2" cellpadding="5" id="qr" class="title">
    <tr>
        <td colspan="2">
            <?php echo lang('quick_reply'); ?>
        </td>
    </tr>
</table>
<?php if ($error){ ?>
<table border="0" cellspacing="2" cellpadding="5" class="error">
    <tr>
        <td colspan="2" class="text">
            <strong><?php echo lang('error_c'); ?> </strong> <?php echo $error; ?>
        </td>
    </tr>
</table>
<?php } ?>
<table border="0" cellspacing="2" cellpadding="5" class="form">
	<?php load_hook('quickreply_inside_before'); ?>
    <tr>
		<td valign="top">
			<?php echo lang('subject'); ?>:<br />
			<input type="text" name="qsubject" class="border" style="width: 93%" value="<?php echo switchs(field_clean($_POST['qsubject'])); ?>" /> <input name="post" value="<?php echo lang('reply'); ?>" type="submit" />
		</td>
    </tr>
    <tr>
		<td width="200px;" valign="top">
			<?php echo lang('message'); ?>:<br />
			<textarea name="qcontent" id="qcontent" class="border" style="width: 99.3%; height: 150px;"><?php echo switchs(field_clean($_POST['qcontent'])); ?></textarea>
		</td>
    </tr>
	<?php load_hook('quickreply_inside_after'); ?>
</table>
</form>
<?php load_hook('quickreply_after'); ?>