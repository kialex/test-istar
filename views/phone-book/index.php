<?php
/**
 * 2015-2018 Jaguar-Team
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@jaguar-team.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade JaguarTeam to newer
 * versions in the future. If you wish to customize JaguarTeam for your
 * needs please refer to http://www.jaguar-team.com for more information.
 *
 * @author    JaguarTeam LC <contact@jaguar-team.com>
 * @copyright 2015-2018 JaguarTeam LC
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

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


