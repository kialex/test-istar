<?php

/* @var $this yii\web\View */
/* @var $phoneBook app\models\PhoneBook */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<?php $form = ActiveForm::begin(['id' => 'phone-book-form']); ?>

    <?= $form->field($phoneBook, 'first_name')->textInput([
        'autofocus' => true,
        'placeholder' => 'Enter your first name here...',
    ]); ?>

    <?= $form->field($phoneBook, 'last_name')->textInput(['placeholder' => 'Enter your last name here...']); ?>

    <?= $form->field($phoneBook, 'patronymic')->textInput(['placeholder' => 'Enter your patronymic here...']); ?>


    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.phone-number-container',
        'widgetItem' => '.item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-item',
        'deleteButton' => '.remove-item',
        'model' => $phoneBook,
        'formId' => 'phone-book-form',
        'formFields' => ['phone',],
    ]); ?>
        <div class="panel panel-default"><!-- widgetBody -->
            <div class="panel-heading">
                <h3 class="panel-title pull-left">Phone number(s)</h3>
                <div class="pull-right">
                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body phone-number-container">
                <?php if (is_array($phoneBook->phone) && !empty($phoneBook->phone)): ?>
                    <?php foreach ($phoneBook->phone as $phoneNumber): ?>
                    <div class="item">
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        <?= $form->field($phoneBook, 'phone[]')->textInput(['placeholder' => 'Enter your last name here...', 'value' => $phoneNumber]); ?>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div class="item">
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        <?= $form->field($phoneBook, 'phone[]')->textInput(['placeholder' => 'Enter your last name here...']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']); ?>
    </div>

<?php ActiveForm::end(); ?>
