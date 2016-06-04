<br/><br/>
<div class = "container">
    <div class = "row">
        <div class = "col-lg-8 col-md-10 col-sm-12 col-xs-12">
            <?php if (isset($error) && !empty($error)): ?>
                <?php foreach ($error as $val): ?>
                    <?=$val; ?><br/>
                <?php endforeach; ?>
                <hr>
            <?php endif; ?>
            <div>
                Автор: <?=$user?> <br/>
                <?= \core\Img::getAva($idUser)?><br/>
                Дата: <?=date("d.m.Y")?>

            </div>

            <form action="<?=ROOT?>userNews/add" method ="POST" enctype="multipart/form-data">
                <input name = "id" class="form-control" type="hidden"  value="<?=$id?>">
                <input name = "title" class="form-control" type="text" placeholder="Заголовок" value="<?=$title?>">
                <hr>
                Изображение<br/>

                <?php $img = \core\Img::getImgNews($idUser,$id) ?>
                <?=$img;?>
                <?php if ($img) : ?>
                    <button onclick="location='<?=ROOT?>userNews/delimg/<?=$id?>'" type="button"
                            class="btn btn-default btn-2x" title="Удалить">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                <?php endif;?>


                <br/>

                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="userfile"/>
                <hr>
                <textarea class='textnews' name='text' placeholder='текст'><?=$text?></textarea>

                <input class='btn btn-primary' type="submit" value="Сохранить">
            </form>

        </div>
    </div>
</div>