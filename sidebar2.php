<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">
        
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="<?php $this->options->rootUrl(); ?>/">
                            <i class="mdi mdi-speedometer mr-1"></i>首页
                        </a>
                        
                    </li> 

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-apps mr-1"></i>分类<div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">





<?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
<?php while($categorys->next()): ?>
<?php if ($categorys->levels === 0): ?>
<?php $children = $categorys->getAllChildren($categorys->mid); ?>
<?php if (empty($children)) { ?>
                          <a href="<?php $categorys->permalink(); ?>" class="dropdown-item <?php if($this->is('category', $categorys->slug)): ?>active<?php endif; ?>"><?php $categorys->name(); ?></a>

<?php } else { ?>
  
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-project" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php $categorys->name(); ?> <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-project">
<?php foreach ($children as $mid) { ?>
<?php $child = $categorys->getCategory($mid); ?>
                                    <a href="<?php echo $child['permalink'] ?>" class="dropdown-item <?php if($this->is('category', $mid)): ?>active<?php endif; ?>"><?php echo $child['name']; ?></a>
<?php } ?>
                                </div>
                            </div>
<?php } ?><?php endif; ?><?php endwhile; ?>



                            
                        </div>
                    </li>

<li class="nav-item dropdown"><a class="nav-link" href="<?php $this->options->rootUrl(); ?><?php if($this->options->rewrite==0){echo "/index.php";} ?>/search/sy/?gaojijiansuo=1"><i class="icon  mdi mdi-table-search mr-1"></i><span>番剧索引</span></a> </li>   

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-google-pages mr-1"></i>页面<div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
 <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                            <a href="<?php $pages->permalink(); ?>" class="dropdown-item <?php if($this->is('page', $pages->slug)): ?>active<?php endif; ?>"><?php $pages->title(); ?></a>
 <?php endwhile; ?>
                        </div>
                    </li>      
   
                </ul>
            </div>
        </nav>
    </div>
</div>