<section>
    <h3>Comments</h3>
    <ul>
    <?php foreach($comments as $comment): ?>
        <li>
            <?php $this->view('comment/single-list-item', $comment); ?>
        </li>
    <?php endforeach; ?>
    </ul>
    
    <form action="<?php echo url('comment', true); ?>" method="post" >
        <textarea name="comment"></textarea>
        <input type="submit" />
    </form>
</section>