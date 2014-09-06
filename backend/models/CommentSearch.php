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
            [['contact_id'], 'integer'],
			[['content'], 'safe']        ];
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

		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		$query->andFilterGoogleStyle('content', $this->content);
		
        return $dataProvider;
    }
}
