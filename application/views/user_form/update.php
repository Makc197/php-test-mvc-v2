<h1>
    Редактирование данных
    пользователя <?= $user->getSurname() . " " . $user->getForename() . " (" . $user->getUsername() . ")"; ?>
</h1>

<div>
    <div class="col-md-6">

        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form id="form_1" method="post" action="/usermanagement/update">

            <input type="hidden" name="id" value="<?= $user->getID(); ?>">

            <div class="form-group">
                <label for="forename">Имя:</label>
                <input required class="form-control" type="text" name="forename" value="<?= $user->getForename(); ?>">
            </div>

            <div class="form-group">
                <label for="surname">Фамилия:</label>
                <input required class="form-control" type="text" name="surname" value="<?= $user->getSurname(); ?>">
            </div>

            <div class="form-group">
                <label for="username">Login:</label>
                <input required class="form-control" type="text" name="username" value="<?= $user->getUsername(); ?>">
            </div>

            <div class="form-group">
                <label for="userrole">Role:</label>
                <?php
                echo HtmlHelper::createSelect([
                    'class' => 'form-control',
                    'name' => 'role_id'
                        ], $roles_data, $user->getRoleId());
                ?>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input required class="form-control" type="text" name="password" value="<?= $user->getPassword(); ?>">
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Save</button>
            <button
                name="clear"
                class="btn btn-default"
                type="reset"
                onclick="var form = $('#form_1');
                        $('#form_1').find('input[type=text]').each(function (k, el) {
                            $(el).attr('value', null);
                        });
                "
                class="btn btn-default">Clear
            </button>
    </div>
</div>
