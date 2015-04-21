<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Arriendo;

/**
 * ArriendoSearch represents the model behind the search form about `app\models\Arriendo`.
 */
class ArriendoSearch extends Arriendo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk', 'idioma_fk'], 'integer'],
            [['titulo', 'descripcion', 'direccion', 'telefono', 'email', 'nombre_contacto', 'imagen1', 'imagen2', 'imagen3'], 'safe'],
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
        $query = Arriendo::find();

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
            'idioma_fk' => $this->idioma_fk,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombre_contacto', $this->nombre_contacto])
            ->andFilterWhere(['like', 'imagen1', $this->imagen1])
            ->andFilterWhere(['like', 'imagen2', $this->imagen2])
            ->andFilterWhere(['like', 'imagen3', $this->imagen3]);

        return $dataProvider;
    }
}
