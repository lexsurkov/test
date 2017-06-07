<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<?php $host = (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'] ?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Админка</h2>

                <p>Админка находится по адресу
                    <?= \yii\helpers\Html::a($host.'/admin',[$host.'/admin'])?>
                    <br>
                    В админке существует возможность добавления городов и промокодов.
                </p>
            </div>
            <div class="col-lg-12">
                <h2>API</h2>

                <p>Доступные методы API
                    <br>
                    Получение информации промокода.
                    <br>
                    GET <?= \yii\helpers\Html::a($host.'/v1/discount', $host.'/v1/discount', ['target' => '_blank', 'rel' => 'nofollow'])?>
                    <br>
                    Обязательный параметр в запросе: name - наименование промокода.
                    <br>
                    Активация промокода.
                    <br>
                    PUT <?= \yii\helpers\Html::a($host.'/v1/discount/activate', $host.'/v1/discount/activate', ['target' => '_blank', 'rel' => 'nofollow'])?>
                    <br>
                    Обязательный параметр: name - наименование промокода, city - намименование города
                </p>

            </div>
        </div>

    </div>
</div>
