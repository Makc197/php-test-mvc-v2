<h1> 
    Аутентификация
</h1>

<div>    
    <div class="col-md-6">
        <?php if (is_array($errors)) : ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form id="form_1" method="post" action="/?r=authentication/login">

            <div class="form-group">
                <label for="username">Login:</label>
                <input required class="form-control" type="text" name="login" value="">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input required class="form-control" type="password" name="password" value="">
            </div>

            <button name="submit" type="submit" class="btn btn-primary">Login</button>
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