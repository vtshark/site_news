
<div class = "container">
    <div class = "row">
        <hr>
        <b>Комментарии:</b><br/><br/>
        <?php foreach ($arrComm as $idComm => $v): ?>
            <div class="text-news-div">
                <div class="inbl">
                    <?= $v['time'] ?><br/>
                    <?= $v['autor'] ?><br/>
                    <?= $v['ava'] ?>
                </div>
                <div class="inbl">
                    <?= $v['text'] ?>
                </div>
                </div>
            <br/><br/>
        <?php endforeach; ?>
        <?php if ($user): ?>
            <form action="<?=ROOT?>News/id/<?=$id?>" method ="POST" enctype="multipart/form-data">
                <textarea class='textcomm' name='text' placeholder='Новый комментарий'></textarea>
                <input class='btn btn-primary btn-2x"' type="submit" value="Добавить">
            </form>
        <?php endif; ?>
    </div>

</div>