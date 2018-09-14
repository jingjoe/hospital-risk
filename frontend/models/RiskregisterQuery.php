<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Riskregister]].
 *
 * @see Riskregister
 */
class RiskregisterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Riskregister[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Riskregister|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
