<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Comment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

		$query->andFilterWhere(['contact_id' => $this->contact_id]);
		$query->andFilterGoogleStyle('content_html_basic', $this->content_html_basic);
		
        return $dataProvider;
    }
}
