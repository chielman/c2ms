<h1><?php echo $title; ?></h1>

<ul>
<?php foreach($items as $i => $item): $item['i'] = $i; ?>
    <li>
        <?php $this->view("{$item['_type']}/single-list-item", $item); ?>
    </li>
<?php endforeach; ?>
</ul>