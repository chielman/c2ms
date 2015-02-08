<article itemscope itemtype="http://schema.org/Comment">
    <header itemprop="author" itemscope itemtype="http://schema.org/Person">
        <img itemprop="image" src="<?php echo image($image, 50, 50); ?>" alt="profielafbeelding voor <?php echo $name; ?>" />
        <h4 itemprop="name"><?php echo $name; ?></h4>
    </header>
    <div itemprop="commentText"><?php echo $comment; ?></div>
    <time datetime="<?php echo $created; ?>" itemprop="dateCreated" ><?php echo format_date('x', from_sql_date($created) ); ?></time>
</article>