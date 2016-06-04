<br/>

<?php
$bufUser = "";
if ($rootNews == 'news/allNews/') {
    $kol = \model\News::countAllNews();
}   else {
    $kol = \model\News::countUserNews($idAutor);
    $bufUser = "/".$idAutor;
}
$page1 = ($page == 1) ? $page : $page - 1;
$page2 = ($page*5 <= $kol) ? $page + 1 : $page;
$pageEnd = ceil($kol/5);
?>
<div class="center">

    <?php if ($kol > 5): ?>
        <button onclick="location='<?=ROOT.$rootNews.'1'.$bufUser?>'"
                type="button" class="btn btn-default btn-2x">
            1
        </button>

        <button onclick="location='<?=ROOT.$rootNews.$page1.$bufUser?>'"
                type="button" class="btn btn-default btn-2x">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <?php
        $i = ($page > 3) ? ($page - 2) : 1;
        $j = $page + 2;
        while ($i <= $pageEnd && $i <= $j ) {
            $class = ($page == $i) ? "btn btn-primary":"btn btn-default";
            echo "<button onclick=location='".ROOT.$rootNews.$i.$bufUser."'
                type='button' class='$class btn-2x'>".$i."</button>&nbsp;";
            $i++;
        }
        ?>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button onclick="location='<?=ROOT.$rootNews.$page2.$bufUser?>'"
                type="button" class="btn btn-default btn-2x">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </button>

        <button onclick="location='<?=ROOT.$rootNews.$pageEnd.$bufUser?>'"
                type="button" class="btn btn-default btn-2x">
            <?=$pageEnd?>
        </button>
    <?php endif;?>
</div>