<?php
/**
 * @var $user ModelUser
 */
?>
<h1>
    Регистрация пользователя. Введите данные.
</h1>

<div>
    <div class = "col-md-6">

        <?php if (!empty($errors) & !empty($errors[0])): ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form id="form_1" method="post" action="/?r=userregistration/create">

            <input type="hidden" name="id" value="">
     
            <div class="form-group">
                <label for="forename">Имя:</label>
                <input required class="form-control" type="text" name="forename"
                       value="<?= isset($_POST['forename']) ? $_POST['forename'] : $user->getForeName(); ?>">
            </div>

            <div class="form-group">
                <label for="surname">Фамилия:</label>
                <input required class="form-control" type="text" name="surname"
                       value="<?= isset($_POST['surname']) ? $_POST['surname'] : $user->getSurName(); ?>">
            </div>

            <div class="form-group">
                <label for="username">Login:</label>
                <input required class="form-control" type="text" name="username"
                       value="<?= isset($_POST['username']) ? $_POST['username'] : $user->getUserName(); ?>" >
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input required class="form-control" type="text" name="password"
                       value="<?= isset($_POST['password']) ? $_POST['password'] : $user->getPassword(); ?>" >
            </div>
            
            <div>
                <img src="<?=$captha; ?>">              
            </div>
            
             <div class="form-group">
                <label for="answer">Введите символы с изображения:</label>
                <input required class="form-control" type="text" name="answer">
            </div>
               
            <button name="submit" type="submit" class="btn btn-primary">Create</button>
            <button 
                name="clear"
                class="btn btn-default"
                type="reset"
                onclick="var form = $('#form_1');
                        $('#form_1').find('input[type=text]').each(function (k, el) {
                            $(el).attr('value', null);
                        });
                " 
                class="btn btn-default">Clear</button>
    </div>
</div>