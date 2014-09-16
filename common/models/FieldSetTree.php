<?php

namespace common\models;

/**
 * This is the model class for table "tbl_field_set_tree".
 *
 * @property string $id
 * @property string $account_id
 * @property string $parent_id
 * @property string $child_id
 * @property integer $depth
 *
 * @property Account $account
 * @property FieldSet $parent
 * @property FieldSet $child
 */
class FieldSetTree extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_field_set_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'parent_id', 'child_id', 'depth'], 'required'],
            [['account_id', 'parent_id', 'child_id', 'depth'], 'integer']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasOne(FieldSet::className(), ['id' => 'child_id']);
    }
}
