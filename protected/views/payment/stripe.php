<div class="col-md-4 col-md-offset-4">
    <h1 class="page-header">Stripe Payment</h1>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'payment-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('novalidate'=>1)
    )); ?>

    <div id="payment-errors"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'payment_fullname'); ?>
        <?php echo $form->textField($model, 'payment_fullname', array('class' => 'card-fullname form-control', 'autocomplete' => 'off')); ?>
    </div>

    <div class="form-group">
        <label>Card Number</label>
        <input type="text" size="20" autocomplete="off" class="card-number form-control" pattern="\d*">
    </div>

    <div class="form-group">
        <label>CVC Number</label>
        <input type="text" size="4" autocomplete="off" class="card-cvc form-control">
    </div>

    <div class="form-group">
        <label>Expiration (MM/YYYY)</label>
        <?php echo CHtml::dropDownList(null, '', Shared::$months, array('class' => 'card-expiry-month form-control')); ?>
        <span> / </span>
        <?php echo CHtml::dropDownList(null, '', Shared::getExpYearArray(11), array('class' => 'card-expiry-year form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'payment_email'); ?>
        <?php echo $form->textField($model, 'payment_email', array('class' => 'card-email form-control', 'autocomplete' => 'off')); ?>
    </div>

    <?php echo CHtml::submitButton('Pay $35', array('class' => 'btn btn-primary btn-block', 'id' => 'submitBtn')); ?>

    <?php $this->endWidget(); ?>

</div>