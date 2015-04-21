<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $pk
 * @property string $palabra
 * @property integer $frecuencia
 * @property integer $idioma_fk
 *
 * @property Idioma $idiomaFk
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['palabra', 'idioma_fk'], 'required'],
            [['frecuencia', 'idioma_fk'], 'integer'],
            [['palabra'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'palabra' => 'Palabra',
            'frecuencia' => 'Frecuencia',
            'idioma_fk' => 'Idioma',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdiomaFk()
    {
        return $this->hasOne(Idioma::className(), ['pk' => 'idioma_fk']);
    }
}
