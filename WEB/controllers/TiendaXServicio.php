<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tiendaxservicio".
 *
 * @property integer $pk
 * @property integer $tienda_fk
 * @property integer $servicio_fk
 *
 * @property Tienda $tiendaFk
 * @property Servicio $servicioFk
 */
class Tiendaxservicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tiendaxservicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tienda_fk', 'servicio_fk'], 'required'],
            [['tienda_fk', 'servicio_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'tienda_fk' => 'Tienda',
            'servicio_fk' => 'Servicio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiendaFk()
    {
        return $this->hasOne(Tienda::className(), ['pk' => 'tienda_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicioFk()
    {
        return $this->hasOne(Servicio::className(), ['pk' => 'servicio_fk']);
    }
}
