<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "contacto".
 *
 * @property integer $pk
 * @property string $nombre
 * @property string $telefono
 * @property string $email
 * @property string $mensaje
 * @property string $ip
 * @property string $fechayhora
 * @property string $tipo
 * @property string $adjunto
 */
class Contacto extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'telefono', 'email', 'mensaje', 'tipo'], 'required'],
            [['mensaje'], 'string'],
            [['fechayhora'], 'safe'],
            [['nombre', 'telefono', 'email', 'adjunto'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
            [['tipo'], 'string', 'max' => 1]
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
            'telefono' => 'Teléfono',
            'email' => 'Email',
            'mensaje' => 'Mensaje',
            'ip' => 'Ip',
            'fechayhora' => 'Fecha y hora',
            'tipo' => 'Tipo',
            'adjunto' => 'Archivo Adjunto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getImagenFile() 
    {
        return isset($this->imagen) ? 'images/adjunto/' . $this->imagen : null;
    }

    public function getImagenUrl() 
    {
        $img = isset($this->imagen) ? $this->imagen : 'default.pdf';
        return '/images/adjunto/' . $img;
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


}
