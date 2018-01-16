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
/* @var $phoneBook app\models\ContactForm */

use yii\helpers\Html;

$this->title = 'Update contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-book-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?= $this->render('elements/_form', ['phoneBook' => $phoneBook]); ?>
        </div>
    </div>
</div>