<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\Models\member;

/**
 * memberSearch represents the model behind the search form about `app\Models\member`.
 */
class memberSearch extends member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'member_type'], 'integer'],
            [['email', 'password', 'member_photo', 'member_name', 'member_phone', 'qq_openid', 'weibo_openid', 'verify'], 'safe'],
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
        $query = member::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'member_id' => $this->member_id,
            'member_type' => $this->member_type,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'member_photo', $this->member_photo])
            ->andFilterWhere(['like', 'member_name', $this->member_name])
            ->andFilterWhere(['like', 'member_phone', $this->member_phone])
            ->andFilterWhere(['like', 'qq_openid', $this->qq_openid])
            ->andFilterWhere(['like', 'weibo_openid', $this->weibo_openid])
            ->andFilterWhere(['like', 'verify', $this->verify]);

        return $dataProvider;
    }
}
