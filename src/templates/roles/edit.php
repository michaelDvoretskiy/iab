<h2>Edit Role</h2>
<a href="/roles">Back to the list</a>
<form method="post" action="/roles/edit/?id=<?= $params['role']->getId() ?>">
    <div>
        <label for="role-name">Role Name:</label>
        <input type="text" id="role-name" name="name" required value="<?= $params['role']->getName() ?>">
    </div>
    <div>
        <button type="submit">Save Role</button>
    </div>
</form>