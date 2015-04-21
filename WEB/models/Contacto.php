<?php

namespace app\models;

use Yii;

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
}
