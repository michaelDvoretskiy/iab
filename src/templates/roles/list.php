<h2>User roles</h2>
<a href="/roles/add">Add new</a>
<div>
    <?php foreach ($params['roles'] as $role) : ?>
        <p>
            <?= $role->getId() ?> : 
            <a href="/roles/view-one/?id=<?= $role->getId() ?>">
                <?= $role->getName() ?>
            </a>
        </p>
    <?php endforeach; ?>
</div>