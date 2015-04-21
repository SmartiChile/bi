<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ruta".
 *
 * @property integer $pk
 * @property integer $usuario_fk
 * @property integer $terminada
 *
 * @property Usuario $usuarioFk
 * @property RutaContenido[] $rutaContenidos
 */
class Ruta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_fk', 'terminada'], 'required'],
            [['usuario_fk', 'terminada'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'usuario_fk' => 'Usuario Fk',
            'terminada' => 'Terminada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioFk()
    {
        return $this->hasOne(Usuario::className(), ['pk' => 'usuario_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutaContenidos()
    {
        return $this->hasMany(RutaContenido::className(), ['ruta_fk' => 'pk']);
    }
}
