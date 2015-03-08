<div class="user" itemscope itemref="http://schema.org/Person">
    <img itemprop="image" src="<?php echo image($user['image'], 100, 100); ?>" alt="Profielafbeelding van <?php echo $user['name']; ?>" />
    <h1 itemprop="name"><?php echo $user['name'];?></h1>
</div>

<?php if ($this->user->can('userprogress.create')): ?>
<div class="report" data-url="<?php echo url('/add', true); ?>">
    <select id="report_type">
        <?php foreach($reportTypes as $type): ?>
            <option value="<?php echo get_class($type); ?>"><?php echo $type->getName(); ?></option>
        <?php endforeach; ?>
    </select>
    <button id="report_add">Add new Report</button>
</div>
<?php endif; ?>

<?php foreach($reports as $report): ?>
    <?php include(APP_PATH . '/views/userprogress/single-report.php'); ?>
<?php endforeach;