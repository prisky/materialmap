<?php

namespace common\models;

/**
 * This is the model class for table "tbl_question".
 *
 * @property string $id
 * @property string $account_id
 * @property string $comment
 * @property string $offer
 * @property string $created
 * @property string $bid_id
 * @property string $answer
 *
 * @property Bid[] $bs
 * @property Bid $bid
 * @property QuestionThread $answer0
 * @property Account $account
 * @property QuestionThread[] $questionThreads
 */
class Question extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'comment'], 'required'],
            [['account_id', 'bid_id', 'answer'], 'integer'],
            [['comment'], 'string'],
            [['offer'], 'number']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBs()
    {
        return $this->hasMany(Bid::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBid()
    {
        return $this->hasOne(Bid::className(), ['id' => 'bid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer0()
    {
        return $this->hasOne(QuestionThread::className(), ['id' => 'answer']);
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
    public function getQuestionThreads()
    {
        return $this->hasMany(QuestionThread::className(), ['question_id' => 'id']);
    }
}
