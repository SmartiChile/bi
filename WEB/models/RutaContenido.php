<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ruta_contenido".
 *
 * @property integer $pk
 * @property integer $ruta_fk
 * @property integer $tienda_fk
 *
 * @property Ruta $rutaFk
 * @property Tienda $tiendaFk
 */
class RutaContenido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruta_contenido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruta_fk', 'tienda_fk'], 'required'],
            [['ruta_fk', 'tienda_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'ruta_fk' => 'Ruta',
            'tienda_fk' => 'Tienda',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutaFk()
    {
        return $this->hasOne(Ruta::className(), ['pk' => 'ruta_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiendaFk()
    {
        return $this->hasOne(Tienda::className(), ['pk' => 'tienda_fk']);
    }
}
