<?php foreach($users as $user): ?>
    <div class="report">
        <div class="day"><?php echo $user['created']->format('j F Y'); ?></div>

        <div class="user">
            <a href="<?php echo url("users/{$user['name']}/report"); ?>">
                <img src="<?php echo image($user['image'], 50, 50); ?>" alt="profielafbeelding voor <?php echo $user['name']; ?>" />
                <?php echo $user['name']; ?>
            </a>
        </div>

        <?php foreach($user['report'] as $key => $value): ?>

        <div>
            <div class="property"><?php echo $key; ?></div>
            <div class="value"><?php echo $value; ?></div>
        </div>

        <?php endforeach; ?>

    </div>
<?php endforeach; ?>