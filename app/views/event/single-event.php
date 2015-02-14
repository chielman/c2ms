<article itemscope itemref="http://schema.org/Event">
    <header>
        <h1 itemprop="name"><?php echo $title; ?></h1>
        <p>
            <time itemprop="startDate" datetime="<?php echo $start; ?>"><?php echo $start; ?></time>
            till 
            <time itemprop="endDate" datetime="<?php echo $end; ?>"><?php echo $end; ?></time>
        </p>
    </header>
    
    <div itemprop="description">
        <?php echo $description; ?>
    </div>
    
    <?php if($attendance && $this->user->can('event.attend')): ?>
        <section itemprop="attendees">
            <h3>Attendance</h3>
            <ul>
            <?php foreach($attendances as $attendance): ?>
                <li><?php echo $attendance['name'];?></li>
            <?php endforeach; ?>
            </ul>

            <label for="subscribe">Subscribe</label>
            <input data-attendance="<?php echo url("$cat_slug/$slug"); ?>" type="radio" id="subscribe" name="attend" value="1"/>

            <label for="unsubscibe">Unsubscribe</label>
            <input data-attendance="<?php echo url("$cat_slug/$slug"); ?>" type="radio" id="unsubscribe" name="attend" value="0"/>

        </section>
    <?php endif;?>
    
    <?php if($comment && $this->user->can('event.comment')): ?>
        <?php $this->view('comment/list-comments', ['comments' => $comments]); ?>
    <?php endif;?>
</article>