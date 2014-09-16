<?php

namespace common\models;

/**
 * This is the model class for table "tbl_model_tree".
 *
 * @property string $id
 * @property string $parent
 * @property string $child
 * @property integer $depth
 *
 * @property Model $parent0
 * @property Model $child0
 */
class ModelTree extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_model_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child', 'depth'], 'integer'],
            [['parent', 'child'], 'unique', 'targetAttribute' => ['parent', 'child'], 'message' => 'The combination of Parent and Child has already been taken.']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Model::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(Model::className(), ['id' => 'child']);
    }
}
