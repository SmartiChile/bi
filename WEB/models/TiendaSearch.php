<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tienda;

/**
 * TiendaSearch represents the model behind the search form about `app\models\Tienda`.
 */
class TiendaSearch extends Tienda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk', 'imagen2', 'imagen3', 'imagen4', 'imagen5', 'logotipo', 'local_fk', 'circuito_fk', 'idioma_fk'], 'integer'],
            [['nombre', 'descripcion', 'numeracion', 'tags', 'banner', 'imagen1', 'telefono', 'horario_inicio', 'horario_fin', 'sitio_web', 'facebook', 'twitter', 'instagram', 'googleplus', 'pinterest', 'tripadvisor'], 'safe'],
            [['rating'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tienda::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pk' => $this->pk,
            'rating' => $this->rating,
            'imagen2' => $this->imagen2,
            'imagen3' => $this->imagen3,
            'imagen4' => $this->imagen4,
            'imagen5' => $this->imagen5,
            'logotipo' => $this->logotipo,
            'horario_inicio' => $this->horario_inicio,
            'horario_fin' => $this->horario_fin,
            'local_fk' => $this->local_fk,
            'circuito_fk' => $this->circuito_fk,
            'idioma_fk' => $this->idioma_fk,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'numeracion', $this->numeracion])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'imagen1', $this->imagen1])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'sitio_web', $this->sitio_web])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'googleplus', $this->googleplus])
            ->andFilterWhere(['like', 'pinterest', $this->pinterest])
            ->andFilterWhere(['like', 'tripadvisor', $this->tripadvisor]);

        return $dataProvider;
    }
}
