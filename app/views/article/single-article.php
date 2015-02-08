<article itemscope itemtype="http://schema.org/Article">
    <header>
        <img src="<?php echo image($media, 640, 480); ?>" alt="<?php echo $media_description; ?>"/>
        <h1 itemprop="name"><?php echo $title; ?></h1>
    </header>
    
    <div itemprop="articleBody">
        <?php echo $content; ?>
    </div>
    
    <?php if($comment && $this->user->can('article.comment')): ?>
        <?php $this->view('comment/list-comments', ['comments' => $comments]); ?>
    <?php endif;?>
</article>