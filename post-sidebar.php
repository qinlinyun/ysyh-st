<div class="col-md-4">
<div class="card">
<div class="card-body">
<h5 class="card-title mb-3">小编</h5>
<div class="media">
                                                    <span class="float-left mr-2"><img src="<?php tx($this->author->mail); ?>" style="height: 50px;" alt="" class="img-thumbnail"></span>
                                                    <div class="media-body">

                                                        <h6 class="mt-1 mb-1"><?php $this->author->screenName(); ?></h6>
                                                        <p class="font-13 mb-0"><a href="<?php echo authorurl; ?><?php $this->author->uid(); ?>">更多Ta的文章</a></p>

                                                        
                                                    </div> <!-- end media-body-->
                                                </div>

</div></div>


<?php if ($this->fields->mp4): ?>
<?php $this->related(6)->to($relatedPosts); ?><?php if ($relatedPosts->have()): ?>
<div class="card"><div class="card-body">
<h5 class="card-title mb-3">推荐视频</h5>  <div class="row">
  <?php while ($relatedPosts->next()): ?>

  <div class="col-12 col-md-12 col-lg-12 col-xl-6">

<div class="media mb-2">
<a href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>">
                                                                    <img class="mr-3 y10r5 tuijian b-lazy" src="<?php echo theurl; ?>img/load.gif" data-url="<?php if($relatedPosts->fields->thumb){$relatedPosts->fields->thumb();} ?>" alt="image"></a>
                                                                    <div class="media-body">
                                                                       <a href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>"> <h4 class="mb-1 mt-1"><?php $relatedPosts->title(); ?></h4></a>
                                                                        <p class="mb-0">年代：<?php if($relatedPosts->fields->niandai){$relatedPosts->fields->niandai();} ?></p>
                                                                    </div> <!-- end media-body -->
</div> <!-- end media -->
                                                           


</div>
<?php endwhile; ?></div>
 </div>

</div>

<?php endif; ?>
<?php else: ?>

<div class="card">
<div class="card-body">
<?php $this->related(5)->to($relatedPosts); ?><?php if ($relatedPosts->have()): ?>
<h5 class="card-title mb-3">相关推荐</h5>
<div class="card mb-1 shadow-none">

    <?php while ($relatedPosts->next()): ?>
    <a href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>"><h5 class="card-title"><?php $relatedPosts->title(); ?></h5></a>
    <?php endwhile; ?>

</div>
<?php else: ?>
<h5 class="card-title mb-3">随机推荐</h5>
<div class="card mb-1 shadow-none">
<?php getRandomPosts(8);?>
</div>
<?php endif; ?>

</div>
</div>



<?php endif; ?>









<?php if($this->options->ads): ?>
<div class="card">
<div class="card-body">
<?php $this->options->ads(); ?>
</div>
</div>
<?php endif; ?>


<?php if (!empty($this->options->tools) && in_array('pixiv', $this->options->tools)): ?>
<div class="card">
<div class="card-body"><h5 class="card-title mb-3">Pixiv每日榜Top50</h5>
<iframe src="https://cloud.mokeyjay.com/pixiv" frameborder="0" style="width:100%; height:380px;"></iframe>
</div>
</div>
<?php endif; ?>


</div>