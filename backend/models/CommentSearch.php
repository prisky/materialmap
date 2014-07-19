<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    
    public function rules()
    {
        return [
            [['content', 'email'], 'safe'],
			[['event_id'], 'integer']        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search($params)
    {
        $query = Comment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

		$query->andFilterGoogleStyle('content', $this->content);
		$query->andFilterGoogleStyle('email', $this->email);
		$query->andFilterWhere(['event_id' => $this->event_id]);
		
        return $dataProvider;
    }
}
