<a href="<?php echo url("$cat_slug/$slug"); ?>"><?php echo $title; ?></a>
<?php if ($fullday == 0): ?>
    <?php echo format_date('G:i', $start); ?> - <?php echo format_date('G:i', $end); ?>
<?php endif; ?>
<?php if ($attendance): ?>
    <input data-attendance="<?php echo url("$cat_slug/$slug"); ?>" type="radio" name="event-attend-<?php echo $i; ?>" id="event-subscribe-<?php echo $i; ?>" value="1">
    <label for="event-subscribe-<?php echo $i; ?>">Subscribe</label>
    <input data-attendance="<?php echo url("$cat_slug/$slug"); ?>" type="radio" name="event-attend-<?php echo $i; ?>" id="event-unsubscribe-<?php echo $i; ?>" value="0">
    <label for="event-unsubscribe-<?php echo $i; ?>">Unsubscribe</label>
<?php endif; ?>