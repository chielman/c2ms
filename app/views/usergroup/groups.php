<?php foreach ($groups as $group): ?>
<div>
    <a href="<?php echo url('groups/' . $group['slug']); ?>"><?php echo $group['name']; ?></a>
</div>
<?php endforeach; ?>

<?php if ($this->user->can('permission.view')): ?>
    <h3>Rechten</h3>
    <table>
        <tr>
            <th>recht</th>
            <?php foreach($groups as $group): ?>
            <th><?php echo $group['name']; ?></th>
            <?php endforeach; ?>
        </tr>
        </tr>
        <?php foreach ($permissions as $permission): ?>
        <tr>
            <td><?php echo $permission['permission']; ?></td>
            <?php foreach ($permission['_value'] as $groupPermission): ?>
            <td><?php if ($groupPermission): ?>
                v
                <?php else: ?>
                x
                <?php endif; ?>
            </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>