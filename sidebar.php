<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if($this->options->fengge!=2): ?>
<div class="left-side-menu">
<div class="slimscroll-menu" id="left-side-menu-container">

<a href="<?php $this->options->rootUrl(); ?>/" class="logo text-center">
<span class="logo-lg">
 <?php if ($this->options->logoUrl): ?>
<img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" height="24">
            <?php else: ?>
<img src="<?php echo theurl; ?>img/logo.jpg" alt="" height="24">
            <?php endif; ?>
</span>
<span class="logo-sm">
<img src="<?php echo theurl; ?>img/logo-sm.jpg" alt="" height="24">
</span>
</a>
<ul class="metismenu side-nav in">
<li class="side-nav-title side-nav-item">导航</li>
<li class="side-nav-item">
<a href="<?php $this->options->rootUrl(); ?>/" class="side-nav-link">
<i class="dripicons-meter"></i>
<span> 首页 </span>
</a>
</li>



<li class="side-nav-item"><a class="side-nav-link" href="<?php $this->options->rootUrl(); ?><?php if($this->options->rewrite==0){echo "/index.php";} ?>/search/sy/?gaojijiansuo=1"><i class="dripicons-search"></i><span>番剧索引</span></a> </li> 

<li class="side-nav-item">
<a href="javascript: void(0);" class="side-nav-link" aria-expanded="false">
<i class="dripicons-view-apps"></i>
<span> 分类 </span>
<span class="menu-arrow"></span>
</a>
<ul class="side-nav-second-level collapse" aria-expanded="false">
<?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
<?php while($categorys->next()): ?>
<?php if ($categorys->levels === 0): ?>
<?php $children = $categorys->getAllChildren($categorys->mid); ?>
<?php if (empty($children)) { ?>
<li class="side-nav-item <?php if($this->is('category', $categorys->slug)): ?>active<?php endif; ?>">
<a href="<?php $categorys->permalink(); ?>" title="<?php $categorys->name(); ?>"><?php $categorys->name(); ?>
</a>
</li>
<?php } else { ?>
<li class="side-nav-item">
<a href="javascript: void(0);" aria-expanded="false"><?php $categorys->name(); ?><span class="menu-arrow"></span>
</a>
<ul class="side-nav-third-level collapse" aria-expanded="false">
<?php foreach ($children as $mid) { ?>
<?php $child = $categorys->getCategory($mid); ?>
<li <?php if($this->is('category', $mid)): ?> class="active"<?php endif; ?>>
<a href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?>
</a>
</li>
<?php } ?>
</ul></li>
<?php } ?><?php endif; ?><?php endwhile; ?>

</ul>
</li>

<li class="side-nav-item">
<a href="javascript: void(0);" class="side-nav-link" aria-expanded="false">
<i class="dripicons-copy"></i>
<span> 页面 </span>
<span class="menu-arrow"></span>
</a>
<ul class="side-nav-second-level collapse" aria-expanded="false">

 <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
<li<?php if($this->is('page', $pages->slug)): ?> class="active"<?php endif; ?>>
<a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
</li>
 <?php endwhile; ?>
</ul>
</li>

</ul>

<div class="clearfix"></div>
</div>

</div>

<?php endif; ?>
<div class="content-page">
<div class="content">
<div id="horizontal-topbar-placeholder">
<div class="navbar-custom<?php if($this->options->fengge==2): ?> topnav-navbar">
<div class="container-fluid">
<a href="<?php $this->options->rootUrl(); ?>/" class="topnav-logo">
            <span class="topnav-logo-lg">
                
 <?php if ($this->options->logoUrl): ?>
<img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" height="24">
            <?php else: ?>
<img src="<?php echo theurl; ?>img/logo.jpg" alt="" height="24">
            <?php endif; ?>
            </span>
            <span class="topnav-logo-sm">
                <img src="<?php echo theurl; ?>img/logo-sm.jpg" alt="" height="24">
            </span>
        </a>
<?php else: ?>"><?php endif; ?>

<ul class="list-unstyled topbar-right-menu float-right mb-0">

<?php if($this->user->hasLogin()): ?>
<li class="dropdown notification-list">
<a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<span class="account-user-avatar">
<img src="<?php tx($this->user->mail); ?>" alt="user-image" class="rounded-circle">
</span>
<span>
<span class="account-user-name"><?php $this->user->screenName(); ?></span>
<span class="account-position"><?php $this->user->mail(); ?></span>
</span>
</a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">


<div class=" dropdown-header noti-title">
<h6 class="text-overflow m-0">Welcome !</h6>
</div>

<a href="<?php $this->options->rootUrl(); ?>/?setting" class="dropdown-item notify-item">
<i class="mdi mdi-account-circle mr-1"></i>
<span>个人设置</span>
</a>

<a href="<?php $this->options->adminUrl(); ?>index.php" class="dropdown-item notify-item">
<i class="mdi mdi-account-edit mr-1"></i>
<span>进入后台</span>
</a>

<a href="<?php $this->options->adminUrl(); ?>manage-posts.php" class="dropdown-item notify-item">
<i class="mdi mdi-lifebuoy mr-1"></i>
<span>管理文章</span>
</a>

<a href="<?php $this->options->logoutUrl(); ?>" class="dropdown-item notify-item">
<i class="mdi mdi-logout mr-1"></i>
<span>登出</span>
</a>
</div>
</li>
<?php else: ?>
<li style="padding: calc(32px / 2) 0;f">
<a href="<?php $this->options->rootUrl(); ?>/?login" class="btn btn-primary">登录</a>
</li>
<?php endif; ?>
</ul>








<?php if($this->options->fengge==2): ?>
<a class="navbar-toggle" data-toggle="collapse" data-target="#topnav-menu-content">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
<?php else: ?>
<button class="button-menu-mobile open-left disable-btn">
<i class="mdi mdi-menu"></i>
</button>

<?php endif; ?>

<div class="app-search">
<form method="post" role="search" style="float: left;">
<div class="input-group">
<!--<input type="hidden" name="cat" id="scbar_mod" value="0">-->
<input type="text" name="s" class="form-control" placeholder="Search...">
<span class="mdi mdi-magnify"></span>
<div class="input-group-append">
<button class="btn btn-dark" type="submit">搜索</button>
</div>
</div>
</form>
</div>
</div>


<?php if($this->options->fengge==2): ?>
</div>
<?php $this->need('sidebar2.php'); ?><?php endif; ?>
</div>
