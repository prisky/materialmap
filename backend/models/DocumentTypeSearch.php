<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\DocumentType;

/**
 * DocumentTypeSearch represents the model behind the search form about `common\models\DocumentType`.
 */
class DocumentTypeSearch extends DocumentType
{

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = DocumentType::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $query->andFilterGoogleStyle('name', $this->name);
        $query->andFilterGoogleStyle('description', $this->description);

        return $dataProvider;
    }
}
