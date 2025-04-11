<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

<section class="restaurantas">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-title">Рестораны</h2>
        </div>
        <div class="row mt-5">
            <?php

            if (!empty($cafes)): ?>
                <?php foreach ($cafes as $cafe): ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <a href="<?= Url::to(['cafe/view', 'id' => $cafe->id]) ?>" class="card h-100">
                            <div class="card-img-wrapper">
                                <div class="card-hover-overlay"></div>
                                <?= Html::img("@web/uploads/cafe/" . $cafe->image, ['class' => 'card-img-top']) ?>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="card-heading d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><?= Html::encode($cafe->name) ?></h3>
                                    <span class="card-tag tag"><?= Html::encode($cafe->type) ?></span>
                                </div>
                                <div class="card-info d-flex justify-content-between align-items-center mt-auto text-center">
                                    <div class="raiting">
                                        <span class="raiting-star">🟊 <?= $cafe->rate ?></span>
                                    </div>
                                    <div class="price">
                                        <span class="phone-icon">&#9742;</span> <?= $cafe->phone ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Рестораны не найдены.</p>
            <?php endif; ?>
        </div>

        <div class="row text-center">
            <div class="col-12 d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation example">
                    <?= LinkPager::widget([
                        'pagination' => $pagination,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link custom-page-link'],
                        'options' => [
                            'class' => 'pagination justify-content-center',
                            'aria-label' => 'Page navigation',
                        ],
                        'prevPageLabel' => '&laquo;',
                        'nextPageLabel' => '&raquo;',
                        'disabledListItemSubTagOptions' => ['class' => 'page-link custom-page-link disabled'],
                        'disabledPageCssClass' => 'disabled',
                    ]) ?>
                </nav>
            </div>
        </div>
    </div>
</section>
