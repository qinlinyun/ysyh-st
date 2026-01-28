<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 自定义关键字
if($_SERVER['SCRIPT_NAME']=="/admin/write-post.php"){
function themeFields($layout) {


    $okdizhi = new Typecho_Widget_Helper_Form_Element_Text('okdizhi', NULL, NULL, _t('ok'), _t('ok资源网地址http://okzyw.net/<style>table.typecho-list-table.mono input {width: 100%;}table.typecho-list-table.mono textarea {width: 100%;height: 150px;}</style>'));$okdizhi->setAttribute('id', 'okdizhi');
    $layout->addItem($okdizhi);

    $niandai = new Typecho_Widget_Helper_Form_Element_Text('niandai', NULL, NULL, _t('年代'), _t('填入时间'));
    $layout->addItem($niandai);

    $zhuangtai = new Typecho_Widget_Helper_Form_Element_Select('zhuangtai', array(0 => _t('完结'), 1 => _t('连载'), -1 => _t('待定')), 0, _t('状态'), _t('默认完结'));
    $layout->addItem($zhuangtai);

    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('缩略图'), _t('图片地址'));
    $layout->addItem($thumb);

    $mp4 = new Typecho_Widget_Helper_Form_Element_Textarea('mp4', NULL, NULL, _t('视频地址'), _t('输入视频地址'));
    $layout->addItem($mp4);


    $duoji= new Typecho_Widget_Helper_Form_Element_Textarea('duoji', NULL, NULL, _t('多季'), _t('格式如：第一季$文章id'));
    $layout->addItem($duoji);

    $autoup= new Typecho_Widget_Helper_Form_Element_Text('autoup', NULL, NULL, _t('自动更新参数'), _t('格式如：okzyw$ok资源网的视频页id，更多支持网站参数详见autoup插件'));
    $layout->addItem($autoup);

}
}
function stu($dizhi){
if(strpos($dizhi,'ax1x.com') !== false){ 
$dizhi=str_replace(".png",".th.png",$dizhi);
$dizhi=str_replace(".jpg",".th.jpg",$dizhi);
}
return $dizhi;
}

function getSSLPage($url) {
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSLVERSION,30); 
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function themeInit($archive)
{
// 强奸用户，强制开启反垃圾保护来兼容ajax评论
 Helper::options()->commentsAntiSpam = true;
// 强奸用户，强制用户文章最新评论显示在文章首页
 Helper::options()->commentsPageDisplay = 'first';
// 强奸用户，将较新的评论显示在前面
 Helper::options()->commentsOrder= 'DESC';
// 强奸程序，突破评论回复楼层限制
 Helper::options()->commentsMaxNestingLevels = 999;
// 作者主页显示20篇文章
if ($archive->is('author')) {
       $archive->parameter->pageSize = 20; // 自定义条数
}

if($archive->is('index') && $archive->request->isGet() && isset($archive->request->wd)){
$c=$_GET['wd'];


echo getSSLPage('http://cj.okzy.tv/inc/feifei3/?h=&t=&ids=&wd='.$c.'&type=24&mid=1&param=&p=');

//echo getSSLPage('http://www.123ku.com/inc/feifei3.4/?h=&t=&ids=&wd='.$c.'&type=24&mid=1&param=&p=');

//echo getSSLPage('http://cj.wlzy.tv/api/ff/vod/?h=&t=&ids=&wd='.$c.'&type=24&mid=1&param=&p=');

//echo getSSLPage('http://www.zdziyuan.com/inc/feifei3.4/?h=&t=&ids=&wd='.$c.'&type=24&mid=1&param=&p=');


//echo getSSLPage('https://www.mhapi123.com/inc/feifei3/?h=&t=&ids=&wd='.$c.'&type=24&mid=1&param=&p=');
exit;
}

// 为文章或页面、post操作，且包含参数`themeAction=comment`(自定义)
if($archive->is('single') && $archive->request->isPost() && $archive->request->is('themeAction=comment')){
ajaxComment($archive);
}
  
$archive->content=preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" target=\"_blank\" rel=\"nofollow\">", $archive->content);

$archive->content=kz($archive);
$user = Typecho_Widget::widget('Widget_User');
if(preg_match("/\[hide\](.*?)\[\/hide\]/", $archive->content) !== false && $user->uid!=$archive->authorId)
{
$archive->content=hidecontent($archive);
}else{
$archive->content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view-ok"><fieldset><legend>回复可见内容</legend>$1</fieldset></div>',$archive->content);
}

/*表格处理*/
$archive->content = preg_replace("/<table>(.*?)<\/table>/",'<div class="table-responsive-sm"><table class="table table-bordered table-centered mb-0">$1</table></div>',$archive->content);

$archive->content = parseBiaoQing($archive->content);
  
/*QQ头像api*/
if($archive->is('index') && $archive->request->isGet() && isset($archive->request->id)){$b5d1a6bd5b8f21f704dc8365a2ed3c4=$_GET['id'];$db = Typecho_Db::get();$plinfo=$db->fetchRow($db->select()->from ('table.comments')->where ('table.comments.coid=?',$b5d1a6bd5b8f21f704dc8365a2ed3c4)->where ('table.comments.status=?','approved'));$c=$plinfo['mail'];$f=str_replace('@qq.com','',$c);if(strstr($c,"qq.com")&&is_numeric($f)&&strlen($f)<11&&strlen($f)>4){$geturl = 'https://s.p.qq.com/pub/get_face?img_type=3&uin='.$f;$headers = get_headers($geturl, TRUE);if($headers){$g = $headers['Location'];$g = str_replace("http:","https:",$g);}else{$g='//q.qlogo.cn/g?b=qq&nk='.$f.'&s=100';}}else{$g=tx($c,1);}$r = array('url'=>$g);echo json_encode($r);exit;}

}

/**
 * ajaxComment
 * 实现Ajax评论的方法(实现feedback中的comment功能)
 * @param Widget_Archive $archive
 * @return void
 */
function ajaxComment($archive){
    $options = Helper::options();
    $user = Typecho_Widget::widget('Widget_User');
    $db = Typecho_Db::get();
    // Security 验证不通过时会直接跳转，所以需要自己进行判断
    // 需要开启反垃圾保护，此时将不验证来源
//if($archive->request->get('_') != Helper::security()->getToken($archive->request->getReferer())){
//   $archive->response->throwJson(array('status'=>0,'msg'=>_t('请求出现问题，请刷新重试！')));
//}
    /** 评论关闭 */
    if(!$archive->allow('comment')){
        $archive->response->throwJson(array('status'=>0,'msg'=>_t('评论已关闭')));
    }
    /** 检查ip评论间隔 */
    if (!$user->pass('editor', true) && $archive->authorId != $user->uid &&
    $options->commentsPostIntervalEnable){
        $latestComment = $db->fetchRow($db->select('created')->from('table.comments')
                    ->where('cid = ?', $archive->cid)
                    ->where('ip = ?', $archive->request->getIp())
                    ->order('created', Typecho_Db::SORT_DESC)
                    ->limit(1));

        if ($latestComment && ($options->gmtTime - $latestComment['created'] > 0 &&
        $options->gmtTime - $latestComment['created'] < $options->commentsPostInterval)) {
            $archive->response->throwJson(array('status'=>0,'msg'=>_t('对不起, 您的发言过于频繁, 请稍侯再次发布')));
        }        
    }

    $comment = array(
        'cid'       =>  $archive->cid,
        'created'   =>  $options->gmtTime,
        'agent'     =>  $archive->request->getAgent(),
        'ip'        =>  $archive->request->getIp(),
        'ownerId'   =>  $archive->author->uid,
        'type'      =>  'comment',
        'status'    =>  !$archive->allow('edit') && $options->commentsRequireModeration ? 'waiting' : 'approved'
    );

    /** 判断父节点 */
    if ($parentId = $archive->request->filter('int')->get('parent')) {
        if ($options->commentsThreaded && ($parent = $db->fetchRow($db->select('coid', 'cid')->from('table.comments')
        ->where('coid = ?', $parentId))) && $archive->cid == $parent['cid']) {
            $comment['parent'] = $parentId;
        } else {
            $archive->response->throwJson(array('status'=>0,'msg'=>_t('父级评论不存在')));
        }
    }
    $feedback = Typecho_Widget::widget('Widget_Feedback');
    //检验格式
    $validator = new Typecho_Validate();
    $validator->addRule('author', 'required', _t('必须填写用户名'));
    $validator->addRule('author', 'xssCheck', _t('请不要在用户名中使用特殊字符'));
    $validator->addRule('author', array($feedback, 'requireUserLogin'), _t('您所使用的用户名已经被注册,请登录后再次提交'));
    $validator->addRule('author', 'maxLength', _t('用户名最多包含200个字符'), 200);

    if ($options->commentsRequireMail && !$user->hasLogin()) {
        $validator->addRule('mail', 'required', _t('必须填写电子邮箱地址'));
    }

    $validator->addRule('mail', 'email', _t('邮箱地址不合法'));
    $validator->addRule('mail', 'maxLength', _t('电子邮箱最多包含200个字符'), 200);

    if ($options->commentsRequireUrl && !$user->hasLogin()) {
        $validator->addRule('url', 'required', _t('必须填写个人主页'));
    }
    $validator->addRule('url', 'url', _t('个人主页地址格式错误'));
    $validator->addRule('url', 'maxLength', _t('个人主页地址最多包含200个字符'), 200);

    $validator->addRule('text', 'required', _t('必须填写评论内容'));

    $comment['text'] = $archive->request->text;

    /** 对一般匿名访问者,将用户数据保存一个月 */
    if (!$user->hasLogin()) {
        /** Anti-XSS */
        $comment['author'] = $archive->request->filter('trim')->author;
        $comment['mail'] = $archive->request->filter('trim')->mail;
        $comment['url'] = $archive->request->filter('trim')->url;

        /** 修正用户提交的url */
        if (!empty($comment['url'])) {
            $urlParams = parse_url($comment['url']);
            if (!isset($urlParams['scheme'])) {
                $comment['url'] = 'http://' . $comment['url'];
            }
        }

        $expire = $options->gmtTime + $options->timezone + 30*24*3600;
        Typecho_Cookie::set('__typecho_remember_author', $comment['author'], $expire);
        Typecho_Cookie::set('__typecho_remember_mail', $comment['mail'], $expire);
        Typecho_Cookie::set('__typecho_remember_url', $comment['url'], $expire);
    } else {
        $comment['author'] = $user->screenName;
        $comment['mail'] = $user->mail;
        $comment['url'] = $user->url;

        /** 记录登录用户的id */
        $comment['authorId'] = $user->uid;
    }



    /** 评论者之前须有评论通过了审核 */
    if (!$options->commentsRequireModeration && $options->commentsWhitelist) {
        if ($feedback->size($feedback->select()->where('author = ? AND mail = ? AND status = ?', $comment['author'], $comment['mail'], 'approved'))) {
            $comment['status'] = 'approved';
        } else {
            $comment['status'] = 'waiting';
        }
    }

    if ($error = $validator->run($comment)) {
        $archive->response->throwJson(array('status'=>0,'msg'=> implode(';',$error)));
    }


if($archive->hidden){
        $archive->response->throwJson(array('status'=>0,'msg'=>_t('加密文章！输入正确密码后方可进行评论！')));
}

          /** 生成过滤器 */
        try {
            $comment = $feedback->pluginHandle()->comment($comment, $feedback->_content);
        } catch (Typecho_Exception $e) {
            Typecho_Cookie::set('__typecho_remember_text', $comment['text']);
          $archive->response->throwJson(array('status'=>0,'msg'=>_t($e->getMessage())));
            throw $e;
        }

  

    /** 添加评论 */
    $commentId = $feedback->insert($comment);
    if(!$commentId){
        $archive->response->throwJson(array('status'=>0,'msg'=>_t('评论失败，请刷新页面重试！')));
    }
    Typecho_Cookie::delete('__typecho_remember_text');
    $db->fetchRow($feedback->select()->where('coid = ?', $commentId)
    ->limit(1), array($feedback, 'push'));
$feedback->pluginHandle()->finishComment($feedback);
$status="";
if ('waiting' == $feedback->status) { $status='<span class="text-muted">您的评论需管理员审核后才能显示！</span>';}
$os = getOs($feedback->agent);
if($user->uid>0){if($user->uid == $archive->authorId){$sf="<i class=\"mdi mdi-account-check\"></i> 作者";}else{$sf="<i class=\"mdi mdi-account-box\"></i> 用户";}}else{$sf="<i class=\"mdi mdi-account-clock\"></i> 游客";}

    // 返回评论数据
    $data = array(
        'cid' => $feedback->cid,
        'coid' => $feedback->coid,
        'parent' => $feedback->parent,
        'mail' => $feedback->mail,
        'url' => $feedback->url,
        'ip' => $feedback->ip,
        'agent' => $feedback->agent,
        'author' => $feedback->author,
        'authorId' => $feedback->authorId,
        'permalink' => $feedback->permalink,
        'created' => timesince($feedback->created),
        'datetime' => $feedback->date->format('Y-m-d H:i:s'),
        'status' => $status,
        'sf' => $sf,
        'os' => $os,
    );
    // 评论内容
    ob_start();
    $feedback->content();
    $data['content'] = ob_get_clean();
    $data['content']=parseBiaoQing($data['content']);
    $data['avatar'] = tx($data['mail'],1,0);
    $archive->response->throwJson(array('status'=>1,'comment'=>$data));
}
function s($uid){$db = Typecho_Db::get(); $authCode = function_exists('openssl_random_pseudo_bytes') ? bin2hex(openssl_random_pseudo_bytes(16)) : sha1(Typecho_Common::randString(20));$user = array('uid'=>$uid,'authCode'=>$authCode);Typecho_Cookie::set('__typecho_uid', $uid, 0);Typecho_Cookie::set('__typecho_authCode', Typecho_Common::hash($authCode), 0);$db->query($db->update('table.users')->expression('logged', 'activated')->rows(array('authCode' => $authCode))->where('uid = ?', $uid));}
/**
* 检查$str中是否含有$words_str中的词汇
* 
*/
function check_in($words_str, $str)
	{
		$words = explode("\n", $words_str);
		if (empty($words)) {
			return false;
		}
		foreach ($words as $word) {
            if (false !== strpos($str, trim($word))) {
                return true;
            }
		}
		return false;
	}

function timesince($older_date,$comment_date = false) {
if($older_date=="no"){return;}
$chunks = array(
array(86400 , ' 天'),
array(3600 , ' 小时'),
array(60 , ' 分'),
array(1 , ' 秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);

for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.'前';

return $output;
}

function hidecontent($archive){
$db = Typecho_Db::get();
$user = Typecho_Widget::widget('Widget_User');
if($user->uid > 0){
$sql = $db->select()->from('table.comments')
    ->where('cid = ?',$archive->cid)
    ->where('authorId = ?', $user->uid)
    ->where('status = ?', 'approved')
    ->limit(1);
}else{
$sql = $db->select()->from('table.comments')
    ->where('cid = ?',$archive->cid)
    ->where('mail = ?', $archive->remember('mail',true))
    ->where('status = ?', 'approved')
    ->limit(1);
}
$result = $db->fetchAll($sql);

if($result) {
    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view-ok"><fieldset><legend>回复可见内容</legend>$1</fieldset></div>',$archive->content);
}
else{
    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view">此处内容需要评论回复后方可阅读</div>',$archive->content);
}
return $content;
}
function kz($archive){
  
 $content = preg_replace('#\[(btn|button) (url|href)="(.*?)"\](.*?)\[\/btn\]#','<a href="$3" class="btn btn-primary mr-1" target="_blank">$4</a>',$archive->content);
return $content;
}

function tx($mail,$re=0,$id=0)
{
$a=Typecho_Widget::widget('Widget_Options')->gravatars;
$b='https://'.$a.'/';
$c=strtolower($mail);
$d=md5($c);
$f=str_replace('@qq.com','',$c);
if(strstr($c,"qq.com")&&is_numeric($f)&&strlen($f)<11&&strlen($f)>4){
$g='//q.qlogo.cn/g?b=qq&nk='.$f.'&s=100';
if($id>0){$g = Helper::options()->rootUrl.'?id='.$id.'" data-type="qqtx';}
}else{$g=$b.$d.'?d=mm';}
if($re==1){return $g;}else{echo $g;}
}

function cname($mid){
$db = Typecho_Db::get();
$plinfo=$db->fetchRow($db->select()->from ('smile_metas')->where ('smile_metas.mid=?',$mid));

return $plinfo['name'];
}

function showThumbnail($widget)
{ 
    $random = theurl.'img/slt/'.rand(1,4).'.jpg';
    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i'; 
   $img=$random;
if($widget->fields->thumb){
$img=stu($widget->fields->thumb);
}else if (preg_match_all($pattern, $widget->content, $thumbUrl)) {
         $img = $thumbUrl[1][0];
    } else {
$cid  = $widget->cid;
  $db = Typecho_Db::get();
    $rs = $db->fetchAll($db->select('table.contents.text')
            ->from('table.contents')
            ->where('table.contents.parent=?', $cid)
            ->order('table.contents.cid', Typecho_Db::SORT_ASC));

    foreach($rs as $attach) {
        $attach = unserialize($attach['text']);
        if($attach['mime'] == 'image/jpeg') {
            $img = $attach['path'];
        }
    }
    }
  if($img==$random){
  echo $img;
  }else{
  echo $img.Helper::options()->stxt;}
}
function parsePaopaoBiaoqingCallback($match)
    {
        return '<img class="biaoqing" src="'.theurl.'/assets/owo/paopao/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }
function parseAruBiaoqingCallback($match)
    {
        return '<img class="biaoqing" src="'.theurl.'/assets/owo/aru/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }
function parseBiaoQing($content)
    {
        $content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
'parsePaopaoBiaoqingCallback', $content);
        $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
'parseAruBiaoqingCallback', $content);
        return $content;
    }
function get_post_view($archive,$r=0)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
       if($r==0){ echo 1;}
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
if($r==0){
    echo $row['views'];
}
}

function getRandomPosts($random=5){
    $db = Typecho_Db::get();
    $adapterName = $db->getAdapterName();//兼容非MySQL数据库
    if($adapterName == 'pgsql' || $adapterName == 'Pdo_Pgsql' || $adapterName == 'Pdo_SQLite' || $adapterName == 'SQLite'){
        $order_by = 'RANDOM()';
    }else{
        $order_by = 'RAND()';
    }
    $sql = $db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('table.contents.created <= ?', time())
        ->where('type = ?', 'post')
        ->limit($random)
        ->order($order_by);

$result = $db->fetchAll($sql);
if($result){
    foreach($result as $val){
        $obj = Typecho_Widget::widget('Widget_Abstract_Contents');
        $val = $obj->push($val);
        $post_title = htmlspecialchars($val['title']);
        $permalink = $val['permalink'];
        echo '<a href="'.$permalink.'" title="'.$post_title.'"><h5 class="card-title">'.$post_title.'</h5></a>';
    }
}
}

function get_comment_at($coid)
{
    $db   = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')
                                 ->where('coid = ?', $coid));
    $parent = $prow['parent'];
    if ($parent != "0") {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')
                                     ->where('coid = ? AND status = ?', $parent, 'approved'));
if($arow['author']){ $author = $arow['author'];
        $href   = '<a href="#comment-' . $parent . '">@' . $author . '</a>';
        echo $href;
}else { echo '';}
    } else {
        echo '';
    }
}

/** 获取操作系统信息 */
function getOs($agent)
{
    $os = false;
 
    if (preg_match('/win/i', $agent)) {
        if (preg_match('/nt 6.0/i', $agent)) {
            $os = '<i class="mdi mdi-windows-classic"></i> WindowsVista';
        } else if (preg_match('/nt 6.1/i', $agent)) {
            $os = '<i class="mdi mdi-windows"></i> Windows7';
        } else if (preg_match('/nt 6.2/i', $agent)) {
            $os = '<i class="mdi mdi-windows"></i> Windows8';
        } else if(preg_match('/nt 6.3/i', $agent)) {
            $os = '<i class="mdi mdi-windows"></i> Windows8.1';
        } else if(preg_match('/nt 5.1/i', $agent)) {
            $os = '<i class="mdi mdi-windows-classic"></i> WindowsXP';
        } else if (preg_match('/nt 10.0/i', $agent)) {
            $os = '<i class="mdi mdi-windows"></i> Windows10';
        } else{
            $os = '<i class="mdi mdi-windows"></i> Windows';
        }
    } else if (preg_match('/android/i', $agent)) {
if (preg_match('/android 10/i', $agent)) {
        $os = '<i class="mdi mdi-android"></i> 安卓 10';
    }
if (preg_match('/android 9/i', $agent)) {
        $os = '<i class="mdi mdi-android"></i> 安卓派';
    }
else if (preg_match('/android 8/i', $agent)) {
        $os = '<i class="mdi mdi-android"></i> 安卓奥利奥';
    }
else if (preg_match('/android 7/i', $agent)) {
        $os = '<i class="mdi mdi-android"></i> 安卓牛轧糖';
    }
else if (preg_match('/android 6/i', $agent)) {
        $os = '<i class="mdi mdi-android"></i> 安卓棉花糖';
    }
else if (preg_match('/android 5/i', $agent)) {
        $os = '<i class="mdi mdi-android"></i> 安卓棒棒糖';
    }
else{
        $os = '<i class="mdi mdi-android"></i> 安卓';
}
    }
 else if (preg_match('/ubuntu/i', $agent)) {
        $os = '<i class="mdi mdi-ubuntu"></i> 乌班图';
    } else if (preg_match('/linux/i', $agent)) {
        $os = '<i class="mdi mdi-linux"></i> Linux';
    } else if (preg_match('/iPhone/i', $agent)) {
        $os = '<i class="mdi mdi-cellphone-iphone"></i> Ios';
    } else if (preg_match('/iPad/i', $agent)) {
        $os = '<i class="mdi mdi-tablet-ipad"></i> IpadOS';
    } else if (preg_match('/mac/i', $agent)) {
        $os = '<i class="mdi mdi-desktop-mac"></i> MacOS';
    }else if (preg_match('/cros/i', $agent)) {
        $os = '<i class="mdi mdi-google-chrome"></i> ChromeOS';
    }else if (preg_match('/BlackBerry/i', $agent)) {
        $os = '<i class="mdi mdi-blackberry"></i> 黑莓';
    }else {
 return false;
    }
   return $os;
}
function is_ajax()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        if ('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            return true;
        }
    }
    return false;
}
class Widget_Post_leixing extends Widget_Abstract_Contents
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault(array('pageSize' => $this->options->commentsListSize, 'parentId' => 0, 'ignoreAuthor' => false));
    }
    public function execute()
    {
        $select  = $this->select()->from('table.contents')
->join('table.fields e','e.cid = table.contents.cid and e.name = "zhuangtai"')
->where("table.contents.password IS NULL OR table.contents.password = ''")
->where('table.contents.type = ?', 'post')
->limit($this->parameter->pageSize)
->order('table.contents.modified', Typecho_Db::SORT_DESC);
if ($this->parameter->leixing) {
            $select->where('e.str_value = ?', $this->parameter->leixing);
}
 $this->db->fetchAll($select, array($this, 'push'));
    }
}

class Widget_Post_fanjubiao extends Widget_Abstract_Contents
{
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault(array('pageSize' => '999', 'parentId' => 0, 'ignoreAuthor' => false));
    }
    public function execute()
    {
        $select  = $this->select()->from('table.contents')
->where("table.contents.password IS NULL OR table.contents.password = ''")
->where('table.contents.type = ?', 'post')
->limit($this->parameter->pageSize)
->order('table.contents.modified', Typecho_Db::SORT_DESC);

if ($this->parameter->fanjubiao) {
$fanju=explode(",",$this->parameter->fanjubiao);
$select->where('table.contents.cid in ?', $fanju);
}
 $this->db->fetchAll($select, array($this, 'push'));
    }
}



function coryright()
{
$a="";$b="";
if (Helper::options()->footerwen){$a = Helper::options()->footerwen;}if (Helper::options()->footerwen2){$b = Helper::options()->footerwen2;}
echo date('Y').' © <a target="_blank" href="http://typecho.org/" rel="external nofollow">Typecho</a> Theme <a target="_blank" href="https://qqdie.com/" rel="external nofollow">Violet</a> '.$a.'</div><div class="col-md-6"><div class="text-md-right footer-links d-none d-md-block">'.$b;
}



function gengxin($txt)
{
$string_arr = explode("\r\n", $txt);
$txt=end($string_arr);
echo explode("$",$txt)[0];
}

Typecho_Plugin::factory('Widget_Feedback')->comment = array('plgl', 'one');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('plgl','two');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('plgl','two');
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('plgl', 'san');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('plgl', 'san');
class plgl {
public static function one($comment, $post)
    {
$options = Helper::options();
$opt = "none";
$errorx ="";

if (!empty($options->tools) && in_array('qzlogin', $options->tools)){
$user = Typecho_Widget::widget('Widget_User');
/*通过判断id来判断用户是否登录*/
if(!$user->uid > 0){ 
	$errorx = "抱歉，您必须登录后才能评论！";
	$opt = 'abandon';
}}
  
  
if(preg_match("/<a(.*?)href=\"javascript:(.*?)>(.*?)<\/a>/u",$comment['text'])==1){
	$errorx = "评论中超链接里请不要使用脚本！";
	$opt = 'abandon';
}
  
if ($opt == "none" && $options->opt_nocn != "none") {
if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
	$errorx = "评论内容请不少于一个中文汉字";
	$opt = $options->opt_nocn;
}
}

//屏蔽网址处理
        if(!empty($options->words_url)){
            if ($opt == "none" && $options->opt_url != "none") {
                if (check_in($options->words_url, $comment['url'])) {
                    $errorx = "评论发布者的网址被管理员屏蔽";
                    $opt = $options->opt_url;
                }			
            }
        } 

//检查敏感词汇
if(!empty($options->words_chk)){
	if ($opt == "none" && $options->opt_chk != "none") {
		if (check_in($options->words_chk, $comment['text'])) {
			$errorx = "评论内容中包含敏感词汇";
			$opt = $options->opt_chk;
		}
	}
}

//屏蔽邮箱处理
if(!empty($options->words_mail)){
	if ($opt == "none" && $options->opt_mail != "none") {
		if (check_in($options->words_mail, $comment['mail'])) {
			$errorx = "评论发布者的邮箱地址被管理员屏蔽";
			$opt = $options->opt_mail;
		}			
	} 
}
//屏蔽昵称关键词处理
if(!empty($options->words_au)){
	if ($opt == "none" && $options->opt_au != "none") {
		if (check_in($options->words_au, $comment['author'])) {
			$errorx = "对不起，昵称的部分字符已经被管理员屏蔽，请更换";
			$opt = $options->opt_au;
		}			
	}
}

if ($opt == "abandon") {
Typecho_Cookie::set('__typecho_remember_text', $comment['text']);
throw new Typecho_Widget_Exception($errorx);
		}
else if ($opt == "spam") {
$comment['status'] = 'spam';
		}
else if ($opt == "waiting") {
$comment['status'] = 'waiting';
		}
Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
}
public static function two($con,$obj,$text)
    {
      $text = empty($text)?$con:$text;
$db = Typecho_Db::get();
$user = Typecho_Widget::widget('Widget_User');
/*通过判断id来判断用户是否登录*/
if($user->uid > 0){
$sql = $db->select()->from('table.comments')
    ->where('cid = ?',$obj->cid)
    ->where('authorId = ?', $user->uid)
    ->where('status = ?', 'approved')
    ->limit(1);
}else{
$sql = $db->select()->from('table.comments')
    ->where('cid = ?',$obj->cid)
    ->where('mail = ?', $obj->remember('mail',true))
    ->where('status = ?', 'approved')
    ->limit(1);
}
$result = $db->fetchAll($sql);
if(!$obj->is('single'))
{
if($result || $user->uid==$obj->authorId){
$text= preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view-ok"><fieldset><legend>回复可见内容</legend>$1</fieldset></div>',$text);
}else{
$text = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'回复可见内容',$text);
}}
return $text;
}
   public static function san()
    {
    ?>
<style>.wmd-button-row{height:auto;}.OwO{position:relative;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}.OwO.OwO-open .OwO-body{display:block}.OwO.OwO-up .OwO-body{top:inherit;bottom:21px;border-radius:4px 4px 4px 0}.OwO.OwO-up .OwO-body .OwO-bar .OwO-packages li:nth-child(1){border-radius:0}.OwO.OwO-up.OwO-open .OwO-logo{border:1px solid #ddd;border-radius:0 0 4px 4px;border-top:none}.OwO .OwO-logo{position:relative;display:inline-block;cursor:pointer;box-sizing:border-box;z-index:2;}.OwO .OwO-logo:hover span{display:inline-block;-webkit-animation:a 5s infinite ease-in-out;animation:a 5s infinite ease-in-out}.OwO .OwO-body{display:none;position:relative;background:#fff;}.OwO .OwO-body .OwO-items{-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;display:none;padding:10px;margin:0;overflow-y:scroll;font-size:0}.OwO .OwO-body .OwO-items .OwO-item{list-style-type:none;background:#f7f7f7;padding:5px 10px;border-radius:5px;display:inline-block;font-size:12px;line-height:14px;margin:0 10px 12px 0;cursor:pointer;-webkit-transition:.3s;transition:.3s}.OwO .OwO-body .OwO-items .OwO-item:hover{background:#eee;box-shadow:0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);-webkit-animation:a 5s infinite ease-in-out;animation:a 5s infinite ease-in-out}.OwO .OwO-body .OwO-items-emoji .OwO-item{font-size:20px;line-height:19px}.OwO .OwO-body .OwO-items-image .OwO-item{max-width:calc(25% - 10px);box-sizing:border-box}.OwO .OwO-body .OwO-items-image .OwO-item img{max-width:100%}.OwO .OwO-body .OwO-items-show{display:block}.OwO .OwO-body .OwO-bar{width:100%;height:30px;border-top:1px solid #ddd;background:#fff;border-radius:0 0 4px 4px;color:#444}.OwO .OwO-body .OwO-bar .OwO-packages{margin:0;padding:0;font-size:0}.OwO .OwO-body .OwO-bar .OwO-packages li{list-style-type:none;display:inline-block;line-height:30px;font-size:14px;padding:0 10px;cursor:pointer;margin:0}.OwO .OwO-body .OwO-bar .OwO-packages li:nth-child(1){border-radius:0 0 0 3px}.OwO .OwO-body .OwO-bar .OwO-packages li:hover{background:#eee}.OwO .OwO-body .OwO-bar .OwO-packages .OwO-package-active{background:#eee;-webkit-transition:.3s;transition:.3s}.OwO-jio{display:none;}img.biaoqing{max-height:30px;}.OwO span{background:none!important;width:unset!important;height:unset!important}.OwO .OwO-body .OwO-items{-webkit-overflow-scrolling:touch;overflow-x:hidden;}.OwO .OwO-body .OwO-items-image .OwO-item{max-width:-moz-calc(20% - 10px);max-width:-webkit-calc(20% - 10px);max-width:calc(20% - 10px)}@media screen and (max-width:767px){.comment-info-input{flex-direction:column;}.comment-info-input input{max-width:100%;margin-top:5px}#comments .comment-author .avatar{width:2.5rem;height:2.5rem;}}@media screen and (max-width:760px){.OwO .OwO-body .OwO-items-image .OwO-item{max-width:-moz-calc(25% - 10px);max-width:-webkit-calc(25% - 10px);max-width:calc(25% - 10px)}}
</style>
<script src="<?php echo theurl; ?>assets/OwO.min.js?201908161808"></script>
<script> 
          $(document).ready(function(){
          	$('#wmd-button-row').append('<li class="wmd-button" id="wmd-jrotty-button" title="回复可见"><span style="background: none;font-size: 16px;border: 1px solid #dedede;padding: 2px;color: #467B96;width: auto;height: auto;">回复可见</span></li><li class="wmd-button"><a href="javascript: void(0);"class="OwO-logo" rel="external nofollow">表情</a></li><div class="OwO"></div>');
				if($('#wmd-button-row').length !== 0){
					$('#wmd-jrotty-button').click(function(){
						var rs = "[hide]回复可见内容[/hide]";
						var myField = $('#text')[0];
                insertAtCursor(myField,rs);
					})
				}
/*评论表情配置*/
if($(".OwO").length > 0) {
var OwO_demo = new OwO({
            container: document.getElementsByClassName('OwO')[0],
            target: document.getElementById('text'),
            api: '<?php echo theurl; ?>assets/OwO.json',
            position: 'down',
            width: '100%',
            maxHeight: '150px'
});
}
        function insertAtCursor(myField, myValue) {
            //IE 浏览器  
            if (document.selection) {  
                myField.focus();  
                sel = document.selection.createRange();
                sel.text = myValue;  
                sel.select();  
            }
             //FireFox、Chrome等  
            else if (myField.selectionStart || myField.selectionStart == '0') {  
                var startPos = myField.selectionStart;  
                var endPos = myField.selectionEnd; 
                // 保存滚动条  
              var restoreTop = myField.scrollTop;  
                myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);  
                if (restoreTop > 0) {myField.scrollTop = restoreTop;}  
                myField.focus();  
                myField.selectionStart = startPos + myValue.length;  
                myField.selectionEnd = startPos + myValue.length;
            } else {  
                myField.value += myValue;
                myField.focus();
            }  
        }
			});
</script>
<script> 
function fz(s){

console.info(s);
var spurl= s.vod_url.split('$$$');
if(spurl[0].indexOf(".m3u8") != -1){
spurl[1]=spurl[0];
}

var A=$('#title').val();
if(A.length>0){
$('textarea[name="fields[mp4]"]').val($('textarea[name="fields[mp4]"]').val()+'\r\n'+spurl[1]);
}else{
$('#title').val(s.vod_name);
$('input[name="fields[niandai]"]').val(s.vod_year);
$('input[name="fields[thumb]"]').val(s.vod_pic);
$('textarea[name="fields[mp4]"]').val(spurl[1]);
$('input[name="fields[autoup]"]').val('okzyw$'+s.vod_id);

var str=s.vod_continu
if(str.indexOf("完结") != -1||str.indexOf("集全") != -1){
$('select[name="fields[zhuangtai]"]').val("0");
}else{
$('select[name="fields[zhuangtai]"]').val("1");
}

var tt=s.vod_content.replace(/\s/ig,'').replace(/<[^>]+>/g,'');
$('#text').val(tt);
}
}



$("input[name='fields[okdizhi]']").blur(function() {
      var _ok = $(this).val();
  if (_ok != '') {
var k="<?php Helper::options()->rootUrl(); ?>/?wd="+$(this).val();
$.get(k,function(result){
var json=jQuery.parseJSON(result);
var data=json.data;
var length=json.page.recordcount;
console.info(length);
var s="";
if(length==1){
s=data[0];
fz(s);
}else{
var e="";
for(var i=0;i<length;i++){
s=data[i];
e=e+'<br><a onclick=\'fz('+JSON.stringify(s).replace(/<[^>]+>/g,'')+');\'>'+s.vod_name+'</a>'
}
$('.tagshelper').append(e);

}

                        });
  }
  return false;
});
</script> 
<?php
    }



}

?>