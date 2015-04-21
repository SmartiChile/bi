<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Circuito;

/**
 * CircuitoSearch represents the model behind the search form about `app\models\Circuito`.
 */
class CircuitoSearch extends Circuito
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk', 'posicion', 'idioma_fk'], 'integer'],
            [['nombre', 'icono', 'color', 'descripcion', 'imagen'], 'safe'],
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
        $query = Circuito::find();

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
            'posicion' => $this->posicion,
            'idioma_fk' => $this->idioma_fk,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'icono', $this->icono])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
}
