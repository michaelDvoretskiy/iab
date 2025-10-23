<h2>User roles</h2>
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