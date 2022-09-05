<?php
$userModel = new \models\Users();
$user = $userModel->GetCurrentUser();
$dateToday = date('Y-m-d H:i:s');
?>
<h1 style="text-align: center">Гарячі новинки</h1>
<br>
<div id="carouselExampleIndicators" class="carousel slide carousel-dark" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner image-wrapper">
        <div class="carousel-item active image-inner" style="left: 25%;right: 50%">
            <a href="/products/view?id=<?= $model[0]['id']?>"><img src="/files/products/<?= $model[0]['photo']?>_b.jpeg" class="d-block  rounded" alt="..."></a>
        </div>
        <div class="carousel-item image-inner" style="left: 25%;right: 50%">
            <a href="/products/view?id=<?= $model[0]['id']?>"><img src="/files/products/<?= $model[1]['photo']?>_b.jpeg" class="d-block rounded" alt="..."></a>
        </div>
        <div class="carousel-item image-inner" style="left: 25%;right: 50%">
            <a href="/products/view?id=<?= $model[0]['id']?>"><img src="/files/products/<?= $model[2]['photo']?>_b.jpeg" class="d-block  rounded" alt="..."></a>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
