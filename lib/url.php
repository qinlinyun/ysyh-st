<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
define("THEME_URL",str_replace('//usr','/usr',str_replace(Helper::options()->siteUrl,Helper::options()->rootUrl.'/',Helper::options()->themeUrl)));
if(!empty(Helper::options()->CDNURL)){$theurl = Helper::options()->CDNURL.'/YoDuCDN/';}else{$theurl = THEME_URL.'/';}define("theurl",$theurl);
if(Helper::options()->rewrite==0){$authorurl=Helper::options()->rootUrl.'/index.php/author/';}else{$authorurl=Helper::options()->rootUrl.'/author/';}define("authorurl",$authorurl);
define('pUlHLXBOxIwmhMsNrtKcFAjzSTbfPqvoDCVQaGdeyikJnRugYEWZ',__FILE__);
?>