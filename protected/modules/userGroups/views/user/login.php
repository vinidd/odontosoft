<?php
$this->breadcrumbs = array(
    'Login',
);
?>
<div class="logbg"> 
<div id="userGroups-container" style="padding-top: 80px;">
    <?php if (isset(Yii::app()->request->cookies['success'])): ?>
        <div class="info">
            <?php echo Yii::app()->request->cookies['success']->value; ?>
            <?php unset(Yii::app()->request->cookies['success']); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="info">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('mail')): ?>
        <div class="info">
            <?php echo Yii::app()->user->getFlash('mail'); ?>
        </div>
    <?php endif; ?>

    <div class="form center">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'login-form',
            //'type' => 'inline',
            'enableAjaxValidation' => false,
            'focus' => array($model, 'username'),
        ));
        ?>
        <?php echo $form->textFieldRow($model, 'username'); ?>
        <?php echo $form->passwordFieldRow($model, 'password'); ?>
        <?php echo $form->checkBoxRow($model, 'rememberMe'); ?>
        <br>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'inverse',
            'label' => 'Login',
        ));
        ?>

        <?php $this->endWidget(); ?>
    </div><!-- form -->
</div>
</div>