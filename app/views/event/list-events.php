<h1>Kalender</h1>

<ul>
<?php foreach($events as $i => $event): ?>
    <li>
        <a href="<?php echo url($event['slug'], true); ?>"><?php echo $event['title']; ?></a>
        <?php if ($event['fullday'] == 0): ?>
            <?php echo format_date('G:i', $event['start']); ?> - <?php echo format_date('G:i', $event['end']); ?>
        <?php endif; ?>
        <?php if ($event['attendance']): ?>
            <input type="radio" name="event-attend-<?php echo $i; ?>" id="event-subscribe-<?php echo $i; ?>"><label for="event-subscribe-<?php echo $i; ?>">Subscribe</label>
            <input type="radio" name="event-attend-<?php echo $i; ?>" id="event-unsubscribe-<?php echo $i; ?>"><label for="event-unsubscribe-<?php echo $i; ?>">Unsubscribe</label>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>