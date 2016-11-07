<h1>Задача №1</h1>

<form class="form-inline" id="example1" method="post" action="/?r=examples/testtask1">
    <div class="form-group">
        <label for="x">X:</label>
        <input required class="form-control" type="text" name="Math[x]"
               value="">
    </div>
    <div class="form-group">
        <label for="y">Y:</label>
        <input required class="form-control" type="text" name="Math[y]" 
               value="">
    </div>
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
    <a href='/?r=examples/reset' class="btn btn-default">Reset</a>
</form>

<?= !empty($data)? 'Точки:' : '' ?>
<div class="row">
    <div class="col-md-3">
        <?php if (!empty($data)): ?>
            <ul>
                <?php foreach ($data as $i => $point): ?>
                    <li><?= sprintf('Point %s : %s', $i, $point); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <?php
        if (!empty($str)):
            echo $str;
        endif;
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-8">

        <?php if (!empty($errors)): ?>
            <?php echo 'Ошибки:'; ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div> 
</div>

