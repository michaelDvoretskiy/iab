<h2>User roles</h2>
<a href="/users/add">Add new</a>
<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($params['users'] as $user) : ?>
            <tr>
                <td><?= $user->getId() ?></td>
                <td><?= $user->getLogin() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td>
                    <a href="/users/view?id=<?= $user->getId() ?>">View</a>
                    <a href="/users/edit?id=<?= $user->getId() ?>">Edit</a>                    
                    <a href="#" onclick="deleteUser(<?= $user->getId() ?>)">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user?')) {
            fetch('/users/delete?id=' + userId, {
                method: 'POST'
            }).then(() => {
                window.location.reload();
            });
        }
    }
</script>