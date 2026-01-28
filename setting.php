<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title">设置用户信息</h4>
</div>
</div>
</div>

<div class="container">
<div class="row justify-content-center">
<div class="col-12">
<div class="card">


<div class="card-body">


<h4 class="header-title mb-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 设置向导</font></font></h4>


<?php
Typecho_Widget::widget('Widget_Security')->to($security);
?>


<div id="basicwizard">
<ul class="nav nav-pills nav-justified form-wizard-header mb-4">
<li class="nav-item">
<a href="#basictab1" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
<i class="mdi mdi-account-circle mr-1"></i>
<span class="d-none d-sm-inline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改资料</font></font></span>
</a>
</li>
<li class="nav-item">
<a href="#basictab2" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
<i class="mdi mdi-face-profile mr-1"></i>
<span class="d-none d-sm-inline"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改密码</font></font></span>
</a>
</li>

</ul>
<div class="tab-content b-0 mb-0">
<div class="tab-pane active" id="basictab1"><form action="<?php $security->index('/action/users-profile'); ?>" method="post" enctype="application/x-www-form-urlencoded">
<div class="row">
<div class="col-12">
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="uid"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户ID</font></font></label>
<div class="col-md-9">
<label class="col-form-label" for="uid"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php $this->user->uid() ?></font></font></label>
</div>
</div>



<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="userName"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">昵称</font></font></label>
<div class="col-md-9">
<input class="form-control" type="text" name="screenName" value="<?php $this->user->screenName(); ?>"/>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="password"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 邮箱</font></font></label>
<div class="col-md-9">
<input class="form-control" type="text" name="mail" value="<?php $this->user->mail(); ?>"/>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="confirm"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">网站</font></font></label>
<div class="col-md-9">
<input type="text" name="url" class="form-control" value="<?php $this->user->url(); ?>"/>
</div>
</div>
<input name="do" type="hidden" value="profile">
<button type="submit" class="btn btn-block btn-primary">确定</button>
</div> 
</div></form> 
</div>
<div class="tab-pane" id="basictab2"><form action="<?php $security->index('/action/users-profile'); ?>" method="post" enctype="application/x-www-form-urlencoded">
<div class="row">
<div class="col-12">
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="surname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 密码</font></font></label>
<div class="col-md-9">
<input class="form-control" type="password" name="password"/>
</div>
</div>
<div class="form-group row mb-3">
<label class="col-md-3 col-form-label" for="surname"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> 重复密码</font></font></label>
<div class="col-md-9">
<input class="form-control" type="password" name="confirm"/>
</div>
</div>
<input name="do" type="hidden" value="password">
<button type="submit" class="btn btn-block btn-primary">确定</button>
</div> 
</div> </form>
</div>


</div> 
</div> 






</div> 
</div>



</div> 
</div>

</div>










</div>
</div>