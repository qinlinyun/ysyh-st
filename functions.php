<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once("lib/url.php");
require_once("tool.php");
function themeConfig($form) {
?>
<style>.row [id*="typecho-option-item-"],#tab-f{padding-left:0;padding-right:0;}#tab-f a{cursor:pointer;}ul,li{list-style:none;margin:5px 0;padding:0;}label.typecho-label{display:block;}textarea{width:100%;height:100px;}label.typecho-label{color:#4099f3;font-weight:bold;}p.description{margin:0;color:#b94a48;}.setc,.helpme{display:none}.btn.primary{color:#667c99;background:#e8ecf3;width:100%;outline:none;}.btn.primary:hover,.btn.primary:focus,.btn.primary:active{color:#667c99;background-color:#c7d2e1;border-color:#415b76;}code{color:red;}.col-mb-12.col-tb-8.col-tb-offset-2 {margin-left: 0;width: 100%;}</style>
<div id="tab-f" class="col-mb-12" role="complementary">
<ul class="typecho-option-tabs clearfix">
<li class="w-40" id="home" onclick="return Tabs.qie('home');" style="background:#E9E9E6;"><a>主设置</a></li>
<li class="w-40" id="setc" onclick="return Tabs.qie('setc');"><a>评论过滤设置</a></li>
<li class="w-20" id="helpme" onclick="return Tabs.qie('helpme');"><a style="color: red;">帮助</a></li>
</ul>
</div>
<script type="text/javascript">
(function(){
    window.Tabs = {
        dom: function(id) {
            return document.getElementById(id)
        },
        pom: function(id) {
            return document.getElementsByClassName(id)[0]
        },
        iom: function(id, dis) {
            var alist = document.getElementsByClassName(id);
            if (alist) {
                for (var idx = 0; idx < alist.length; idx++) {
                    var mya = alist[idx];
                    mya.style.display = dis
                }
            }
        },
        qie: function(c) {this.iom("home", "none");this.iom("setc", "none");this.iom("helpme", "none");this.dom("setc").style.background="";this.dom("home").style.background="";this.dom("helpme").style.background="";
if(c=="helpme"){this.iom("typecho-option-submit", "none");}else{this.iom("typecho-option-submit", "block");}

            this.iom(c, "block");this.dom(c).style.background="#E9E9E6";
            return false
        }
    }
})(); 
</script>
<div class="col-mb-12 typecho-option helpme" id="typecho-option-item-helpme">
<div class="typecho-page-title">
    <h3>关于自定义文章描述与关键字</h3>
</div>
<div class="typecho-table-wrap">
后台文章编辑页面，自定义字段右侧有个<code>TDK</code>按钮，点击后可以根据提示填写内容，一个优质的文章描述和一些有效的文章关键词能够大大提高收录量。
</div>
<div class="typecho-page-title">
    <h3>关于友链页面的建立</h3>
</div>
<div class="typecho-table-wrap">
首先需要安装友链插件：<a target="_blank" href="https://qqdie.com/archives/links-typecho-plugin.html" rel="external nofollow">点击下载</a>
<br>
然后新建独立页面，页面模板选择<code>links</code>，发布页面，然后在友链插件设置里，填写友链信息即可。
</div>

</div>
<?php
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 图片尺寸要求：高度不能大于70px宽度不能大于250px'));$logoUrl->setAttribute('class', 'col-mb-12 typecho-option home');
    $form->addInput($logoUrl);

    $tools = new Typecho_Widget_Helper_Form_Element_Checkbox('tools', 
    array(
'qzlogin' => _t('禁止游客评论（评论需登录）'),
'https' => _t('强制所有视频地址使用https链接【请自行确保视频来源支持https】'),
'pixiv' => _t('文章侧栏显示Pixiv每日Top50小部件【api来自<a href="https://www.mokeyjay.com/archives/1063" rel="external nofollow" class="url">mokeyjay</a>】'),
),
    array('qzlogin'), _t('拓展设置'));$tools->setAttribute('class', 'col-mb-12 typecho-option home');
    $form->addInput($tools->multiMode());

 $gravatars = new Typecho_Widget_Helper_Form_Element_Select('gravatars', array(
'www.gravatar.com/avatar' => _t('gravatar的www源'),'cn.gravatar.com/avatar' => _t('gravatar的cn源'),'secure.gravatar.com/avatar' => _t('gravatar的secure源'),'sdn.geekzu.org/avatar' => _t('极客族'),'gravatar.proxy.ustclug.org/avatar' => _t('中科大[不建议]'),'cdn.v2ex.com/gravatar' => _t('v2ex源'),'dn-qiniu-avatar.qbox.me/avatar' => _t('七牛源[不建议]'),'gravatar.helingqi.com/wavatar' => _t('禾令奇[建议]'),'gravatar.loli.net/avatar' => _t('loli.net源'),
    ), 'gravatar.helingqi.com/wavatar',
    _t('gravatar头像源'), _t('默认gravatar.helingqi.com/wavatar')); $gravatars->setAttribute('class', 'col-mb-6 home');
    $form->addInput($gravatars->multiMode());

 $fwidth = new Typecho_Widget_Helper_Form_Element_Select('fwidth', array(
'0' => _t('流布局'),
'1' => _t('盒子布局')
    ), '0',
    _t('页面布局设置'), _t('默认流布局')); $fwidth->setAttribute('class', 'col-mb-6 home');
    $form->addInput($fwidth->multiMode());

 $fengge = new Typecho_Widget_Helper_Form_Element_Select('fengge', array(
'1' => _t('垂直布局'),
'2' => _t('水平布局')
    ), '2',
    _t('导航布局设置'), _t('默认垂直布局')); $fengge->setAttribute('class', 'col-mb-6 home');
    $form->addInput($fengge->multiMode());

 $leftsidebar = new Typecho_Widget_Helper_Form_Element_Select('leftsidebar', array(
'zi' => _t('默认渐变紫'),
'light' => _t('明亮模式'),
'dark' => _t('暗色模式')
    ), 'dark',
    _t('导航条背景色'), _t('默认渐变紫')); $leftsidebar->setAttribute('class', 'col-mb-6 home');
    $form->addInput($leftsidebar->multiMode());


$headwen = new Typecho_Widget_Helper_Form_Element_Textarea('headwen', NULL,NULL, _t('head头部'), _t('适合填写百度统计等需要插入在head部分的代码'));$headwen->setAttribute('class', 'col-mb-12 home');
$form->addInput($headwen);

$footerwen = new Typecho_Widget_Helper_Form_Element_Textarea('footerwen', NULL,NULL, _t('底部左侧文字'), _t('可以写些备案信息统计什么的，不填则不显示'));$footerwen->setAttribute('class', 'col-mb-12 home');
$form->addInput($footerwen);

$footerwen2 = new Typecho_Widget_Helper_Form_Element_Textarea('footerwen2', NULL,NULL, _t('底部右侧文字'), _t('可以写些备案信息统计什么的，不填则不显示'));$footerwen2->setAttribute('class', 'col-mb-12 home');
$form->addInput($footerwen2);

$stxt = new Typecho_Widget_Helper_Form_Element_Text('stxt', NULL, NULL, _t('缩略图后缀'), _t('这里可以设置文章缩略图地址的后缀，方便使用云存储的朋友设置裁剪规则'));$stxt->setAttribute('class', 'col-mb-12 typecho-option home');
$form->addInput($stxt);

//广告位
$ad = new Typecho_Widget_Helper_Form_Element_Textarea('ad', NULL,NULL,'文章底部广告', _t('可直接填入谷歌广告，或者按这个格式填入自定义广告&lt; href="广告链接" target="_blank"&gt;&lt;img src="广告图片"&gt;&lt;/a&gt;&gt;'));$ad->setAttribute('class', 'col-mb-6 home');
$form->addInput($ad);


//广告位
$ads = new Typecho_Widget_Helper_Form_Element_Textarea('ads', NULL,NULL,'文章右侧栏广告', _t('可直接填入谷歌广告，或者按这个格式填入自定义广告&lt; href="广告链接" target="_blank"&gt;&lt;img src="广告图片"&gt;&lt;/a&gt;&gt;'));$ads->setAttribute('class', 'col-mb-6 home');
$form->addInput($ads);

//评论过滤设置

$opt_nocn = new Typecho_Widget_Helper_Form_Element_Radio('opt_nocn', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "abandon",
			_t('非中文评论操作'), "如果评论中不包含中文，则强行按该操作执行");$opt_nocn->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($opt_nocn);


        $opt_url = new Typecho_Widget_Helper_Form_Element_Radio('opt_url', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "none",
			_t('屏蔽网址操作'), "如果评论发布者的网址与禁止的一致，将执行该操作。如果网址为空，该项不会起作用。");$opt_url->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($opt_url);
        $words_url = new Typecho_Widget_Helper_Form_Element_Textarea('words_url', NULL, "",
			_t('网址关键词'), _t('多个网址请用换行符隔开<br />可以是网址的全部，或者网址部分关键词。如果网址为空，该项不会起作用。'));$words_url->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($words_url);


        $opt_chk = new Typecho_Widget_Helper_Form_Element_Radio('opt_chk', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "none",
			_t('敏感词汇操作'), "如果评论中包含敏感词汇列表中的词汇，将执行该操作");$opt_chk->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($opt_chk);

        $words_chk = new Typecho_Widget_Helper_Form_Element_Textarea('words_chk', NULL, "",
			_t('敏感词汇'), _t('多条词汇请用换行符隔开<br />注意：如果词汇同时出现于禁止词汇，则执行禁止词汇操作'));$words_chk->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($words_chk);

        $opt_au = new Typecho_Widget_Helper_Form_Element_Radio('opt_au', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "none",
			_t('屏蔽昵称关键词操作'), "如果评论发布者的昵称含有该关键词，将执行该操作");$opt_au->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($opt_au);

        $words_au = new Typecho_Widget_Helper_Form_Element_Textarea('words_au', NULL, "",
			_t('屏蔽昵称关键词'), _t('多个关键词请用换行符隔开'));$words_au->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($words_au);
      
        $opt_mail = new Typecho_Widget_Helper_Form_Element_Radio('opt_mail', array("none" => "无动作", "waiting" => "标记为待审核", "spam" => "标记为垃圾", "abandon" => "评论失败"), "none",
			_t('屏蔽邮箱操作'), "如果评论发布者的邮箱与禁止的一致，将执行该操作");$opt_mail->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($opt_mail);
        $words_mail = new Typecho_Widget_Helper_Form_Element_Textarea('words_mail', NULL, "",
			_t('邮箱关键词'), _t('多个邮箱请用换行符隔开<br />可以是邮箱的全部，或者邮箱部分关键词'));$words_mail->setAttribute('class', 'col-mb-12 setc');
        $form->addInput($words_mail);    









}







