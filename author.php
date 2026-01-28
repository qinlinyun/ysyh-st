<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php $this->need('sidebar.php'); ?>
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="page-title-box">
<h4 class="page-title"><?php $this->archiveTitle(array(
            'author'    =>  _t('%s 的文章')
        ), '', ''); ?><?php if($this->_currentPage>1) echo ' - 第 '.$this->_currentPage.' 页'; ?></h4>
</div>
</div>
</div>
<?php if ($this->have()): ?> 

<div class="card d-block">
<div class="card-body">


<div class="table-responsive">
<table class="table table-hover table-centered mb-0">
<thead>
<tr>
<th>标题</th>
<th>时间</th>


</tr>
</thead>
<tbody>

<?php while($this->next()): ?>
<tr>
<td><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></td>
<td><?php $this->date('Y年m月d日'); ?></td>

 <?php endwhile; ?> 
</tr>




</tbody>
</table>
</div>








<div class="col-12 mt-2">
<?php $this->pageLink('<button type="button" class="btn btn-primary mr-2">上一页</button>'); ?><?php $this->pageLink('<button type="button" class="btn btn-primary">下一页</button>','next'); ?>&nbsp;
<div class="float-right pt-1"><?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?>/<?php echo   ceil($this->getTotal() / $this->parameter->pageSize); ?></div>
</div>


</div></div>
<?php else: ?>
<div class="row justify-content-center">
<div class="col-lg-4">
<div class="text-center">
<p class="text-muted mt-3">作者很懒！什么都没写</p>
<a class="btn btn-info mt-3" href="<?php $this->options->rootUrl(); ?>/"><i class="mdi mdi-reply"></i>返回首页</a>
</div> 
</div> 
</div>
<?php endif; ?>




</div>




<?php $this->need('footer.php'); ?>
