<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $options) {
    $commentClass = '';$sf="<i class=\"mdi mdi-account-clock\"></i> 游客";
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {$sf="<i class=\"mdi mdi-account-check\"></i> 作者";
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
$sf="<i class=\"mdi mdi-account-box\"></i> 用户";
        }
    } 
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>
<div id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent hang';
}
$comments->alt(' comment-odd', ' comment-even');
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '" target="_blank" rel="external nofollow">' . $comments->author . '</a>';
    } else {
                $author = '<span>' . $comments->author . '</span>';
    }
?>">
<div class="media mt-2">
<img class="mr-3 avatar-sm rounded-circle b-lazy" src="<?php echo theurl; ?>img/load.gif" data-url="<?php tx($comments->mail,0,$comments->coid); ?>">
<div class="media-body"><div id="<?php $comments->theId(); ?>">
<h5 class="mt-0"><?php echo $author; ?><?php if ('waiting' == $comments->status) { ?><span class="text-muted">您的评论需管理员审核后才能显示！</span><?php } ?> 
</h5>
<?php 
$cos=parseBiaoQing($comments->content);
$cos = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
        '<a$1 href="$2$3"$5 target="_blank" rel="nofollow">', $cos);
echo get_comment_at($comments->coid).$cos;
 ?>
<p class="text-muted mb-0"><span class="mr-1"><?php echo $sf; ?></span><span class="mr-1"><?php echo getOs($comments->agent); ?></span><span class="mr-1"><i class="mdi mdi-timer"></i> <?php echo timesince($comments->created);?></span><span class="comment-reply cp-<?php $comments->theId(); ?>"><?php $comments->reply('<i class="mdi mdi-reply"></i>回复'); ?></span><span id="cancel-comment-reply" class="cancel-comment-reply cl-<?php $comments->theId(); ?>" style="display:none" ><?php $comments->cancelReply('<i class="mdi mdi-reply"></i>取消'); ?></span></p>
</div>
</div></div>
<?php if ($comments->children) { ?>
<div class="comment-children">
    <?php $comments->threadedComments($options); ?>
</div>
<?php } ?>
</div>
<?php } ?>



<div class="card">
<div class="card-body" id="comments">
<?php if($this->allow('comment')): ?> 
 <div id="<?php $this->respondId(); ?>" class="respond"  data-no-instant>


<?php if (!empty($this->options->tools) && in_array('qzlogin', $this->options->tools) && !$this->user->hasLogin()): ?>

<div class="sign-comment"><div class="lm"><a href="<?php $this->options->rootUrl(); ?>/?login" class="btn btn-primary btn-sm">登录</a><?php if($this->options->allowRegister): ?>&nbsp;&nbsp;<a href="<?php $this->options->registerUrl(); ?>" class="btn btn-info btn-sm">注册</a><?php endif; ?></div></div>

<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="blur-2" role="form">

<?php else: ?>
<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
<?php endif; ?>
<?php if($this->user->hasLogin()): ?>
<!-- 显示当前登录用户的用户名以及登出连接 --><div class="mt-0 mb-1 row">
<div class="col-6">
<button type="button" class="btn btn-sm btn-link pl-0"><?php $this->user->screenName(); ?></button>
</div>
<div class="col-6"><div class="text-right">
<div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-settings"></i>设置</button>
                                                    <div class="dropdown-menu">
<a class="dropdown-item" href="<?php $this->options->rootUrl(); ?>/?setting" target="_blank">修改资料</a> 
<a class="dropdown-item" href="<?php $this->options->logoutUrl(); ?>" title="Logout">退出登陆</a>
                                                    </div>
                                                </div>




</div></div>
</div>
<!-- 若当前用户未登录 -->
            <?php else: ?><div class="row">
 <div class="col-sm-4"> <div class="form-group mbm mtm"> <input type="text" name="author" maxlength="12" id="author" class="form-control" placeholder="称呼 *" value="<?php $this->remember('author'); ?>" required> </div> </div> <div class="col-sm-4"> <div class="form-group mbm mtm"> <input type="email" name="mail" id="mail" class="form-control" placeholder="电子邮箱 *" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> /> </div> </div> <div class="col-sm-4"> <div class="form-group mbm mtm"> <input type="url" name="url" id="url" class="form-control" placeholder="网址(http://)" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />  </div> </div> </div> 
<?php endif; ?>
<textarea class="form-control form-control-light mb-2 OwO-textarea" name="text" placeholder="写点什么" id="example-textarea" rows="3" required><?php $this->remember('text'); ?></textarea>

<div class="row mb-2"><div class="col-12">
<a href="javascript: void(0);"class="btn btn-sm btn-primary OwO-logo" rel="external nofollow">OwO</a>
<div class="float-right">
<button type="submit" class="btn btn-primary btn-sm submit" id="misubmit">提交</button>
</div>

</div>


</div>
<div class="OwO"></div>
</form></div>
<?php else: ?>
<h3><?php _e('评论已关闭'); ?></h3>
<?php endif; ?>






<h4 class="header-title mt-3 mb-2" style="border-bottom: 1px solid #eaeaea;padding-bottom: 5px;">共<code><?php $this->commentsNum(); ?></code>条评论</h4>

<?php $this->comments()->to($comments); ?>
<?php if ($comments->have()): ?>
<?php $comments->listComments(); ?>
<div class="text-center mt-2">
<?php $comments->pageNav('<', '<span class="text-danger">点击加载更多</span>'); ?>
</div>

<?php endif; ?>








</div> 
</div>

<script type="text/javascript">
(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},pom:function(id){return document.getElementsByClassName(id)[0]},iom:function(id,dis){var alist=document.getElementsByClassName(id);if(alist){for(var idx=0;idx<alist.length;idx++){var mya=alist[idx];mya.style.display=dis}}},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom("<?php echo $this->respondId(); ?>"),input=this.dom("comment-parent"),form="form"==response.tagName?response:response.getElementsByTagName("form")[0],textarea=response.getElementsByTagName("textarea")[0];if(null==input){input=this.create("input",{"type":"hidden","name":"parent","id":"comment-parent"});form.appendChild(input)}input.setAttribute("value",coid);if(null==this.dom("comment-form-place-holder")){var holder=this.create("div",{"id":"comment-form-place-holder"});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.iom("comment-reply","");this.pom("cp-"+cid).style.display="none";this.iom("cancel-comment-reply","none");this.pom("cl-"+cid).style.display="";if(null!=textarea&&"text"==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom("<?php echo $this->respondId(); ?>"),holder=this.dom("comment-form-place-holder"),input=this.dom("comment-parent");if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.iom("comment-reply","");this.iom("cancel-comment-reply","none");holder.parentNode.insertBefore(response,holder);return false}}})();
</script>