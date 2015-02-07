<a href="<?php echo url($slug, true); ?>"><?php echo $title; ?></a>
<?php if ($fullday == 0): ?>
    <?php echo format_date('G:i', $start); ?> - <?php echo format_date('G:i', $end); ?>
<?php endif; ?>
<?php if ($attendance): ?>
    <input type="radio" name="event-attend-<?php echo $i; ?>" id="event-subscribe-<?php echo $i; ?>"><label for="event-subscribe-<?php echo $i; ?>">Subscribe</label>
    <input type="radio" name="event-attend-<?php echo $i; ?>" id="event-unsubscribe-<?php echo $i; ?>"><label for="event-unsubscribe-<?php echo $i; ?>">Unsubscribe</label>
<?php endif; ?>