<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if(!is_ajax()): ?><?php  $this->need('header.php');
 $this->need('sidebar.php'); ?><?php endif; ?>

<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title"><?php $this->title(); ?></h4><!--<?php get_post_view($this) ?>-->
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">

<div class="card d-block">
<div class="card-body page">
<!--<div class="dropdown float-right">
<a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
<i class="dripicons-dots-3"></i>
</a>
<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-142px, 20px, 0px);">

<a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil mr-1"></i>Edit</a>

<a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i>Delete</a>

<a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-email-outline mr-1"></i>Invite</a>

<a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app mr-1"></i>Leave</a>
</div>
</div>-->


<?php $this->content(); ?>


</div> 
</div> 




<?php $this->need('comments.php'); ?>







</div> 













</div>

</div>










<?php if(!is_ajax()): ?>
<?php $this->need('footer.php'); ?>
<?php endif;?>