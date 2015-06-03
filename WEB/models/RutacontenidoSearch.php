<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RutaContenido;

/**
 * RutacontenidoSearch represents the model behind the search form about `app\models\RutaContenido`.
 */
class RutacontenidoSearch extends RutaContenido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk', 'ruta_fk', 'tienda_fk'], 'integer'],
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
    public function search($params, $ruta, $lan)
    {
        $query = RutaContenido::find()->where(['ruta_fk' => $ruta, 'idioma_fk'=>$lan])->joinWith('tiendaFk');

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
            'ruta_fk' => $this->ruta_fk,
            'tienda_fk' => $this->tienda_fk,
        ]);

        return $dataProvider;
    }
}
