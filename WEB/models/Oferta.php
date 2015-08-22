<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oferta".
 *
 * @property integer $pk
 * @property integer $tienda_fk
 * @property double $descuento
 * @property string $descripcion
 * @property integer $idioma_fk
 * @property string $inicio
 * @property string $termino
 *
 * @property Tienda $tiendaFk
 * @property Idioma $idiomaFk
 */
class Oferta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oferta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tienda_fk', 'descuento', 'descripcion', 'idioma_fk', 'inicio', 'termino'], 'required'],
            [['tienda_fk', 'idioma_fk'], 'integer'],
            [['descuento'], 'number'],
            [['descripcion'], 'string', 'min'=>30],
            [['inicio', 'termino'], 'safe']
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
            'descuento' => 'Descuento',
            'descripcion' => 'Descripción',
            'idioma_fk' => 'Idioma',
            'inicio' => 'Inicio',
            'termino' => 'Término',
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
    public function getIdiomaFk()
    {
        return $this->hasOne(Idioma::className(), ['pk' => 'idioma_fk']);
    }
}
