<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "local".
 *
 * @property integer $pk
 * @property string $direccion
 * @property string $coordenadas
 *
 * @property Tienda[] $tiendas
 */
class Local extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'local';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['direccion', 'coordenadas'], 'required'],
            [['direccion', 'coordenadas'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'direccion' => 'Dirección',
            'coordenadas' => 'Coordenadas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiendas()
    {
        return $this->hasMany(Tienda::className(), ['local_fk' => 'pk']);
    }
}
