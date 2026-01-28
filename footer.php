<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer class="footer">
<div class="container-fluid"><div class="row"><div class="col-md-6"><?php coryright(); ?></div></div></div></div></footer>
</div>
</div>
<script src="<?php echo theurl; ?>assets/js/app.min.js?0"></script>
<script src="<?php echo theurl; ?>assets/OwO.min.js?201908161808"></script>
<script><?php if ($this->is('single')) : ?>var url="<?php $this->permalink();?>";<?php endif; ?></script>
<script src="<?php $this->options->themeUrl(); ?>js.js?20191107"></script>

<?php
$p=Typecho_Cookie::getPrefix();
$q=$p.'__typecho_notice';
$y=$p.'__typecho_notice_type';
if (isset($_COOKIE[$y]) &&($_COOKIE[$y]=='success' || $_COOKIE[$y]=='notice' || $_COOKIE[$y]=='error')){
	if (isset($_COOKIE[$q])){
		?><script>
$(function (){$.NotificationApp.send('提示!','<?php echo preg_replace('#\[\"(.*?)\"\]#','$1', $_COOKIE[$q]); ?>！','top-right','rgba(0,0,0,0.2)','success');});
		</script>';
		<?php
Typecho_Cookie::delete('__typecho_notice');
Typecho_Cookie::delete('__typecho_notice_type');
	}
}
?>
<?php $this->footer(); ?>
</body>
</html>