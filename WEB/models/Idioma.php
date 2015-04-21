<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "idioma".
 *
 * @property integer $pk
 * @property string $nombre
 * @property string $abreviacion
 * @property integer $posicion
 * @property integer $activo
 *
 * @property Arriendo[] $arriendos
 * @property Circuito[] $circuitos
 * @property Evento[] $eventos
 * @property Noticia[] $noticias
 * @property Oferta[] $ofertas
 * @property Patrimonio[] $patrimonios
 * @property Servicio[] $servicios
 * @property Tag[] $tags
 * @property Tienda[] $tiendas
 * @property Vitrina[] $vitrinas
 */
class Idioma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'idioma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'abreviacion', 'posicion', 'activo'], 'required'],
            [['posicion', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['abreviacion'], 'string', 'max' => 5],
            [['posicion'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'nombre' => 'Nombre',
            'abreviacion' => 'Abreviación',
            'posicion' => 'Posición',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArriendos()
    {
        return $this->hasMany(Arriendo::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCircuitos()
    {
        return $this->hasMany(Circuito::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Oferta::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatrimonios()
    {
        return $this->hasMany(Patrimonio::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicios()
    {
        return $this->hasMany(Servicio::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiendas()
    {
        return $this->hasMany(Tienda::className(), ['idioma_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVitrinas()
    {
        return $this->hasMany(Vitrina::className(), ['idioma_fk' => 'pk']);
    }
}
