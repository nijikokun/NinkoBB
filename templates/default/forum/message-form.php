<form name="post" method="post">
<input type="hidden" value="<?php echo $reply; ?>" name="reply">
<table border="0" cellspacing="2" cellpadding="5" class="title">
    <tr>
        <td colspan="2">
            <?php echo $title; ?>
        </td>
    </tr>
</table>
<?php if ($error){ ?>
<table border="0" cellspacing="2" cellpadding="5" class="error">
    <tr>
        <td colspan="2" class="text">
            <?php echo $error; ?>
        </td>
    </tr>
</table>
<?php } ?>
<table border="0" cellspacing="2" cellpadding="5" class="post">
    <tr>
        <td colspan="2" valign="top">
			<?php echo lang('subject_c'); ?>:<br />
			<input type="text" name="subject" class="border" style="width: 93%" value="<?php echo switchs(field_clean($_POST['subject']), $subject); ?>" /> 
<?php if($reply){ ?>
            <input name="post" value="reply" type="submit" class="button rounded" />
<?php } else if($edit){ ?>
            <input name="edit" value="edit" type="submit" class="button rounded" />
<?php } else { ?>
            <input name="post" value="submit" type="submit" class="button rounded" />
<?php } ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" width="200px;" valign="top">
            <?php echo lang('message'); ?>:<br />
			<textarea name="content" class="border" style="width: 99.3%; height: 200px;"><?php echo switchs($_POST['content'], $content); ?></textarea>
        </td>
    </tr>
</table>
<table border="0" cellspacing="0" cellpadding="5" class="form">
	<tr>
		<td valign="top" class="features"><?php echo lang('user_features'); ?></td>
<?php if(($_SESSION['admin'] || $_SESSION['moderator']) && !$reply && !$post['reply']){ ?>
        <td valign="top" class="features"><?php echo lang('extra_features'); ?></td>
<?php } ?>
	</tr>
    <tr>
        <td valign="top"<?php if((!$_SESSION['admin'] || !$_SESSION['moderator']) && $reply){ ?> colspan="2" <?php } ?> class="form">
            <div>
                <label for="preview">
                    <input id="preview" type="checkbox" name="preview" value="1" class="border" /> 
                    <?php echo lang('preview'); ?>
                </label>
            </div>
        </td>
<?php if(($_SESSION['admin'] || $_SESSION['moderator']) && !$reply && !$post['reply']){ ?>
        <td valign="top" class="form">
            <div>
                <label for="sticky">
                    <input id="sticky" type="checkbox" name="sticky" class="border" <?php echo equals($post['sticky'], true, ' checked '); ?>/> 
                    <?php echo lang('sticky_topic'); ?>
                </label>
            </div>
            
            <div>
                <label for="closed">
                    <input id="closed" type="checkbox" name="closed" class="border" <?php echo equals($post['closed'], true, ' checked '); ?>/> 
                    <?php echo lang('closed_topic'); ?>
                </label>
            </div>
        </td>
<?php } ?>
    </tr>
</table>
</form>