<h2>Edit user role of user <?= $params['userRole']->getUser()->getLogin() ?></h2>
<a href="/user-roles?userId=<?= $params['userRole']->getUser()->getId() ?>" class="button-link secondary">Back to the list</a>
<form method="post" action="/user-roles/edit?id=<?= $params['userRole']->getId() ?>" id="edit-user-role-form">
    <div>
        <label for="user-login">Role:</label>
        <select name="role_id" id="role-id">
            <?php foreach ($params['roles'] as $role) : ?>
                <option 
                    value="<?= $role->getId() ?>"
                    <?= ($role->getId() == $params['userRole']->getRole()?->getId()) ? 'selected' : '' ?>
                >
                    <?= $role->getName() ?>
                </option>
            <?php endforeach; ?>    
        </select>
    </div>
    <div>
        <button type="submit">Save role</button>
    </div>
</form>