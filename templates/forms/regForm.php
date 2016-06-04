<div class = "container">
    <div class = "row">
        <div class = "col-lg-4 col-md-5 col-sm-6 col-xs-8">
            <?php $i = 0; if (isset($error)): ?>
                <br/>
                <?php foreach ($error as $val): ?>
                    <?=++$i.'.'.$val; ?><br/>
                <?php endforeach; ?>
                <hr>
            <?php endif;?>
                <?=$msg?><br/>
                <div class='reg'>
                    <form action="<?=ROOT?>reg/registration" method ="POST">
                        <input name="login" class="form-control" type="text" placeholder="Логин" value='<?=$login?>'><br/>
                        <input name="email" class="form-control" type="text" placeholder="e-mail" value='<?=$email?>'><br/>
                        <input name="name" class="form-control" type="text" placeholder="Имя" value='<?=$name?>'><br/>
                        <input name="secondName" class="form-control" type="text" placeholder="Фамилия" value='<?=$secondName?>'><br/>

                        <!--
                        <input id="city" class="form-control" type="text" placeholder="Город" value='<?/*=$city*/?>'><br/>
                        <input id="cityId" type="hidden" value=''><br/>
                        <div>
                            <ul id="cityList">
                            </ul>
                        </div>-->

                        <input name="password" class="form-control" type="password" placeholder="Пароль"><br/>
                        <input name="password1" class="form-control" type="password" placeholder="Подтвердите пароль"><br/>
                        <input class='btn btn-primary' type="submit" value="Ок">
                    </form>
                    <hr>
                    <form action="<?=ROOT?>" method ="POST">
                        <br/><input class='btn btn-primary' type="submit" value="Главная страница">
                    </form>
                </div>
        </div>
    </div>
</div>