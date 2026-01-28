<?php 
/**
 * 时间轴
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 $this->need('sidebar.php');
class Widget_Contents_Post_Recent extends Widget_Abstract_Contents
{
    /**
     * 执行函数
     *
     * @access public
     * @return void
     */
    public function execute()
    {
        $this->parameter->setDefault(array('pageSize' => $this->options->postsListSize));
$this->db->fetchAll($this->select()->join('table.fields','table.fields.cid = table.contents.cid','right')
->where('table.fields.name = ?', 'niandai')
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.created < ?', $this->options->time)
        ->where('table.contents.type = ?', 'post')
        ->order('table.fields.str_value', Typecho_Db::SORT_DESC)->group('cid')
        ->limit($this->parameter->pageSize), array($this, 'push'));
    }
}
?> 

<div class="container-fluid">

 <h3 class=""><?php $this->title() ?></h3>
          <div class="row">

    
<?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
    $year=0;  $i=0; $j=0;  
 $ml = $archives->options->rootUrl;
   $output = ''; 
    while($archives->next()):   

        $year_tmp = $archives->fields->niandai;   
  
        if ($year != $year_tmp && $year > 0) $output .= '</div>
              </div>
            </div>';   
        if ($year != $year_tmp) {   
            $year = $year_tmp;   
            $output .= ' <div class="col-12">
              <div class="card">
                <div class="card-header">'. $year .'年</div>
                <div class="card-body">
                      '; //输出年份 
}  



        $output .= '<a class="card-link" href="'.$archives->permalink .'">'. $archives->title .'</a>'; //输出文章日期和标题  

    endwhile;   
    $output .= '';   
    echo $output;  
?>  




</div>
</div>
</div>


<?php if(!is_ajax()): ?>
<?php $this->need('footer.php'); ?>
<?php endif;?>