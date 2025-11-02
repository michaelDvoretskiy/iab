<?php if ($params['currentUser']) : ?>
    <h2>Hello <?= $params['currentUser']->getLogin() ?></h2>
<?php endif; ?>
<ul>
    <li>
        <a href="/">Home</a>
    </li>
    <li>
        <a href="/users">Users</a>
    </li>
    <li>
        <a href="/roles">Roles</a>
    </li>
    <li>
        <a href="/authors">Authors</a>
    </li>
    <li>
        <?php if ($params['currentUser']) : ?>
            <a href="/logout">Logout</a>
        <?php else : ?>
            <a href="/login">Login</a>
        <?php endif; ?>
    </li>
</ul>