<h2>User <?= $params['user']->getLogin() ?> roles</h2>
<div>
    <a href="/users" class="button-link secondary">Back to the users list</a>
</div>

<a href="/user-roles/add?userId=<?= $params['user']->getId() ?>" class="button-link">Add new</a>
<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($params['userRoles'] as $userRole) : ?>
            <tr>
                <td><?= $userRole->getId() ?></td>
                <td><?= $userRole->getRole()->getName() ?></td>
                <td>
                    <a class="button-link outline" href="/user-roles/view?id=<?= $userRole->getId() ?>">View</a>
                    <a class="button-link outline" href="/user-roles/edit?id=<?= $userRole->getId() ?>">
                        Edit
                    </a>                    
                    <a class="button-link outline" href="#" onclick="deleteUserRole(<?= $userRole->getId() ?>)">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    function deleteUserRole(userRoleId) {
        if (confirm('Are you sure you want to delete this author?')) {
            fetch('/user-roles/delete?id=' + userRoleId, {
                method: 'POST'
            }).then(() => {
                window.location.reload();
            });
        }
    }
</script>