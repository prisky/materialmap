<?php

namespace common\models;

/**
 * This is the model class for table "tbl_cancellaton_policy_blackhole".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $cancellation_policy_id
 * @property integer $days
 * @property string $rate
 * @property string $base_fee
 */
class CancellatonPolicyBlackhole extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cancellaton_policy_blackhole';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }
}
