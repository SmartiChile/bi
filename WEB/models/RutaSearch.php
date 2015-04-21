<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ruta;

/**
 * RutaSearch represents the model behind the search form about `app\models\Ruta`.
 */
class RutaSearch extends Ruta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk', 'usuario_fk', 'terminada'], 'integer'],
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
    public function search($params, $usuario)
    {
        $query = Ruta::find()->where(['usuario_fk' => $usuario]);

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
            'usuario_fk' => $this->usuario_fk,
            'terminada' => $this->terminada,
        ]);

        return $dataProvider;
    }
}
