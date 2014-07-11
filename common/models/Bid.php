<?php

namespace common\models;

/**
 * This is the model class for table "tbl_bid".
 *
 * @property string $id
 * @property string $account_id
 * @property string $question_id
 * @property string $offer
 * @property string $comment
 * @property string $deadline
 * @property string $updated
 *
 * @property Account $account
 * @property Question $question
 * @property Question[] $questions
 */
class Bid extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'question_id', 'comment', 'deadline'], 'required'],
            [['account_id', 'question_id'], 'integer'],
            [['offer'], 'number'],
            [['comment'], 'string'],
            [['deadline', 'updated'], 'safe']
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
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id', 'account_id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['bid_id' => 'id', 'account_id' => 'account_id']);
    }
}
