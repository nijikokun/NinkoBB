<table border="0" cellpadding="0" cellspacing="0" class="footer bottom-rounded">
    <tr>
        <td width="375" class="bodyfont"><div align="left">
<?php
if($pagination)
{
    echo lang('pages') . ": ";
    echo $pagination;
}
?>
        </div>
    </td>
    <td height="20" align="right" class="bodyfont">
        <div align="right">
            <a name="bottom"></a>
            <a href="<?php echo $config['url_path']; ?>"><?php echo lang('home_c'); ?></a> | 
<?php if($in_topic){ ?>
    <?php if($closed && !$_SESSION['is_admin']){ ?>
            <a href=""><?php echo lang('closed'); ?></a>
    <?php } else { ?>
            <a href="<?php echo $config['url_path']; ?>/message.php?page=<?php echo $page; ?>&amp;reply=<?php echo $topic['id']; ?>"><?php echo lang('reply_c'); ?></a> | 
    <?php } ?>
<?php } else { ?>
            <a href="<?php echo $config['url_path']; ?>/message.php?reply=0"><?php echo lang('start_new_topic'); ?></a> | 
<?php } ?>
            Powered by <a href="http://ninko.anigaiku.com/">Ninko</a>

         </div>
     </td>
</tr>
</table>
</div>
<script>
	$("a#qq").click(function(){
            var id = $(this).attr('alt');
            var data = $(this).attr('value');
            var username = $(this).attr('name');
            
            // start the html part
                data = "[quote=" + username + "]" + $.trim(data) + "[/quote]";
            
            $("#qcontent").val($("#qcontent").val() + $.trim(data));
			
			$.scrollTo('#qr', 800);
        });
    </script>
</body>
</html>