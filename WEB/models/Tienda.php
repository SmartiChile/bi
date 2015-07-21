<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "tienda".
 *
 * @property integer $pk
 * @property string $nombre
 * @property string $descripcion
 * @property string $numeracion
 * @property double $rating
 * @property string $tags
 * @property string $imagen1
 * @property string $imagen2
 * @property string $imagen3
 * @property string $imagen4
 * @property string $imagen5
 * @property string $logotipo
 * @property string $telefono
 * @property string $horario
 * @property string $sitio_web
 * @property string $facebook
 * @property string $twitter
 * @property string $instagram
 * @property string $googleplus
 * @property string $pinterest
 * @property string $tripadvisor
 * @property integer $local_fk
 * @property integer $circuito_fk
 * @property integer $idioma_fk
 *
 * @property Favorito[] $favoritos
 * @property Oferta[] $ofertas
 * @property RutaContenido[] $rutaContenidos
 * @property Local $localFk
 * @property Circuito $circuitoFk
 * @property Idioma $idiomaFk
 * @property Tiendaxservicio[] $tiendaxservicios
 */
class Tienda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tienda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'telefono'], 'required'],
            [['descripcion'], 'string'],
            [['rating'], 'number'],
            [['local_fk', 'circuito_fk', 'idioma_fk'], 'integer'],
            [['imagen2', 'imagen3', 'imagen4', 'imagen5', 'horario'], 'default', 'value' => NULL],
            [['nombre', 'horario','tags', 'imagen1', 'imagen2', 'imagen3', 'imagen4', 'imagen5', 'logotipo', 'telefono', 'sitio_web', 'facebook', 'twitter', 'instagram', 'googleplus', 'pinterest', 'tripadvisor'], 'string', 'max' => 255],
            [['numeracion'], 'string', 'max' => 10]
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
            'numeracion' => 'Numeración',
            'rating' => 'Rating',
            'tags' => 'Tags',
            'imagen1' => 'Imagen 1',
            'imagen2' => 'Imagen 2',
            'imagen3' => 'Imagen 3',
            'imagen4' => 'Imagen 4',
            'imagen5' => 'Imagen 5',
            'logotipo' => 'Logotipo',
            'telefono' => 'Teléfono',
            'horario' => 'Horario',
            'sitio_web' => 'Sitio Web',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'googleplus' => 'Googleplus',
            'pinterest' => 'Pinterest',
            'tripadvisor' => 'Tripadvisor',
            'local_fk' => 'Local',
            'circuito_fk' => 'Circuito',
            'idioma_fk' => 'Idioma',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favorito::className(), ['tienda_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOfertas()
    {
        return $this->hasMany(Oferta::className(), ['tienda_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutaContenidos()
    {
        return $this->hasMany(RutaContenido::className(), ['tienda_fk' => 'pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalFk()
    {
        return $this->hasOne(Local::className(), ['pk' => 'local_fk']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiendaxservicios()
    {
        return $this->hasMany(Tiendaxservicio::className(), ['tienda_fk' => 'pk']);
    }

    public function getImagen1File() 
    {
        return isset($this->imagen1) ? 'images/tiendas/' . $this->imagen1 : null;
    }

    public function getImagen1Url() 
    {
        $img1 = isset($this->imagen1) ? $this->imagen1 : 'default_img.jpg';
        return '/images/tiendas/' . $img1;
    }

    public function uploadImagen1() {
        $image1 = UploadedFile::getInstance($this, 'imagen1');
 
        if (empty($image1)) {
            return false;
        }
 
        // store the source file name
        $this->imagen1 = $image1->name;
        $ext = end((explode(".", $image1->name)));
 
        // generate a unique file name
        $this->imagen1 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image1;
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
        return isset($this->imagen2) ? 'images/tiendas/' . $this->imagen2 : null;
    }

    public function getImagen2Url() 
    {
        $img2 = isset($this->imagen2) ? $this->imagen2 : 'default_img.jpg';
        return '/images/tiendas/' . $img2;
    }

    public function uploadImagen2() {
        $image2 = UploadedFile::getInstance($this, 'imagen2');
 
        if (empty($image2)) {
            return false;
        }
 
        // store the source file name
        $this->imagen2 = $image2->name;
        $ext = end((explode(".", $image2->name)));
 
        // generate a unique file name
        $this->imagen2 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image2;
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
        return isset($this->imagen3) ? 'images/tiendas/' . $this->imagen3 : null;
    }

    public function getImagen3Url() 
    {
        $img3 = isset($this->imagen3) ? $this->imagen3 : 'default_img.jpg';
        return '/images/tiendas/' . $img3;
    }

    public function uploadImagen3() {
        $image3 = UploadedFile::getInstance($this, 'imagen3');
 
        if (empty($image3)) {
            return false;
        }
 
        // store the source file name
        $this->imagen3 = $image3->name;
        $ext = end((explode(".", $image3->name)));
 
        // generate a unique file name
        $this->imagen3 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image3;
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

    public function getImagen4File() 
    {
        return isset($this->imagen4) ? 'images/tiendas/' . $this->imagen4 : null;
    }

    public function getImagen4Url() 
    {
        $img4 = isset($this->imagen4) ? $this->imagen4 : 'default_img.jpg';
        return '/images/tiendas/' . $img4;
    }

    public function uploadImagen4() {
        $image4 = UploadedFile::getInstance($this, 'imagen4');
 
        if (empty($image4)) {
            return false;
        }
 
        // store the source file name
        $this->imagen4 = $image4->name;
        $ext = end((explode(".", $image4->name)));
 
        // generate a unique file name
        $this->imagen4 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image4;
    }

    public function deleteImagen4() {
        $file = $this->getImagen4File();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->imagen4 = null;
 
        return true;
    }

    public function getImagen5File() 
    {
        return isset($this->imagen5) ? 'images/tiendas/' . $this->imagen5 : null;
    }

    public function getImagen5Url() 
    {
        $img5 = isset($this->imagen5) ? $this->imagen5 : 'default_img.jpg';
        return '/images/tiendas/' . $img5;
    }

    public function uploadImagen5() {
        $image5 = UploadedFile::getInstance($this, 'imagen5');
 
        if (empty($image5)) {
            return false;
        }
 
        // store the source file name
        $this->imagen5 = $image5->name;
        $ext = end((explode(".", $image5->name)));
 
        // generate a unique file name
        $this->imagen5 = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $image5;
    }

    public function deleteImagen5() {
        $file = $this->getImagen5File();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->imagen5 = null;
 
        return true;
    }

    public function getLogotipoFile() 
    {
        return isset($this->logotipo) ? 'images/tiendas/' . $this->logotipo : null;
    }

    public function getLogotipoUrl() 
    {
        $logo = isset($this->logotipo) ? $this->logotipo : 'default_img.jpg';
        return '/images/tiendas/' . $logo;
    }

    public function uploadLogotipo() {
        $log = UploadedFile::getInstance($this, 'logotipo');
 
        if (empty($log)) {
            return false;
        }
 
        // store the source file name
        $this->logotipo = $log->name;
        $ext = end((explode(".", $log->name)));
 
        // generate a unique file name
        $this->logotipo = Yii::$app->security->generateRandomString().".{$ext}";
 
        // the uploaded image instance
        return $log;
    }

    public function deleteLogotipo() {
        $file = $this->getLogotipoFile();
 
        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }
 
        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        $this->logotipo = null;
 
        return true;
    }
}
