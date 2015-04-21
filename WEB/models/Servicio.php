<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "servicio".
 *
 * @property integer $pk
 * @property string $nombre
 * @property string $icono
 * @property integer $idioma_fk
 *
 * @property Idioma $idiomaFk
 * @property TiendaXServicio[] $tiendaXServicios
 */
class Servicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'idioma_fk'], 'required'],
            [['idioma_fk'], 'integer'],
            [['icono'], 'default', 'value' => NULL],
            [['nombre', 'icono'], 'string', 'max' => 255]
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
            'icono' => 'Icono',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiendaxservicios()
    {
        return $this->hasMany(Tiendaxservicio::className(), ['servicio_fk' => 'pk']);
    }

    public function getIconoFile() 
    {
        return isset($this->icono) ? 'images/servicios/' . $this->icono : null;
    }

    public function getIconoUrl() 
    {
        $icon = isset($this->icono) ? $this->icono : 'default_ico.jpg';
        return '/images/servicios/' . $icon;
    }

    public function uploadIcono() {
        $ico = UploadedFile::getInstance($this, 'icono');
 
        if (empty($ico)) {
            return false;
        }
 
        // store the source file name
        $this->icono = $ico->name;
        $ext = end((explode(".", $ico->name)));
 
        // generate a unique file name
        $this->icono = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $ico;
    }

    public function deleteIcono() {
        $file = $this->getIconoFile();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->icono = null;
 
        return true;
    }
}
