<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <!--<script type="text/javascript" src="js/mainController.js"></script>-->
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Главная',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->session->get('user') ? (
              Yii::$app->session->get('user')->scope=="admin" ?
              ['label' => 'Добавление тестов в БД', 'url' => ['/testing/testadd']
              ] : '') : '',
            Yii::$app->session->get('user') ? (
              Yii::$app->session->get('user')->scope=="admin" ?
              ['label' => 'Редактирование тестов',
                'items' => [
                      ['label' => 'Тесты', 'url' => ['/testdata']],
                      ['label' => 'Вопросы', 'url' => ['/question']],
                      ['label' => 'Ответы', 'url' => ['/answer']],
                  ],
              ] : '') : '',
            Yii::$app->session->get('user') ? (
            ['label' => 'Психологические тесты', 'url' => ['/testing/index']]) : '',
            //['label' => 'Рекомендуемые сферы деятельности', 'url' => ['/areasofactivity/index']],
            Yii::$app->session->get('user') ? (
            ['label' => 'Рекомендации профессий', 'url' => ['/site/profresults']]) : '',
            //['label' => 'О нас', 'url' => ['/site/about']],
            //Yii::$app->session->get('user') ? (
            //['label' => 'Посчитать квадрат пифагора', 'url' => ['/site/kvadrat']]) : '',

            //['label' => 'Просмотр протестированных персон', 'url' => ['/testedperson']],
            !Yii::$app->session->get('user') ? (
                ['label' => 'Войти', 'url' => ['/authentication/login']]
            ) : (
                ['label' => Yii::$app->session->get('user')->username,
                'items' => [
                      ['label' => 'Профиль', 'url' => ['/authentication/profile']],
                      ['label' => 'Выйти', 'url' => ['/authentication/logout']],
                  ],
                ]
            )
        ],
    ]);
    NavBar::end();
    ?>
    <script>
        <?php if (Yii::$app->session->get('user')) {
            echo 'console.log("setting userID");';
            echo 'localStorage.setItem("userId", '.Yii::$app->session->get('user')->id.');';
        } else {
            echo 'console.log("unsetting userID");';
            echo 'localStorage.removeItem("userId");';
        }?>
    </script>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
