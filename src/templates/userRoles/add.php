<h2>Add New user role to user <?= $params['user']->getLogin() ?></h2>
<a href="/user-roles?userId=<?= $params['user']->getId() ?>" class="button-link secondary">Back to the list</a>
<form method="post" action="/user-roles/add?userId=<?= $params['user']->getId() ?>" id="add-user-role-form">
    <div>
        <label for="user-login">Role:</label>
        <select name="role_id" id="role-id">
            <?php foreach ($params['roles'] as $role) : ?>
                <option value="<?= $role->getId() ?>"><?= $role->getName() ?></option>
            <?php endforeach; ?>    
        </select>
    </div>
    <div>
        <button type="submit">Add role</button>
    </div>
</form>