<?php
/**
 * SpotMap Widget Renders a GoogleMap for a single spot
 * Author: Sneer
 * Date: 05-Sep-16
 * Time: 9:52 PM
 * Available types:
 *      map-single
 *      map-multiple
 */

namespace common\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class SpotMap extends Widget
{
    public $type;
    public $coordinate;

    public function init()
    {
        parent::init();
        if ($this->type === null) {
            throw new \yii\web\HttpException(503, 'SpotMap Widget has no type specified');
        }


    }

    public function run()
    {
        if ($this->type === 'map-single') {
            return $this->render('map-single', [
                'coordinate' => $this->coordinate
            ]);

        } elseif  ($this->type === 'map-multiple') {
            return $this->render('map-multiple', [
                'coordinate' => $this->coordinate
            ]);
        }
    }
}

