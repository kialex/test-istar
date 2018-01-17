<?php

/* @var $this yii\web\View */
/* @var $phoneBook app\models\PhoneBook */

use yii\helpers\Html;

$this->title = 'Create new contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-book-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?= $this->render('elements/_form', ['phoneBook' => $phoneBook]); ?>
        </div>
    </div>
</div>