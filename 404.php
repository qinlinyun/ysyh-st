<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('sidebar.php'); ?>
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title">404 Error</h4>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-4">
<div class="text-center">
<img src="<?php echo theurl; ?>img/file-searching.svg" height="90" alt="File not found Image">
<h1 class="text-error mt-4">404</h1>
<h4 class="text-uppercase text-danger mt-3">Page Not Found</h4>
<p class="text-muted mt-3">你好像走错地方了，点击下方按钮回到首页吧！</p>
<a class="btn btn-info mt-3" href="<?php $this->options->rootUrl(); ?>/"><i class="mdi mdi-reply"></i>返回首页</a>
</div> 
</div> 
</div>

</div>
	<?php $this->need('footer.php'); ?>
