<h2>Edit Author</h2>
<a href="/authors" class="button-link secondary">Back to the list</a>
<form method="post" action="/authors/edit/?id=<?= $params['author']->getId() ?>" id="edit-author-form">
    <div>
        <label for="author-name">Name:</label>
        <input type="text" id="author-name" name="author_name" value="<?= $params['author']->getName() ?>" required>
    </div>
    <div>
        <label for="user-login">User:</label>
        <select name="user_id" id="user-id">
            <option value="">no user</option>
            <?php foreach ($params['users'] as $user) : ?>                
                <option value="<?= $user->getId() ?>" 
                    <?= ($user->getId() == $params['author']->getUser()?->getId()) ? 'selected' : '' ?>
                >
                    <?= $user->getLogin() ?>
                </option>
            <?php endforeach; ?>    
        </select>
    </div>
    <div>
        <button type="submit">Save Author</button>
    </div>
</form>