<br/>
<div class = "container">
    <div class = "row">

        <?php if (isset($news) && !empty($news)): ?>
            <?php foreach ($news as $val): ?>
                    
                <div class = "col-lg-1 col-md-1 col-sm-2 col-xs-2">
                <div class="divleft">
                    Автор: <?= \model\Profile::getName($val['idUser']); ?><br/>
                    <?= \core\Img::getAva($val['idUser'])?><br/>
                    <?=$val['date']; ?>
                </div>
                </div>

                <div class = "col-lg-11 col-md-11 col-sm-10 col-xs-10">
                
                <div class="clearleft text-news-div">
                    <div class="center">
                        <h3><?=$val['title']; ?></h3><br/>
                    </div>
                    <?php if ($val['idUser'] == $idUser): ?>
                        <div class="right">
                            <button onclick="location='<?=ROOT?>userNews/addForm/<?=$val['id']?>'" type="button" class="btn btn-default btn-2x" title="Корректировать">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>

                            <button onclick="location='<?=ROOT?>userNews/del/<?=$val['id']?>'" type="button" class="btn btn-default btn-2x" title="Удалить">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="center">
                        <?= \core\Img::getImgNews($val['idUser'],$val['id'])?>
                    </div><br/>
                    <div class="inbl">
                    <?=substr($val['text'],0,300); ?>
                        <button onclick="location='<?=ROOT?>news/id/<?=$val['id']?>'" type="button"
                                class="btn btn-primary btn-2x">
                            Читать
                        </button>
                    </div>
                </div>
                <br/>
                
                <hr>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>


    </div>
</div>
