<?php

namespace app\models;


use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "circuito".
 *
 * @property integer $pk
 * @property string $nombre
 * @property string $icono
 * @property string $color
 * @property string $descripcion
 * @property string $imagen
 * @property integer $posicion
 * @property integer $idioma_fk
 *
 * @property Idioma $idiomaFk
 * @property Patrimonio[] $patrimonios
 * @property Tienda[] $tiendas
 */
class Circuito extends \yii\db\ActiveRecord
{

    public $image;
    public $ico;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'circuito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'color', 'descripcion', 'posicion', 'idioma_fk'], 'required'],
            [['descripcion'], 'string', 'max'=>1500],
            [['posicion', 'idioma_fk'], 'integer'],
            [['nombre', 'icono', 'imagen', 'color'], 'string', 'max' => 255],
            [['imagen', 'icono'], 'safe'],
            [['imagen', 'icono'], 'file', 'extensions'=>'jpg, gif, png'],
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
            'color' => 'Color',
            'descripcion' => 'Descripción',
            'imagen' => 'Imagen',
            'posicion' => 'Posición',
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
    public function getPatrimonios()
    {
        return $this->hasMany(Patrimonio::className(), ['circuito_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiendas()
    {
        return $this->hasMany(Tienda::className(), ['circuito_fk' => 'pk']);
    }

    public function getImagenFile() 
    {
        return isset($this->imagen) ? 'images/circuitos/' . $this->imagen : null;
    }

    public function getImagenUrl() 
    {
        $img = isset($this->imagen) ? $this->imagen : 'default_img.jpg';
        return '/images/circuitos/' . $img;
    }

    public function uploadImagen() {
        $image = UploadedFile::getInstance($this, 'imagen');
 
        if (empty($image)) {
            return false;
        }
 
        // store the source file name
        $this->imagen = $image->name;
        $ext = end((explode(".", $image->name)));
 
        // generate a unique file name
        $this->imagen = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image;
    }

    public function deleteImagen() {
        $file = $this->getImagenFile();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->imagen = null;
 
        return true;
    }

    public function getIconoFile() 
    {
        return isset($this->icono) ? 'images/circuitos/' . $this->icono : null;
    }

    public function getIconoUrl() 
    {
        $icon = isset($this->icono) ? $this->icono : 'default_ico.jpg';
        return '/images/circuitos/' . $icon;
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
