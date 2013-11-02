<br>
<?php
$this->storePreviousLink = CHtml::link("<i class='icon-backward'></i>", array(Yii::app()->controller->id . "/" . Yii::app()->controller->action->id, 'month' => $this->previousMonth, 'year' => $this->yearPreviousMonth));
$this->storeNextLink = CHtml::link("<i class='icon-forward'></i>", array(Yii::app()->controller->id . "/" . Yii::app()->controller->action->id, 'month' => $this->nextMonth, 'year' => $this->yearNextMonth));
echo $this->printStartForm();
//echo $this->storePreviousLink;
//echo $this->printControlMenu();
?>
<div class='pointer'>
    <a href="<?php echo Yii::app()->request->baseUrl . "/" . Yii::app()->controller->id . "/" . Yii::app()->controller->action->id . "?month=" . $this->previousMonth . "&year=" . $this->yearPreviousMonth; ?>">
        <span class='left'>
            <i class='icon-backward icon-2x'></i>
        </span>
    </a>

    <div class='center'>
        <span><?php echo $this->title; ?></span>
    </div>

    <a href="<?php echo Yii::app()->request->baseUrl . "/" . Yii::app()->controller->id . "/" . Yii::app()->controller->action->id . "?month=" . $this->nextMonth . "&year=" . $this->yearNextMonth; ?>">
        <span class='right'>
            <i class='icon-forward icon-2x'></i>
        </span>
    </a>
</div>

<?php
//echo $this->storeNextLink;
echo $this->printCloseForm();
echo $this->printCalendar();
?>


