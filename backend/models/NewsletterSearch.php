<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\Newsletter;

/**
 * NewsletterSearch represents the model behind the search form about `common\models\Newsletter`.
 */
class NewsletterSearch extends Newsletter
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = Newsletter::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('subject', $this->subject);
        $query->andFilterGoogleStyle('content_html', $this->content_html);

        return $dataProvider;
    }
}
