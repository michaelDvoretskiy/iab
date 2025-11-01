<h2>User roles</h2>
<a href="/roles/add" class="button-link">Add new</a>
<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($params['roles'] as $role) : ?>
            <tr>
                <td>
                    <?= $role->getId() ?> 
                </td>
                <td>
                    <?= $role->getName() ?>
                </td>
                <td>
                    <a class="button-link outline" href="/roles/view-one?id=<?= $role->getId() ?>">View</a>
                    <a class="button-link outline" href="/roles/edit?id=<?= $role->getId() ?>">Edit</a>                    
                    <a class="button-link outline" href="#" onclick="deleteRole(<?= $role->getId() ?>)">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    function deleteRole(roleId) {
        if (confirm('Are you sure you want to delete this role?')) {
            fetch('/roles/delete?id=' + roleId, {
                method: 'POST'
            }).then(() => {
                window.location.reload();
            });
        }
    }
</script>