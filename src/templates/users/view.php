<h2>User</h2>
<div> 
    <a href="/users">Back to the list</a>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>ID: </td>
            <td><?= $params['user']->getId(); ?></td>
        </tr>
        <tr>
            <td>Login: </td>
            <td><?= $params['user']->getLogin(); ?></td>                
        </tr>
        <tr>
            <td>Email: </td>
            <td><?= $params['user']->getEmail(); ?></td>                
        </tr>
</div>