<?php

namespace common\models;

/**
 * Scopes chained to the find method of an ActiveRecord  for table "tbl_manufacturer" .
 */
class ManufacturerQuery extends \common\components\ActiveQuery
{

    /**
     * Set ActiveQuery properties to filter by the search term similar to a Google search i.e. unordered multi word search
     * and define the attributes to return for display purposes - lists are one use.
     * @param type $q The search term entered by the user
     * @param type $page The page number
     * @return ActiveQuery $this The select should select id and text where text is the display text and id the primary key
     */
    public function display($q = null, $page = null)
    {

        // make any search google style i.e. unordered mulitple words
        if(is_string($q)) {
            foreach(explode(' ', $q) as $like) {
                // $this->andWhere("CONCAT_WS(' ', email, first_name, last_name) LIKE :like", [':like' => "%$like%"]);
                $this->andWhere("CONCAT_WS(' ', `name`) LIKE :like", [':like' => "%$like%"]);
            }
        }

        return parent::display($q, $page)
            // ->joinWith('contact')
            // ->select(["tbl_user.id id", "CONCAT_WS(' ', email, first_name, last_name) text"]);
            ->select(["tbl_manufacturer.id id", "CONCAT_WS(' ', `name`) text"]);
    }

}

