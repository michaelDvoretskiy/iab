<h2>User role</h2>
<div> 
    <a href="/roles" class="button-link secondary">Back to the list</a>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>ID: </td>
            <td><?= $params['role']->getId(); ?></td>
        </tr>
        <tr>
            <td>Name: </td>
            <td><?= $params['role']->getName(); ?></td>                
        </tr>
</div>