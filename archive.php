<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 $this->need('sidebar.php');
$lie= array("1","2","4");
 ?>



<div class="container-fluid">

<div class="row">
<div class="col-12">
<div class="page-title-box">
<div class="page-title-right">

</div>
<h4 class="page-title">
<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s'),
            'search'    =>  _t('检索到包含 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
        ), '', ''); ?>
</h4><!--有<?php echo $this->getTotal(); ?>条数据-->
</div>
</div>
</div>
<div class="row archive">
<?php if ($this->have()): ?>
<?php while($this->next()): ?>


<div class="col-<?php echo $lie[2]; ?> col-md-<?php echo $lie[1]; ?> col-xl-<?php echo $lie[0]; ?>">
 
<div class="card d-block"><div class="card-img-bili">
<a href="<?php $this->permalink() ?>"><img class="card-img-top b-lazy y10r5" src="<?php echo theurl; ?>img/load.gif" data-url="<?php showThumbnail($this); ?>" alt="<?php $this->title(); ?>"></a>
 <div class="over"><a href="<?php $this->permalink() ?>"><span class="title"><?php $this->title(); ?></span></a></div>
<?php if($this->fields->zhuangtai>0){echo '<div class="zhuangtai">连载</div>';}else{
if($this->fields->zhuangtai==-1){echo '<div class="zhuangtai">待定</div>';}
} ?>
</div> 

</div> 
</div>
<?php endwhile; ?>

<div class="col-12 mb-3">
<?php if (!empty($this->options->tools) && in_array('pagelist', $this->options->tools)): ?>
<?php $this->pageNav('«', '»', 2, '', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'li', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next',)); ?>
<?php else: ?>
<?php $this->pageLink('<button type="button" class="btn btn-dark mr-2">上一页</button>'); ?><?php $this->pageLink('<button type="button" class="btn btn-dark">下一页</button>','next'); ?>
<div class="float-right pt-1"><?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?>/<?php echo   ceil($this->getTotal() / $this->parameter->pageSize); ?></div>
</div>
<?php endif; ?>
<?php else: ?>
文章不存在！检索不到...
<?php endif; ?>

</div>




















</div>
<?php $this->need('footer.php'); ?>
