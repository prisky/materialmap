<?php

namespace common\models;

/**
 * This is the model class for table "tbl_question_thread".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $question_id
 * @property string $comment_html_basic
 * @property string $created
 *
 * @property Question[] $questions
 * @property Question $question
 * @property Account $account
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
            [['account_id', 'question_id', 'comment_html_basic'], 'required'],
            [['account_id', 'question_id'], 'integer'],
            [['comment_html_basic'], 'string']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['answer' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }

}
