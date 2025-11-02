<h2>Add New Author</h2>
<a href="/authors" class="button-link secondary">Back to the list</a>
<form method="post" action="/authors/add" id="add-user-form">
    <div>
        <label for="author-name">Name:</label>
        <input type="text" id="author-name" name="author_name" required>
    </div>
    <div>
        <label for="user-login">User:</label>
        <select name="user_id" id="user-id">
            <option value="">no user</option>
            <?php foreach ($params['users'] as $user) : ?>
                <option value="<?= $user->getId() ?>"><?= $user->getLogin() ?></option>
            <?php endforeach; ?>    
        </select>
    </div>
    <div>
        <button type="submit">Add Author</button>
    </div>
</form>