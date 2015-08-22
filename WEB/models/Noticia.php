<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "noticia".
 *
 * @property integer $pk
 * @property string $titulo
 * @property string $descripcion
 * @property string $referencia
 * @property string $imagen
 * @property string $fecha
 * @property integer $destacada
 * @property integer $idioma_fk
 * @property integer $prensa
 *
 * @property Idioma $idiomaFk
 */
class Noticia extends \yii\db\ActiveRecord
{

    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'noticia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'descripcion', 'destacada', 'idioma_fk', 'prensa'], 'required'],
            [['descripcion'], 'string'],
            [['fecha'], 'safe'],
            [['destacada', 'idioma_fk', 'prensa'], 'integer'],
            [['imagen'], 'default', 'value' => NULL],
            [['titulo', 'referencia', 'imagen'], 'string', 'max' => 255]
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
            'referencia' => 'Referencia',
            'imagen' => 'Imagen',
            'fecha' => 'Fecha',
            'destacada' => 'Destacada',
            'idioma_fk' => 'Idioma',
            'prensa' => 'Prensa',
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
        return isset($this->imagen) ? 'images/noticias/' . $this->imagen : null;
    }

    public function getImagenUrl() 
    {
        $img = isset($this->imagen) ? $this->imagen : 'default_img.jpg';
        return '/images/noticias/' . $img;
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
