<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if(!is_ajax()): ?><?php  $this->need('header.php');
 $this->need('sidebar.php'); ?><?php endif; ?>
<?php if ($this->fields->mp4): ?><?php $this->need('video.php'); ?>
<?php else: ?>
<div class="container-fluid mt-4">

<div class="row">
<div class="col-md-8">

<div class="card d-block">
<div class="card-body post">
<?php if($this->user->uid==$this->authorId):?>
<div class="dropdown float-right">
<a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
<i class="dripicons-dots-3"></i>
</a>
<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
<?php Typecho_Widget::widget('Widget_Security')->to($security); ?>
<a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" class="dropdown-item"><i class="mdi mdi-pencil mr-1"></i>编辑文章</a>
<!--<a href="<?php $security->index('/action/contents-post-edit?do=delete&cid='.$this->cid); ?>" onclick="return p_del();" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>Delete</a>-->
</div>
</div>
<?php endif;?>

<h3 class="mt-0">
<?php $this->title(); ?>
</h3>

<span class="badge badge-primary-lighten mb-1">
<?php $this->category('</span> <span class="badge badge-primary-lighten mb-1">', true, '无分类'); ?></span> <span class="badge badge-secondary-lighten mb-1"><?php $this->tags('</span> <span class="badge badge-secondary-lighten mb-1">', true, '无标签'); ?></span>

<!--<?php get_post_view($this) ?>-->
<?php if($this->hidden||$this->titleshow): ?>
<form action="<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>" method="post">
<div class="form-group mb-3">
<label>请输入密码访问</label>
<div class="input-group">
<input  type="password" class="text" name="protectPassword" class="form-control" placeholder="请输入密码" aria-label="请输入密码"><input type="hidden" name="protectCID" value="<?php $this->cid(); ?>" />
<div class="input-group-append">
<button class="btn btn-primary" type="submit">提交</button>
</div>
</div>
</div>
</form>

<?php else: ?>
<?php $this->content(); ?><?php endif;?>
</div> 
</div> 
<?php if(!is_ajax()): ?><?php if($this->options->ad): ?>
<div class="card d-block">
<div class="card-body">
<?php $this->options->ad(); ?>
</div> 
</div><?php endif; ?><?php endif; ?>


<?php $this->need('comments.php'); ?>







</div> 


<?php if(!is_ajax()): ?>
<?php $this->need('post-sidebar.php'); ?>
<?php endif;?>











</div>

</div>







<?php endif;?>

<?php if(!is_ajax()): ?>
<?php $this->need('footer.php'); ?>
<?php endif;?>