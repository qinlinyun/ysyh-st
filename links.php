<?php 
/**
 * links
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
$this->need('sidebar.php'); ?>

<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title"><?php $this->title(); ?></h4>
</div>
</div>


<?php Links_Plugin::output('<div class="col-4 col-sm-3 col-lg-2" style="text-align: center;"><a href="{url}"  title="{title}" target="_blank">
<div class="card">
<div class="card-body p-1">
<span class="mb-1 link">
<img src="'.theurl.'img/load.gif" data-url="{image}" $4="" class="rounded-circle img-thumbnail b-lazy">
</span>
<div class="media-body">
<h4 class="mt-1 mb-1">{name}</h4>
</div></div></div></a></div>'); ?>


<div class="col-12">
<div class="card d-block">
<div class="card-body">

<?php  $this->content(); ?>
</div> </div> </div>


<div class="col-12">




<?php $this->need('comments.php'); ?>







</div> 



</div>









</div>

</div>











<?php $this->need('footer.php'); ?>
