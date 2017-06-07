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
                    <a href="<?= $host.'/admin'?>"><?= $host.'/admin'?></a>
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
                    GET
                    <a href="<?= $host.'/v1/discount'?>"><?= $host.'/v1/discount'?></a>
                    <br>
                    Обязательный параметр в запросе: name - наименование промокода.
                    <br>
                    Активация промокода.
                    <br>
                    PUT
                    <a href="<?= $host.'/v1/discount/activate'?>"><?= $host.'/v1/discount/activate'?></a>
                    <br>
                    Обязательный параметр: name - наименование промокода, city - намименование города
                </p>

            </div>
        </div>

    </div>
</div>
