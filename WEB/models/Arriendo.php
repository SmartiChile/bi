<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "arriendo".
 *
 * @property integer $pk
 * @property string $titulo
 * @property string $descripcion
 * @property string $direccion
 * @property string $telefono
 * @property string $email
 * @property string $nombre_contacto
 * @property string $imagen1
 * @property string $imagen2
 * @property string $imagen3
 * @property integer $idioma_fk
 *
 * @property Idioma $idiomaFk
 */
class Arriendo extends \yii\db\ActiveRecord
{
    public $image1;
    public $image2;
    public $image3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'arriendo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'direccion', 'telefono', 'email', 'nombre_contacto', 'idioma_fk'], 'required'],
            [['telefono'], 'string', 'min'=>7, 'max'=>8],
            [['email'], 'email'],
            [['descripcion'], 'string', 'min'=>1200],
            [['idioma_fk'], 'integer'],
            [['imagen1', 'imagen2', 'imagen3'], 'default', 'value' => NULL],
            [['titulo', 'direccion', 'telefono', 'email', 'nombre_contacto', 'imagen1', 'imagen2', 'imagen3'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'titulo' => 'Título',
            'descripcion' => 'Descripción',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'email' => 'E-mail',
            'nombre_contacto' => 'Nombre Contacto',
            'imagen1' => 'Imagen 1',
            'imagen2' => 'Imagen 2',
            'imagen3' => 'Imagen 3',
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

    public function getImagen1File() 
    {
        return isset($this->imagen1) ? 'images/arriendos/' . $this->imagen1 : null;
    }

    public function getImagen1Url() 
    {
        $img = isset($this->imagen1) ? $this->imagen1 : 'default_img.jpg';
        return '/images/arriendos/' . $img;
    }

    public function uploadImagen1() {
        $image = UploadedFile::getInstance($this, 'imagen1');
 
        if (empty($image)) {
            return false;
        }
 
        // store the source file name
        $this->imagen1 = $image->name;
        $ext = end((explode(".", $image->name)));
 
        // generate a unique file name
        $this->imagen1 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image;
    }

    public function deleteImagen1() {
        $file = $this->getImagen1File();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->imagen1 = null;
 
        return true;
    }

    public function getImagen2File() 
    {
        return isset($this->imagen2) ? 'images/arriendos/' . $this->imagen2 : null;
    }

    public function getImagen2Url() 
    {
        $img = isset($this->imagen2) ? $this->imagen2 : 'default_img.jpg';
        return '/images/arriendos/' . $img;
    }

    public function uploadImagen2() {
        $image = UploadedFile::getInstance($this, 'imagen2');
 
        if (empty($image)) {
            return false;
        }
 
        // store the source file name
        $this->imagen2 = $image->name;
        $ext = end((explode(".", $image->name)));
 
        // generate a unique file name
        $this->imagen2 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image;
    }

    public function deleteImagen2() {
        $file = $this->getImagen2File();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->imagen2 = null;
 
        return true;
    }

    public function getImagen3File() 
    {
        return isset($this->imagen3) ? 'images/arriendos/' . $this->imagen3 : null;
    }

    public function getImagen3Url() 
    {
        $img = isset($this->imagen3) ? $this->imagen3 : 'default_img.jpg';
        return '/images/arriendos/' . $img;
    }

    public function uploadImagen3() {
        $image = UploadedFile::getInstance($this, 'imagen3');
 
        if (empty($image)) {
            return false;
        }
 
        // store the source file name
        $this->imagen3 = $image->name;
        $ext = end((explode(".", $image->name)));
 
        // generate a unique file name
        $this->imagen3 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image;
    }

    public function deleteImagen3() {
        $file = $this->getImagen3File();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->imagen3 = null;
 
        return true;
    }
}
