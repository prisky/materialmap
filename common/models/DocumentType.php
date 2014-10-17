<?php

namespace common\models;

/**
 * This is the model class for table "tbl_document_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Document[] $documents
 */
class DocumentType extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_document_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['document_type_id' => 'id']);
    }

}
