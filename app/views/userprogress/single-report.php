<div class="report">

    <div class="day"><?php echo $report['created']->format('j F Y'); ?></div>

    <?php foreach($report['report'] as $key => $item): ?>

    <div data-field="<?php echo $key; ?>">
        <div class="property"><?php echo $item['caption']; ?></div>
        <div class="value"><?php echo $item['value']; ?></div>
    </div>

    <?php endforeach; ?>

</div>