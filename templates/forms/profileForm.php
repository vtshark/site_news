<div class="d1 container-fluid">
    <div class="row">

        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-10">
            <div class="text-news-div">
                <?= \core\Img::getAva($v['id_user'])?>
                <?= $v['name']." ".$v['second_name']?>
                <br/>
                <br/>
                <a href='<?=ROOT?>userNews/allNews/1/<?=$v['id_user']?>'>Публикации пользователя</a>
            </div>
            
        </div>
    </div>
</div>