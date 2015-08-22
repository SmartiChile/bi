<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "evento".
 *
 * @property integer $pk
 * @property string $titulo
 * @property string $imagen
 * @property string $descripcion
 * @property string $inicio
 * @property string $fin
 * @property integer $idioma_fk
 *
 * @property Idioma $idiomaFk
 */
class Evento extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'inicio', 'fin'], 'required'],
            [['descripcion'], 'string'],
            [['inicio', 'fin'], 'safe'],
            [['idioma_fk'], 'integer'],
            [['imagen'], 'default', 'value' => NULL],
            [['titulo', 'imagen'], 'string', 'max' => 255]
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
            'imagen' => 'Imagen',
            'descripcion' => 'Descripción',
            'inicio' => 'Inicio',
            'fin' => 'Fin',
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

    public function getImagenFile() 
    {
        return isset($this->imagen) ? 'images/eventos/' . $this->imagen : null;
    }

    public function getImagenUrl() 
    {
        $img = isset($this->imagen) ? $this->imagen : 'default_img.jpg';
        return '/images/eventos/' . $img;
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
}
