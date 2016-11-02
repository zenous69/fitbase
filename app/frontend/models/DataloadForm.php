<?php
namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use frontend\models\Spot;
use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\ARImportStrategy;
use ruskid\csvimporter\MultipleImportStrategy;

/**
 * Signup form
 */

class DataloadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $dataFile;
    public $fullPath;
    public $result;

    public function rules()
    {
        return [
            [['dataFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv, txt'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->fullPath = ('uploads/' . $this->dataFile->baseName . '.' . $this->dataFile->extension);
            $this->dataFile->saveAs($this->fullPath);
            return true;
        } else {
            return false;
        }
    }

    public function import()
    {

        /**
         *  File format: title;description;latitude;longitude;type_id;
         */


        $this->fullPath;

        $importer = new CSVImporter;

        $importer->setData(new CSVReader([
            'filename' => $this->fullPath,
            'fgetcsvOptions' => [
                'delimiter' => ';'
            ]
        ]));

       //Import Active Records (Slow, but more reliable). Will return array of primary keys
        $primaryKeys = $importer->import(new ARImportStrategy([
            'className' => Spot::className(),
            'configs' => [
                [
                    'attribute' => 'title',
                    'value' => function($line) {
                        return $line[0];
                    },
                ],
                [
                    'attribute' => 'type_id',
                    'value' => function($line) {
                        return $line[4];
                    },
                ],
                [
                    'attribute' => 'description',
                    'value' => function($line) {
                        return $line[1];
                    },
                ],
                [
                    'attribute' => 'coordinate_id',
                    'value' => function($line) {
                        $latitude = $line[2];
                        $longitude = $line[3];

                        //Checking if such coordinate exists
                        



                        return $coordinate_id;
                    },
                ],
            ],
        ]));

        return $primaryKeys;

    }


}
