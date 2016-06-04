<header>
    <div id="menu" class="menu navbar-top">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                    <span class="glyphicon glyphicon-align-justify"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="responsive-menu">
                <ul class='nav navbar-nav'>

                    <li><a href='<?=ROOT?>'>Новости</a></li>

                    <?php if ($user != "") : ?>
                        <li><a href='<?=ROOT?>userNews'>Мои публикации</a></li>
                        <li><a href='<?=ROOT?>userNews/addForm'>Добавить новость</a></li>
                        <li><a href='<?=ROOT?>Subscribe/mySubs/'>Мои подписки</a></li>
                        <li><a href='<?=ROOT?>users'>Пользователи</a></li>
                        <li><a href='<?=ROOT?>profile'><?= $user ?></a></li>
                        <li><a href='<?=ROOT?>signOut'>Выход</a></li>

                    <?php else: ?>
                        <li><a href='<?=ROOT?>login'>Авторизация</a></li>
                        <li><a href='<?=ROOT?>reg'>Регистрация</a></li>
                    <?php endif; ?>


                </ul>
            </div>
        </div>
    </div>

</header>