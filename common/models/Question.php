<?php

namespace common\models;

/**
 * This is the model class for table "tbl_question".
 *
 * @property integer $id
 * @property integer $account_id
 * @property string $comment_html_basic
 * @property string $offer
 * @property string $created
 * @property integer $bid_id
 * @property integer $answer
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
            [['account_id', 'comment_html_basic', 'offer'], 'required'],
            [['account_id', 'bid_id', 'answer'], 'integer'],
            [['comment_html_basic'], 'string'],
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
