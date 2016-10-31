<h1>Задача №1</h1>

<div>    
    <div class="col-md-6">
        <?php if (isset($data)): ?>
            <ul>
                <div> Точки: </div>
                <?php foreach ($data as $i => $point): ?>
                    <li><?= "Point " . $i . " : " . $point ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<div>    
    <div class="col-md-6">
        <?php
        if (isset($str)):
            echo $str;
        endif;
        ?>
    </div>
</div>

<div>    
    <div class="col-md-6">
        <?php if (isset($errors)): ?>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= $err; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>