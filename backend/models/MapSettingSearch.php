<?php

namespace backend\models;

use yii\data\ActiveDataProvider;
use common\models\MapSetting;

/**
 * MapSettingSearch represents the model behind the search form about `common\models\MapSetting`.
 */
class MapSettingSearch extends MapSetting
{
    public $from_zoom_level;
    public $to_zoom_level;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }

    public function search()
    {
        $query = MapSetting::find();

        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        if(!is_null($this->from_zoom_level) && $this->from_zoom_level != '') $query->andWhere('`zoom_level` >= :from_zoom_level', [':from_zoom_level' => $this->from_zoom_level]);
        if(!is_null($this->to_zoom_level) && $this->to_zoom_level != '') $query->andWhere('`zoom_level` <= :to_zoom_level', [':to_zoom_level' => $this->to_zoom_level]);
        $query->andFilterGoogleStyle('latitude', $this->latitude);
        $query->andFilterGoogleStyle('longitude', $this->longitude);

        return $dataProvider;
    }
}
