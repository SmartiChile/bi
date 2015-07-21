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
    public $adj;
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
            [['telefono'], 'string', 'max'=>8, 'min'=>7],
            [['email'], 'email'],
            [['fechayhora'], 'safe'],
            [['nombre', 'email', 'adjunto'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15, 'min'=>7],
            [['tipo'], 'string', 'max' => 1],
            [['adjunto'], 'file', 'extensions'=>'pdf, doc, docx'],
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

     public function getAdjuntoFile() 
    {
        return isset($this->adjunto) ? 'images/adjunto/' . $this->adjunto : null;
    }

    public function getAdjuntoUrl() 
    {
        $ad = isset($this->adjunto) ? $this->adjunto : 'default_pfg.pdf';
        return '/images/adjunto/' . $ad;
    }

    public function uploadAdjunto() {
        $adj = UploadedFile::getInstance($this, 'adjunto');
 
        if (empty($adj)) {
            return false;
        }
 
        // store the source file name
        $this->adjunto = $adj->name;
        $ext = end((explode(".", $adj->name)));
 
        // generate a unique file name
        $this->adjunto = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $adj;
    }

    public function adjuntoIcono() {
        $file = $this->getAdjuntoFile();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->adjunto = null;
 
        return true;
    }

}
