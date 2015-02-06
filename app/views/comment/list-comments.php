<section>
    <h3>Comments</h3>
    <ul>
    <?php foreach($comments as $comment): ?>
        <li>
            <article itemscope itemtype="http://schema.org/Comment">
                <header itemprop="author" itemscope itemtype="http://schema.org/Person">
                    <img itemprop="image" src="<?php echo image($comment['image'], 50, 50); ?>" alt="profielafbeelding voor <?php echo $comment['name']; ?>" />
                    <h4 itemprop="name"><?php echo $comment['name']; ?></h4>
                </header>
                <div itemprop="commentText"><?php echo $comment['comment']; ?></div>
                <time datetime="<?php echo $comment['created']; ?>" itemprop="dateCreated" ><?php echo format_date('x', from_sql_date($comment['created']) ); ?></time>
            </article>
        </li>
    <?php endforeach; ?>
    </ul>
</section>

<form action="<?php echo url('comment', true); ?>" method="post" >
    <textarea name="comment"></textarea>
    <input type="submit" />
</form>