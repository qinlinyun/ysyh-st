<?php if(!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title">注册</h4>
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
<form action="<?php $this->options->registerAction();?>" method="post" name="register" role="form">
<input type="hidden" name="_" value="<?php echo $this->security->getToken($this->request->getRequestUrl());?>">
<input type="hidden" name="referer" value="<?php $this->options->siteUrl(); ?>?setting">
<div class="form-group">
<label for="emailaddress">用户名</label>
<input class="form-control" type="text" id="name" name="name" autocomplete="username" placeholder="请输入用户名" required>
</div>
<div class="form-group">
<label for="password">邮箱</label>
<input class="form-control" type="email" id="mail" name="mail" autocomplete="current-password" placeholder="请输入邮箱" required>
</div>

<?php $all = Typecho_Plugin::export(); if(array_key_exists('Rdog', $all['activated'])): ?>
<div class="form-group">
<label for="password">密码</label>
<input class="form-control" type="password" id="passworda" name="password" autocomplete="current-password" placeholder="输入密码" required>
</div>
<div class="form-group">
<label for="password">重复密码</label>
<input class="form-control" type="password" id="confirm" name="confirm" autocomplete="current-password" placeholder="再次输入密码" required>
</div>
<?php endif; ?>

<?php if(array_key_exists('InvitationCode', $all['activated'])): ?>
<div class="form-group">
<label for="password">邀请码</label>
<input type="text" id="code_cxa" name="code_cxa" placeholder="邀请码" value="" class="form-control" />
</div>
<?php endif; ?>
<div class="form-group mb-0">
<button class="btn btn-primary" type="submit" name="loginsubmit" value="true">注册</button>&nbsp;&nbsp;<a href="<?php $this->options->rootUrl(); ?>/?login" class="btn btn-primary"><i class="mdi mdi-reply"></i>返回登录</a>
</div>
</form>
</div> 
</div>



</div> 
</div>

</div>










</div>
</div>