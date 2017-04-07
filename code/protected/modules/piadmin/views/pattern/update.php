<?php
/* @var $this PatternController */
/* @var $model Pattern */

$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pattern', 'url'=>array('index')),
	array('label'=>'Create Pattern', 'url'=>array('create')),
	array('label'=>'View Pattern', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pattern', 'url'=>array('admin')),
);
?>

<h1>Update Pattern <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>