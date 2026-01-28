<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<title><?php _e('完善帐号信息 - '); $this->options->title(); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="/favicon.ico">
<link href="<?php echo theurl; ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theurl; ?>assets/css/app.min.css?20190731" rel="stylesheet" type="text/css" />
<link href="<?php echo theurl; ?>style.css?20190804" rel="stylesheet" type="text/css" />
</head>
<body<?php if($this->options->fengge==2): ?> data-layout="topnav"<?php endif; ?><?php if($this->options->leftsidebar && !$this->options->leftsidebar==0): ?> data-leftbar-theme="<?php $this->options->leftsidebar(); ?>"<?php endif; ?><?php if($this->options->fwidth==1): ?> data-layout-mode="boxed"<?php endif; ?>>



<div class="wrapper">

<?php $this->need('sidebar.php'); ?>


<div class="container-fluid">

<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title">完善账号信息</h4>
</div>
</div>
</div>

<div class="container">
<div class="row justify-content-center">
<div class="col-lg-5">
<div class="card">
<div class="card-body">


<h4 class="header-title mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 注册向导</font></font></h4>





<div id="basicwizard">
<ul class="nav nav-pills nav-justified form-wizard-header mb-4">
<li class="nav-item">
<a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
<i class="mdi mdi-account-circle mr-1"></i>
<span class="d-none d-sm-inline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">绑定新账号</font></font></span>
</a>
</li>
<li class="nav-item">
<a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
<i class="mdi mdi-face-profile mr-1"></i>
<span class="d-none d-sm-inline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">绑定已有账号</font></font></span>
</a>
</li>

</ul><form action="" method="POST">
<div class="tab-content b-0 mb-0">
<div class="tab-pane active" id="basictab1">
<div class="row">
<div class="col-12">
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="userName"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">昵称</font></font></label>
<div class="col-md-9">
<input class="form-control" type="text" name="screenName" value="<?php if(isset($this->auth['nickname'])) { echo $this->auth['nickname'];}?>"/>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="password"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 邮箱</font></font></label>
<div class="col-md-9">
<input class="form-control" type="text" name="mail"/>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="confirm"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站</font></font></label>
<div class="col-md-9">
<input type="text" name="url" class="form-control"/>
</div>
</div>
<button name="do" value="reg" class="btn btn-block btn-primary">确定</button>
</div>
</div> 
</div>
<div class="tab-pane" id="basictab2">
<div class="row">
<div class="col-12">
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="name"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 用户名</font></font></label>
<div class="col-md-9">
<input class="form-control" type="text" name="name"/>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="surname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 密码</font></font></label>
<div class="col-md-9">
<input class="form-control" type="password" name="password"/>
</div>
</div>
<button name="do" value="bind" class="btn btn-block btn-primary">确定</button>
</div> 
</div> 
</div>



</div>
</div> 
 </form>







</div>
</div> 
</div>
</div>
</div>










</div>
</div>


<?php $this->need('footer.php'); ?>