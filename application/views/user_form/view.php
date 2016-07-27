<h1> Read <?= $user->getUsername() ?> (ID: <?= $user->getID() ?> ) </h1>
<div class="formtable-div-block col-md-6">
    <table class="table">
        <thead>
        <tr>
            <th>Field name</th>
            <th>Field value</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td> Имя:</td>
            <td><?= $user->getForename(); ?></td>
        </tr>

        <tr>
            <td> Фамилия:</td>
            <td><?= $user->getSurname(); ?></td>
        </tr>

        <tr>
            <td> Login:</td>
            <td><?= $user->getUsername(); ?></td>
        </tr>

        <tr>
            <td> Password:</td>
            <td><?= $user->getPassword(); ?></td>
        </tr>

        <tr>
            <td> Token:</td>
            <td><?= $user->getToken(); ?></td>
        </tr>

        <tr>
            <td> RoleCode:</td>
            <td><?= $user->getRoleCode(); ?></td>
        </tr>

        <tr>
            <td> RoleName:</td>
            <td><?= $user->getRoleName(); ?></td>
        </tr>

        </tbody>
    </table>
</div>

