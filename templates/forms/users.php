<br/><br/>
<div class = "container" onclick="getEvent(event,<?=$idUser?>)">
    <div class = "row">
        <div class = "col-lg-5 col-md-6 col-sm-9 col-xs-12">
            <?php if (isset($users) && !empty($users)): ?>
                <?php foreach ($users as $val):; ?>
                    <?php if ($idUser!=$val['id']): ?>
                        <div class="text-news-div">
                            <input type="text" id="idUser" hidden value="<?=$val['id']?>"/>
                            <a href='<?=ROOT?>profile/userInfo/<?=$val['id']?>/'> 
                                <?= \core\Img::getAva($val['id'])?>
                                <?=$val['name']?> <?=$val['second_name']?>
                            </a>
                            <br/>
                            <a href='<?=ROOT?>userNews/allNews/1/<?=$val['id']?>'>Публикации пользователя</a>
                            
                            <div class="divright" id = "divright<?=$val['id']?>">
                                <?php  $subs = \model\Subscribe::ifSubsUser($idUser,$val['id']);    
                                    //var_dump( $subs);
                                    if (!$subs) : ?>
                                        <button name="subs" id="<?=$val['id'];?>" type="button" 
                                            class="btn btn-default btn-xs" title="Подписаться">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    <?php else: ?>
                                        <span class="glyphicon glyphicon-ok"></span>
                                        <button name="unsubs" id="<?=$val['id'];?>" type="button" 
                                        class="btn btn-default btn-xs" title="Отписаться">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                    <?php endif; ?> 
                            </div>
                        </div>
                        <br/>
                    <?php endif; ?>
                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>
</div>