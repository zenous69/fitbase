<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Load Spot Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Add .csv file with data to update</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($model, 'dataFile')->fileInput() ?>

            <button>Submit</button>

            <?php ActiveForm::end() ?>
        </div>

        <?php if (isset($path)) {
            echo('<pre> File uploaded as: ' . $path . '</pre>');
        }?>

        <pre><?php var_dump($model->fullPath); ?> </pre>
        <pre><?php var_dump($report); ?> </pre>

    </div>
</div>
