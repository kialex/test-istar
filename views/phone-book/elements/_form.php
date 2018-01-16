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
/* @var $phoneBook app\models\PhoneBook */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

?>

<?php $this->registerJs("
$(document).ready(function(){
    $('#add-another-number').click(function(event) {
        event.preventDefault();
        console.log($('#phone-book-form').yiiActiveForm);
        $('#phone-book-form').yiiActiveForm('remove', 'PhoneBook[first_name]');
    });
});
"); ?>

<?php $form = ActiveForm::begin(['id' => 'phone-book-form']); ?>

    <?= $form->field($phoneBook, 'first_name')->textInput([
        'autofocus' => true,
        'placeholder' => 'Enter your first name here...',
    ]); ?>

    <?= $form->field($phoneBook, 'last_name')->textInput(['placeholder' => 'Enter your last name here...']); ?>

    <?= $form->field($phoneBook, 'patronymic')->textInput(['placeholder' => 'Enter your patronymic here...']); ?>

    <div class="phone-number-list">
        <div class="phone-number-container">
            <?= $form->field($phoneBook, 'phone[]')->textInput(['placeholder' => 'Enter your last name here...']); ?>
        </div>
    </div>

    <div class="text-right">
        <?= Html::a('Add another phone number', '#', ['id' => 'add-another-number']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']); ?>
    </div>

<?php ActiveForm::end(); ?>
