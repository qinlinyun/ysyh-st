<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 $this->need('sidebar.php');
$lie= array("1","2","4");
if($this->options->rewrite==0){
$soso="/index.php/search/sy/";
}else{
$soso="/search/sy/";
}

$sousou=$this->options->rootUrl.$soso;


$gj="";$can="";
if($this->request->gaojijiansuo){
$gj="&gaojijiansuo=1";
}
$cat=intval($this->request->cat);
$tag=intval($this->request->tag);
$niandai=intval($this->request->niandai);
$zhuangtai=intval($this->request->zhuangtai);
if(!$cat){$cat=0;}
if(!$tag){$tag=0;}
if(!$niandai){$niandai=0;}
if(!$zhuangtai){$zhuangtai=-2;}
 ?>



<div class="container-fluid">


<?php if(!$this->request->gaojijiansuo): ?>
<h3>
<?php $this->archiveTitle(array(
'search'    =>  _t('检索到包含 %s 的番剧'),
        ), '', ''); ?></h3>
<div class="row archive mt-2">
<?php else: ?>
<?php 

global $can;
$can='?cat='.$cat.'&tag='.$tag.'&niandai='.$niandai.'&zhuangtai='.$zhuangtai.$gj;

class Typecho_Widget_Helper_PageNavigator_Classic extends Typecho_Widget_Helper_PageNavigator
{

    public function prev($prevWord = 'PREV')
    {
        //输出上一页
        if ($this->_total > 0 && $this->_currentPage > 1) {
            echo '<a class="prev" href="' . str_replace($this->_pageHolder, $this->_currentPage - 1, $this->_pageTemplate) . $this->_anchor . $GLOBALS["can"] . '">'
            . $prevWord . '</a>';
        }
    }

    public function next($nextWord = 'NEXT')
    {
        //输出下一页
        if ($this->_total > 0 && $this->_currentPage < $this->_totalPage) {
            echo '<a class="next" title="" href="' . str_replace($this->_pageHolder, $this->_currentPage + 1, $this->_pageTemplate) . $this->_anchor . $GLOBALS["can"] . '">'
            . $nextWord . '</a>';
        }
    }
}

 ?>
<div class="row archive mt-2">
<div class="col-12">
          <div class="card card-contrast">
                <div class="card-header card-header-contrast card-header-featured">
高级索引
</div>
                <div class="card-body">
<div class="mb-1">类型：<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&tag=0&cat=<?php echo $cat.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="btn btn-space<?php if($tag==0){echo " btn-primary";} ?>">全部</a>

<?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, ))->to($tags); ?>  
<?php while($tags->next()): ?>  
<a rel="tag" href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&tag=<?php $tags->mid(); ?>&cat=<?php echo $cat.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="btn btn-space<?php if($tag==$tags->mid){echo " btn-primary";} ?>"><?php $tags->name(); ?></a>
<?php endwhile; ?>

</div>
<div class="mb-1">地区：<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=0&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="btn btn-space<?php if($cat==0){echo " btn-primary";} ?>">全部</a>                    
<?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
<?php while($categorys->next()): ?>
<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php $categorys->mid(); ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" title="<?php $categorys->name(); ?>" class="btn btn-space<?php if($cat==$categorys->mid){echo " btn-primary";} ?>"><?php $categorys->name(); ?></a>
 <?php endwhile; ?>

</div>

<div class="mb-1">状态：<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=0" class="btn btn-space<?php if($zhuangtai==-2){echo " btn-primary";} ?>">全部</a>    
<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=2" class="btn btn-space<?php if($zhuangtai==2){echo " btn-primary";} ?>">完结</a>
<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=1" class="btn btn-space<?php if($zhuangtai==1){echo " btn-primary";} ?>">连载</a>

<a href="<?php echo $sousou; ?>?niandai=<?php echo $niandai; ?>&cat=<?php echo $cat; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=-1" class="btn btn-space<?php if($zhuangtai==-1){echo " btn-primary";} ?>">待定</a>
</div>



<div class="mb-1">年代：<a href="<?php echo $sousou; ?>?niandai=0&cat=<?php echo $cat; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="btn btn-space<?php if($niandai==0){echo " btn-primary";} ?>">全部</a>     
<?php 
$y=date('Y');
for($i=0;$i<15;$i++){
$c="";
if($y==$niandai){$c=" btn-primary";}
echo '<a href="'.$sousou.'?niandai='.$y.'&cat='.$cat.'&tag='.$tag.$gj.'&zhuangtai='.$zhuangtai.'" class="btn btn-space'.$c.'">'.$y.'</a>';
$y--;
}
?>
<a href="<?php echo $sousou; ?>?niandai=-<?php echo $y; ?>&cat=<?php echo $cat; ?>&tag=<?php echo $tag.$gj; ?>&zhuangtai=<?php echo $zhuangtai; ?>" class="btn btn-space<?php if($niandai==-$y){echo " btn-primary";} ?>">更早</a>
</div>
                </div>
              </div>
            </div>
<?php endif; ?>











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
<div id="pagexxoo">
<?php if (!empty($this->options->tools) && in_array('pagelist', $this->options->tools)): ?>
<?php $this->pageNav('«', '»', 2, '', array('wrapTag' => 'ul', 'wrapClass' => 'pagination', 'itemTag' => 'li', 'textTag' => 'li', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next',)); ?>
<?php else: ?>
<?php $this->pageLink('<button type="button" class="btn btn-dark mr-2">上一页</button>'); ?><?php $this->pageLink('<button type="button" class="btn btn-dark">下一页</button>','next'); ?>
<div class="float-right pt-1"><?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?>/<?php echo   ceil($this->getTotal() / $this->parameter->pageSize); ?></div>
</div>
<?php endif; ?>
</div>
<?php else: ?>
文章不存在！检索不到...
<?php endif; ?>

</div>




















</div>
<?php $this->need('footer.php'); ?>
