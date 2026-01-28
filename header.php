<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<?php if($this->is('post')): ?><meta name="referrer" content="never"><?php endif; ?>
<title><?php if($this->request->gaojijiansuo){
echo "高级检索 - ";
}else{if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); } ?>
<?php 
if(strpos($this->fields->mp4,'$') !== false && $_GET['action'] == 'get' && 'GET' == $_SERVER['REQUEST_METHOD']){
$txt=$this->fields->mp4;
$string_arr = explode("\r\n", $txt);
$j=$_GET['p']-1;
$sptitle=explode("$",$string_arr[$j])[0];echo $sptitle.' - ';
} ?><?php $this->options->title(); ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<meta name="description" content="<?php $d=$this->fields->d;if(empty($d) || !$this->is('single')){if($this->getDescription()){echo $this->getDescription();}}else{ echo $d;};?>" /><meta name="keywords" content="<?php $k=$this->fields->k;if(empty($k) || !$this->is('single')){echo $this->keywords();}else{ echo $k;};?>" />
<link rel="shortcut icon" href="/favicon.ico">
<link href="<?php echo theurl; ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theurl; ?>assets/css/app.min.css?0" rel="stylesheet" type="text/css" />
<link href="<?php echo theurl; ?>style.css?20191030" rel="stylesheet" type="text/css" />
    <!-- 通过自有函数输出HTML头部信息 -->
<?php $this->header('generator=&template=&keywords=&description=&commentReply='); ?>
<?php if ($this->options->headwen): ?><?php $this->options->headwen(); ?><?php endif; ?>
</head>
<body<?php if($this->options->fengge==2): ?> data-layout="topnav"<?php endif; ?><?php if($this->options->leftsidebar && !$this->options->leftsidebar==0): ?> data-leftbar-theme="<?php $this->options->leftsidebar(); ?>"<?php endif; ?><?php if($this->options->fwidth==1): ?> data-layout-mode="boxed"<?php endif; ?>>
<div class="wrapper">