<br/><br/>
<div class = "container">
    <div class = "row">
        <div class = "col-lg-4 col-md-5 col-sm-6 col-xs-8">
            <?php if (isset($error) && !empty($error)): ?>
                <?php foreach ($error as $val): ?>
                    <?=$val; ?><br/>
                <?php endforeach; ?>
                <hr>
            <?php endif; ?>
            <form action="<?=ROOT?>login/login" method ="POST">
                <input name ="login" class="form-control" type="text" placeholder="Имя пользоваля" value="<?=$login?>"><br/>
                <input name ="password" class="form-control" type="password" placeholder="Пароль"><br/><br/>
                <input class='btn btn-primary' type="submit" value="Войти">
            </form>
            <hr>
            <form action="<?=ROOT?>reg" method ="POST">
                <input class='btn btn-primary' type="submit" value="Регистрация"><br/>
            </form>
        </div>
    </div>
</div>