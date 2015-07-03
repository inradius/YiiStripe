<?php

$this->pageTitle = app()->name . ' - Payments';
$this->breadcrumbs = array(
    'Payments',
);

$this->menu = array(
    array('label'=>'List Payments', 'url'=>array('index'), 'active' => true),
    array('label' => 'Create Payment', 'url' => array('create')),
);

$columns = array(
    array('id' => 'selected', 'class' => 'CCheckBoxColumn'),
    array('filter' => false, 'name' => 'payment_fullname', 'header' => 'Name'),
    array('name' => 'payment_email', 'header' => 'Email'),
    array('name' => 'payment_created', 'header' => 'Payment Date', 'type' => 'raw', 'value' => 'date("M d, Y g:i:s A", $data->payment_created)'),
    array('name' => 'payment_amount', 'header' => 'Payment Amount', 'type' => 'raw', 'value' => '"$".($data->payment_amount)/100'),
);

$dataArray = array(
    'id'                => 'payment-gridview',
    'pager'             => array(
        'class'         => 'app.widgets.LinkPager.LinkPager',
        'prevPageLabel' => '&laquo;',
        'nextPageLabel' => '&raquo;',
        'cssFile'       => false,
        'htmlOptions'   => array(
            'class'     => 'pagination pagination-sm',
    )),
    'pagerCssClass' => 'image-pagination',
    'filter'            => $model,
    'filterPosition'    => 'hide',
    'filterSelector'    => '#email-filter',
    'columns'           => $columns,
    'template'          => "{items}\n{pager}",
    'dataProvider'      => $dataProvider,
    'itemsCssClass'     => 'table table-bordered table-striped table-hover',
    'selectableRows'    => 2,
);
?>

<div class="col-md-12">
    <h1 class="page-header">Payments</h1>

    <?php echo CHtml::textField('Payment[payment_email]','',array('id' => 'email-filter', 'class' => 'form-action')); ?>
    <?php $this->widget('app.widgets.GridView.GridView', $dataArray); ?>
</div>