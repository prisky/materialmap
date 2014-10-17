<?php

namespace common\models;

/**
 * This is the model class for table "tbl_document".
 *
 * @property integer $id
 * @property integer $document_type_id
 * @property string $name
 * @property string $url
 *
 * @property DocumentType $documentType
 */
class Document extends \common\components\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_type_id', 'name'], 'required'],
            [['document_type_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentType()
    {
        return $this->hasOne(DocumentType::className(), ['id' => 'document_type_id']);
    }

}
