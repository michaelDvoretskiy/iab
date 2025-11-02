<h2>User role of user <?= $params['userRole']->getUser()->getLogin() ?></h2>
<div> 
    <a href="/user-roles?userId=<?= $params['userRole']->getUser()->getId() ?>" class="button-link secondary">Back to the list</a>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>ID: </td>
            <td><?= $params['userRole']->getId(); ?></td>
        </tr>
        <tr>
            <td>Login: </td>
            <td><?= $params['userRole']->getRole()->getName(); ?></td>                
        </tr>
    </table>
</div>