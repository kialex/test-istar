<?php

/* @var $this yii\web\View */
/* @var $filter app\models\PhoneBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap\Html;
use yii\grid\GridView;
use app\models\PhoneBook;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;

$this->title = 'List of contacts';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="phone-book-list">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
            <?= GridView::widget([
                'dataProvider'  => $dataProvider,
                'filterModel'   => $filter,
                'columns'       => [
                    // number
                    [
                        'class'         => SerialColumn::className(),
                    ],
                    // first name
                    [
                        'attribute'     => 'first_name',
                    ],
                    // last name
                    [
                        'attribute'     => 'last_name',
                    ],
                    // patronymic
                    [
                        'attribute'     => 'patronymic',
                    ],
                    // phone number(s)
                    [
                        'attribute'     => 'phone',
                        'format'        => 'raw',
                        'value'         => function(PhoneBook $phoneBook) {
                            return Html::ul($phoneBook->phone);
                        },
                    ],
                    // actions column
                    [
                        'class'             => ActionColumn::className(),
                        'template'          => '<div class="action-links">{update} {delete}</div>',
                    ]
                ],
            ]); ?>
        </div>
    </div>
</div>


