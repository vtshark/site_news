<div class="d1 container-fluid">
    <div class="row">

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
        <div class="d2 col-lg-4 col-md-5 col-sm-6 col-xs-10">

            <!--Вывод ошибок-->
            <?php if (isset($error) && !empty($error)): ?>
                <br/>
                <?php foreach ($error as $val): ?>
                    <?=$val; ?><br/>
                <?php endforeach; ?>

                <hr>
            <?php endif; ?>
            <br/>
            Настройки профиля <?=$user?>

            <hr>
            <!--настройка аватарки-->
            <div><?= \core\Img::getAva($idUser)?></div>
            <form action="<?=ROOT?>profile/updateAva" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="userfile"/>
                <br/><br/>
                <input class="btn btn-primary" type="submit" value="Обновить фото"/>
            </form>
            <hr>
            <!--настройка ФИО-->
            <form action="<?=ROOT?>profile/save" method="post">
                <input name ="name" class="form-control" type="text" placeholder="Имя" value="<?= $v['name'] ?>">
                <br/>
                <input name ="secondName" class="form-control" type="text"
                       placeholder="Фамилия" value="<?= $v['second_name'] ?>"><br/>
                <br/>Дата рождения:

                <div class="inbl">
                    <input name="day"  type="text" placeholder="д."
                       pattern="[0-9]{2}" style='width:40px' value="<?=$day?>">
                </div>

                <div class="inbl">
                    <input name ="month"  type="text"
                           value="<?= $month ?>" value="" placeholder="м." maxlength=2 pattern="[0-9]{2}"
                       style='width:40px'>
                </div>

                <div class="inbl">
                    <input name ="year"  type="text" value="<?= $year ?>" placeholder="год" maxlength=4 pattern="[0-9]{4}" style='width:70px'>
                </div>

                <br/><br/>
                <input class="btn btn-primary" type="submit" value="Сохранить"/>
            </form>

        </div>
    </div>
</div>
