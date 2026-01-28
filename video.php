<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="container-fluid mt-4">

<div class="row">
<!--<?php get_post_view($this) ?>-->

<div class="col-md-8">


<?php if ($this->fields->mp4): ?>

<?php 
          //$geturl = $this->fields->iframe;$str1 = explode('aid=', $geturl);$str2 = explode('&cid=', $str1[1]);$av = $str2[0];
          ?>

<?php
$duoji="";

if($this->fields->duoji && strpos($this->fields->duoji,'$') !== false){

$hang = explode("\r\n", $this->fields->duoji);
$shu=count($hang);

for($i=0;$i<$shu;$i++){
$cid=explode("$",$hang[$i])[1];
$this->widget('Widget_Archive@duoji'.$cid, 'pageSize=1&type=post', 'cid='.$cid)->to($ji); 

if($ji->cid==$this->cid){
$duoji=$duoji."<span class=\"btn btn-outline-danger btn-sm ml-1 border-0 disabled\">".explode("$",$hang[$i])[0]."</span>";
}else{
$duoji=$duoji."<a href=\"".$ji->permalink."\" class=\"btn btn-outline-danger btn-sm ml-1 border-0\">".explode("$",$hang[$i])[0]."</a>";
}


}

}

$spurl=$this->fields->mp4;
$sptitle=0;
$x=0;
if(strpos($this->fields->mp4,'$') !== false){

$j=-1;
if($_GET['action'] == 'get' && 'GET' == $_SERVER['REQUEST_METHOD'] ) {
$j=$_GET['p']-1;
}

$txt=$this->fields->mp4;

$string_arr = explode("\r\n", $txt);
$long=count($string_arr);
$list="";
for($i=0;$i<$long;$i++){

if($j==$i){$c="class=\"btn btn-primary btn-space\"";}else{$c="class=\"btn btn-outline-primary btn-space\"";}
$p=$i+1;
$list=$list."<a href=\"".$this->permalink."?action=get&p=".$p."\"".$c.">".explode("$",$string_arr[$i])[0]."</a>";
}
$list= '<div class="card d-block mb-3"> <div class="card-header"><span>剧集</span>'.$duoji.'</div>
<div class="card-body button-list">'.$list.'</div></div>';

$spurl=explode("$",$string_arr[$j])[1];
}
?>




<?php if ($_GET['action'] == 'get' && 'GET' == $_SERVER['REQUEST_METHOD'] && strpos($spurl,'//v.pptv.com/show/') == false): ?>
<script src="https://cdn.bootcdn.net/ajax/libs/hls.js/8.0.0-beta.3/hls.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/dplayer/1.25.1/DPlayer.min.js"></script>
<div id="dplayer"></div>
<script>
const dp = new DPlayer({
                container: document.getElementById('dplayer'),
                screenshot: false,lang: 'zh-cn',
                //logo: 'https://i.loli.net/2019/06/06/5cf8c5d94521136430.png',
                //autoplay: true,
                video: {
                 url: '<?php if(!empty($this->options->tools) && in_array('https', $this->options->tools)){$spurl=str_replace("http://","https://",$spurl);}echo $spurl; ?>',type: 'auto',
                 pic: 'https://wxt.sinaimg.cn/large/87c01ec7gy1fqhvm91iodj21hc0u046d.jpg',
                   //thumbnails: '',
                }, 
//danmaku: {addition: ['https://api.prprpr.me/dplayer/v3/bilibili?aid=<?php echo $av; ?>']},
             
       });
</script>
<?php endif;?>

<?php endif;?>


<div class="card d-block" style="min-height: 232px;">





<div class="card-img-post"><img class="card-img-top y10r5 b-lazy fm" src="<?php echo theurl; ?>img/load.gif" data-url="<?php if($this->fields->thumb){$this->fields->thumb();} ?>"></div>
<div class="card-body"><h3 class="mt-0"><?php $this->title(); ?></h3>
<p>年代：<?php if($this->fields->niandai){ $this->fields->niandai();} ?><br>
类型：<?php $this->tags(' / ', true, 'none'); ?><br>

状态：<?php if($this->fields->zhuangtai>0){echo '连载中';}else{
if($this->fields->zhuangtai==-1){echo '待定';}else{echo '完结';}
} ?>

</p>
<?php $this->content(); ?>
</div> 
</div> 

<?php echo $list; ?>

<?php if(!is_ajax()): ?><?php if($this->options->ad): ?>
<div class="card d-block">
<div class="card-body">
<?php $this->options->ad(); ?>
</div> 
</div><?php endif; ?><?php endif; ?>


<?php $this->need('comments.php'); ?>







</div> 


<?php $this->need('post-sidebar.php'); ?>











</div>

</div>




