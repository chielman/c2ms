<div role="navigation" id="menu">
    <ul>
        <li><a href="<?php echo url(); ?>">Home</a></li>
        <li><a href="<?php echo url('nieuws'); ?>">Nieuws</a></li>
        <li><a href="<?php echo url('events'); ?>">Kalender</a></li>

        <?php if ($this->user->isGuest()): ?>
        <li><a href="<?php echo url('login'); ?>">Login</a></li>
        <?php else: ?>
        <li><a href="<?php echo url('me'); ?>">Profile</a></li>
        <?php endif; ?>
    </ul>
</div>