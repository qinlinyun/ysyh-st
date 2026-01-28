<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title">登陆</h4>
</div>
</div>
</div>

<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card">

<div class="card-header pt-4 pb-4 text-center bg-primary">
<a href="<?php $this->options->rootUrl(); ?>/">
<span><img src="<?php if ($this->options->logoUrl): ?><?php $this->options->logoUrl() ?><?php else: ?><?php echo theurl; ?>img/myblog<?php if($this->options->leftsidebar!='light'): ?>-light<?php endif; ?>.png<?php endif; ?>" alt="" height="24"></span>
</a>
</div>
<div class="card-body p-4">
<form action="<?php $this->options->loginAction()?>" method="post" name="login" rold="form">
<input type="hidden" name="referer" value="<?php $this->options->siteUrl(); ?>">
<div class="form-group">
<label for="emailaddress">用户名</label>
<input class="form-control" type="text" id="name" name="name" autocomplete="username" placeholder="请输入用户名" required>
</div>
<div class="form-group">
<!--<a href="" class="text-muted float-right"><small>Forgot your password?</small></a>-->
<label for="password">密码</label>
<input class="form-control" type="password" id="password" name="password" autocomplete="current-password" placeholder="请输入密码" required>
</div>
<div class="form-group mb-3">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" id="checkbox-signin" name="remember" value="1">
<label class="custom-control-label" for="checkbox-signin">下次自动登录</label>
</div>
</div>
<div class="form-group mb-0">
<button class="btn btn-primary" type="submit"> 登陆 </button><?php if($this->options->allowRegister): ?>&nbsp;&nbsp;<a href="<?php $this->options->rootUrl(); ?>?register" class="btn btn-info">注册</a><?php endif; ?>
</div>
</form>
</div> 
</div>



</div> 
</div>

</div>










</div>
</div>