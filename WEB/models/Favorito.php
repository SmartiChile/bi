<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorito".
 *
 * @property integer $usuario_fk
 * @property integer $tienda_fk
 *
 * @property Usuario $usuarioFk
 * @property Tienda $tiendaFk
 */
class Favorito extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_fk', 'tienda_fk'], 'required'],
            [['usuario_fk', 'tienda_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario_fk' => 'Usuario',
            'tienda_fk' => 'Tienda',
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
    public function getTiendaFk()
    {
        return $this->hasOne(Tienda::className(), ['pk' => 'tienda_fk']);
    }
}
