<?php

namespace common\components;

use Yii;
use yii\db\Query;
use \common\models\Model;

class DbManager extends \yii\rbac\DbManager
{

    /**
     * If denied for a model for read access, then if any navigation children have read access then access is approved, Still
     * denied for write access though.
     * @inheritdoc
     */
    protected function checkAccessRecursive($user, $itemName, $params, $assignments)
    {
        if (($item = $this->getItem($itemName)) === null) {
            return false;
        }

        Yii::trace($item instanceof Role ? "Checking role: $itemName" : "Checking permission: $itemName", __METHOD__);

        if (!$this->executeRule($user, $item, $params)) {
            return false;
        }

        if (isset($assignments[$itemName]) || in_array($itemName, $this->defaultRoles)) {
            return true;
        }

        $query = new Query;
        $parents = $query->select(['parent'])
            ->from($this->itemChildTable)
            ->where(['child' => $itemName])
            ->column($this->db);
        foreach ($parents as $parent) {
            if ($this->checkAccessRecursive($user, $parent, $params, $assignments)) {
                return true;
            }
        }

        // check children for read access 
        if (preg_match('/Read$/', $itemName)) {
            if ($model = Model::findOne(['auth_item_name' => str_replace('Read', '', $itemName)])) {
                foreach (Model::find()->descendantsOf($model->id)->all() as $model) {
                    if ($this->checkAccessRecursive($user, $model->auth_item_name . 'Read', $params, $assignments)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

}
