<?php

namespace common\models;

/**
 * This is the model class for table "tbl_voucher_constraint".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $voucher_id
 * @property string $invalid_from
 * @property string $invalid_to
 *
 * @property Voucher $voucher
 */
class VoucherConstraint extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_voucher_constraint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'voucher_id'], 'required'],
            [['account_id', 'voucher_id'], 'integer'],
            [['invalid_from', 'invalid_to'], 'safe'],
            [['voucher_id', 'invalid_from'], 'unique', 'targetAttribute' => ['voucher_id', 'invalid_from'], 'message' => 'The combination of Voucher and Invalid from has already been taken.'],
            [['voucher_id', 'invalid_to'], 'unique', 'targetAttribute' => ['voucher_id', 'invalid_to'], 'message' => 'The combination of  and Voucher has already been taken.']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoucher()
    {
        return $this->hasOne(Voucher::className(), ['id' => 'voucher_id']);
    }
}
