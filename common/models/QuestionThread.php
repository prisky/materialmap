<?php

namespace common\models;

/**
 * This is the model class for table "tbl_question_thread".
 *
 * @property string $id
 * @property string $account_id
 * @property string $question_id
 * @property string $comment
 * @property string $created
 *
 * @property Question[] $questions
 * @property Account $account
 * @property Question $question
 */
class QuestionThread extends \common\components\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_question_thread';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'question_id', 'comment'], 'required'],
            [['account_id', 'question_id'], 'integer'],
            [['comment'], 'string']
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['answer' => 'id', 'account_id' => 'account_id']);
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
}
