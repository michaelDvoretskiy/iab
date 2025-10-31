<h2>Authors</h2>
<a href="/authors/add">Add new</a>
<div>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($params['authors'] as $author) : ?>
            <tr>
                <td><?= $author->getId() ?></td>
                <td><?= $author->getName() ?></td>
                <td><?= $author->getUser()?->getLogin() ?></td>
                <td>
                    <a href="/authors/view?id=<?= $author->getId() ?>">View</a>
                    <a href="/authors/edit?id=<?= $author->getId() ?>">Edit</a>                    
                    <a href="#" onclick="deleteAuthor(<?= $author->getId() ?>)">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    function deleteAuthor(userId) {
        if (confirm('Are you sure you want to delete this author?')) {
            fetch('/authors/delete?id=' + userId, {
                method: 'POST'
            }).then(() => {
                window.location.reload();
            });
        }
    }
</script>