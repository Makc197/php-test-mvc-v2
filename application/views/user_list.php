<?php
/**
 * @var $user ModelUser
 * @var $data Array
 */
?>
<div class="btn-group">
    <a id="create_user_button" class="btn btn-create-new btn-primary btn-md" role="button" href="?r=usermanagement/create">Добавить пользователя</a>
</div>

<div class="table-block-400">
<table class="table">
    <thead>
        <tr><th>Id</th>
            <th>ForeName</th>
            <th>SurName</th>
            <th>UserName</th>
            <th>Password</th>
            <th>Token</th>
            <th>RoleCode</th>
            <th>RoleName</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php foreach ($data as $user) : ?>
        <?php $id = $user->getId(); ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><a href='?r=usermanagement/view&id=<?php echo $id; ?>'>
            <?php echo $user->getForeName() ?></a>
            </td>
            <td><?php echo $user->getSurName(); ?></td>
            <td><?php echo $user->getUserName(); ?></td>
            <td><?php echo $user->getPassword(); ?></td>
            <td><?php echo $user->getToken(); ?></td>
            <td><?php echo $user->getRoleCode(); ?></td>
            <td><?php echo $user->getRoleName(); ?></td>
            <td>
                <a href="?r=usermanagement/view&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-search"></span>
                </a>
                <a href="?r=usermanagement/update&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a href="?r=usermanagement/delete&id=<?php echo $id; ?>">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</div>

<?php echo $paginator->html();?>



