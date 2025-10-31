<h2>User</h2>
<div> 
    <a href="/authors">Back to the list</a>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>ID: </td>
            <td><?= $params['author']->getId(); ?></td>
        </tr>
        <tr>
            <td>Name: </td>
            <td><?= $params['author']->getName(); ?></td>                
        </tr>
        <tr>
            <td>User login: </td>
            <td><?= $params['author']->getUser()?->getLogin(); ?></td>                
        </tr>
</div>