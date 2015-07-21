<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "patrimonio".
 *
 * @property integer $pk
 * @property string $nombre
 * @property string $descripcion
 * @property string $direccion
 * @property double $coordenadas
 * @property string $imagen
 * @property integer $circuito_fk
 * @property integer $idioma_fk
 *
 * @property Circuito $circuitoFk
 * @property Idioma $idiomaFk
 */
class Patrimonio extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patrimonio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'direccion', 'coordenadas', 'idioma_fk'], 'required'],
            [['descripcion'], 'string', 'min'=>100, 'max'=>3000],
            [['circuito_fk', 'idioma_fk'], 'integer'],
            [['imagen'], 'default', 'value' => NULL],
            [['nombre', 'direccion', 'imagen'], 'string', 'max' => 255]
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
            'descripcion' => 'Descripción',
            'direccion' => 'Dirección',
            'coordenadas' => 'Coordenadas',
            'imagen' => 'Imagen',
            'circuito_fk' => 'Circuito',
            'idioma_fk' => 'Idioma',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCircuitoFk()
    {
        return $this->hasOne(Circuito::className(), ['pk' => 'circuito_fk']);
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
        return isset($this->imagen) ? 'images/patrimonio/' . $this->imagen : null;
    }

    public function getImagenUrl() 
    {
        $img = isset($this->imagen) ? $this->imagen : 'default_img.jpg';
        return '/images/patrimonio/' . $img;
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
