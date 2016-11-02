<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\widgets\SpotMap;

$this->title = 'Fitbase: Fitness spot locator';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-about">

    <h1><?= Html::encode($model->title) ?></h1>

    <h2>Категория: <?= Html::encode($model->type->title_multiple) ?></h2>
    <p><?= Html::encode($model->description) ?></p>

    <table>
        <thead>
        </thead>
        <tbody>
            <tr>
                <td>
                    Latitude
                </td>
                <td>
                    <?= Html::encode($model->coordinate->latitude); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Longitude
                </td>
                <td>
                    <?= Html::encode($model->coordinate->longitude); ?>
                </td>
            </tr>
        </tbody>
    </table>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 500px;
        }
    </style>



    <?=
    SpotMap::widget([
        'type' => 'map-single',
        'coordinate' => $model->coordinate
    ]);
    ?>

   <pre>  <?=  var_dump($model);  ?> </pre>



</div>



<p>Source file:</p>
<code><?= __FILE__ ?></code>