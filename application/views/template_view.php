<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Products catalog</title>

        <!-- Bootstrap -->
        <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
        <script src="/js/jquery-1.12.4.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">TEST Portal</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <!-- <li class="active"><a href="/">Главная</a></li> -->
                        <li>
                        <a href="/">
                            <span class="glyphicon glyphicon-home" style="font-size: 20px;"></span>
                        </a>
                        </li>
                        
                        <li class="dropdown"><a href="#"class="dropdown-toggle" data-toggle="dropdown">Каталог товаров<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/?r=book/index">Книги</a></li>
                                <li><a href="/?r=cd/index">Компакт диски</a></li>
                                <li><a href="/?r=product/index">Прочие товары</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Отдельная ссылка</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Еще одна отдельная ссылка</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown"><a href="#"class="dropdown-toggle" data-toggle="dropdown">Тестовые задачки<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/?r=examples/testtask1">Точки. Длина цепи.</a></li>
                                <li><a href="#">Тестовая задача №2</a></li>
                                <li><a href="#">Тестовая задача №3</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Отдельная ссылка</a></li>
                            </ul>
                        </li>

                        <?php if(isset($_SESSION['user']) && ($_SESSION['user']['role_code'] == 'admin')): ?>
                        <li class="dropdown"><a href="#"class="dropdown-toggle" data-toggle="dropdown">Администрирование<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/?r=usermanagement/index">Список пользователей</a></li>
                                <li><a href="#">...</a></li>
                            </ul>
                        </li>
                        <?php endif;?>

                        <li>
                            <?php if(!isset($_SESSION['user'])): ?>
                                <a href="/?r=authentication/login">Войти</a>
                            <?php else :?>
                                <a href="/?r=authentication/logout">(<?php echo $_SESSION['user']['username']; ?>)Выйти</a>
                            <?php endif;?>
                        </li>                        

                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container">
            
            <?php include 'application/views/' . $content_view; ?>

        </div>			
        <div id="footer">
            <div class="container">
                <p class="text-muted">Place sticky footer content here.</p>
            </div>
        </div>
    </div>
</body>
</html>