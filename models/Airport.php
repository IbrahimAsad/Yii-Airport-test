<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "airport".
 *
 * @property integer $airport_id
 * @property string $airport_name
 * @property string $airport_code
 * @property string $country
 * @property string $city
 */
class Airport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'airport';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['airport_id', 'airport_name', 'airport_code', 'country', 'city'], 'required'],
            [['airport_id'], 'integer'],
            [['airport_name', 'airport_code'], 'string', 'max' => 200],
            [['country', 'city'], 'string', 'max' => 50],
        ];
    }

    public static $primaryKey='airport_code';
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'airport_id' => 'Airport ID',
            'airport_name' => 'Airport Name',
            'airport_code' => 'Airport Code',
            'country' => 'Country',
            'city' => 'City',
        ];
    }

    /**
     * @inheritdoc
     * @return AirportQuery the active query used by this AR class.
     */
     
}
