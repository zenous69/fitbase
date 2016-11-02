<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


/**
 * Spot Information Model retrieves Spot data from DB
 */

class Coordinate extends ActiveRecord
{
    /**
     * Coordinate has latitude and longitude
     */

    public static function tableName()
    {
        return 'coordinate';
    }
}

class Type extends ActiveRecord
{
    /**
     * Coordinate has latitude and longitude
     */

    public static function tableName()
    {
        return 'type';
    }
}


class Spot extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spot';
    }

    public function getCoordinate()
    {
        return $this->hasOne(Coordinate::className(), ['id' => 'coordinate_id']);
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    public function showById($id)
    {

        $spot = Spot::findOne($id);

        return $spot;
    }

    public function addNew($title, $type_id, $description, $latitude, $longitude)
    {
        $spot = new Spot();

        $values = [
            'title' => $title,
            'type_id' => $type_id,
            'description' => $description,
            'latitude' => $latitude,
            'longitude' => $longitude
        ];

        $spot->attributes =  $values;

        $spot->save();

        return $spot;
    }


    //var_dump($Spot);



}
