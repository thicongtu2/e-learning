<?php

namespace common\models;

use common\utilities\Time;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "question_component".
 *
 * @property int $id
 * @property string $name
 * @property int $question_id
 * @property int $missing
 * @property int $rank
 * @property int $create_by
 * @property int $update_by
 * @property string $create_at
 * @property string $update_at
 * @property int $del_flg
 */
class QuestionComponent extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'missing', 'rank', 'create_by','update_by', 'del_flg'], 'integer'],
            [['create_at','update_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'question_id' => Yii::t('app', 'Question ID'),
            'missing' => Yii::t('app', 'Missing'),
            'rank' => Yii::t('app', 'Rank'),
            'create_by' => Yii::t('app', 'Create By'),
            'update_by' => Yii::t('app', 'Update By'),
            'create_at' => Yii::t('app', 'Create At'),
            'update_at' => Yii::t('app', 'Update At'),
            'del_flg' => Yii::t('app', 'Del Flg'),
        ];
    }
    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert){
            $this->update_at = Time::Now();
            $this->create_at = Time::Now();
            $this->update_by = Yii::$app->user->getId();
            $this->create_by = Yii::$app->user->getId();
        }else{
            $this->update_at = Time::Now();
            $this->update_by = Yii::$app->user->getId();
        }
        return parent::beforeSave($insert);
    }

}