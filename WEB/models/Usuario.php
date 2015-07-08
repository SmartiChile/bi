<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $pk
 * @property string $username
 * @property string $password
 * @property string $nombre
 * @property integer $rol
 *
 * @property Favorito[] $favoritos
 * @property Ruta[] $rutas
 */
class Usuario extends \yii\db\ActiveRecord
{
    public $password_hash;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nombre', 'rol'], 'required'],
            [['rol'], 'integer'],
            ['username', 'email', 'message'=>'El Nombre de usuario no es una dirección de correo electrónico válida.'],
            [['username', 'password', 'nombre', 'token'], 'string', 'max' => 255],
            [['username'], 'unique', 'targetAttribute' => ['username'], 'message' => 'El nombre de usuario ya se encuentra registrado.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk' => 'Pk',
            'username' => 'Usuario',
            'password' => 'Password',
            'nombre' => 'Nombre',
            'rol' => 'Rol',
            'token' => 'token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['usuario_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutas()
    {
        return $this->hasMany(Ruta::className(), ['usuario_fk' => 'pk']);
    }

    public function beforeSave($insert) {
        if($this->isNewRecord)
            if(isset($this->password)) 
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
        return parent::beforeSave($insert);
    }
}
