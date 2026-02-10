<?php

namespace frontend\models;

use common\models\CarMark;
use common\models\CarModel;
use common\models\Details;
use common\models\GenerationUrls;
use common\models\Parts;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class DetailsSearchForm extends Model
{
    public $mark;
    public $gen;
    public $part;
    public $child;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mark'], 'required'],
        ];
    }

    public static function Marks()
    {
        $marks_id = Details::find()->select(['mark'])->distinct()->indexBy('mark')->andWhere(['details.status' => Details::STATUS_ACTIVE])->asArray()->all();
        $marks_id_in = [];
        foreach ($marks_id as $key => $m)
            $marks_id_in[] = $key;
        return CarMark::find()->where(['in', 'car_mark.id_car_mark', $marks_id_in])->orderBy(['name' => SORT_ASC])->all();
    }

    public function SetGenList()
    {
        $data = [];
        if ($this->mark and $this->gen) {
            $model_id = Details::find()->select(['generation_front', 'model'])->where(['mark' => $this->mark])->andWhere(['details.status' => Details::STATUS_ACTIVE])->distinct()->all();
            $model_id_in = [];
            $g_id_in = [];
            foreach ($model_id as $m) {
                $model_id_in[] = $m->model;
                $g_id_in[] = $m->generation_front;
            }
            $gen = GenerationUrls::find()->joinWith('gen')->where(['in', 'car_model.id_car_model', $model_id_in])->andWhere(['in', 'car_generation.id_car_generation', $g_id_in])->orderBy(['car_model.name' => SORT_ASC,'generation_urls.front_name' => SORT_ASC])->indexBy('id')->asArray()->all();
            foreach ($gen as $g) {
                $data[$g['id_car_generation']] = $g['gen']['model']['name'].' '.$g['front_name'] . ' [' . $g['year_begin'] . ' - ' . $g['year_end'] . ']';
            }
        }
        return $data;
    }

    public function SetPartList()
    {
        $data = [];
        if ($this->mark and $this->gen and $this->part) {
            $part_id = Details::find()->select(['generation_front', 'parts_id'])->where(['generation_front' => $this->gen])->andWhere(['details.status' => Details::STATUS_ACTIVE])->distinct()->all();
            $part_id_in = [];
            foreach ($part_id as $m)
                $part_id_in[] = $m->parts_id;
            $p_id = [];
            $parts_child = Parts::find()->where(['in', 'id', $part_id_in])->indexBy('id')->all();
            foreach ($parts_child as $p)
                $p_id[] = $p->parent_id;
            $parts = Parts::find()->where(['in', 'id', $p_id])->indexBy('id')->orderBy(['title' => SORT_ASC])->indexBy('id')->asArray()->all();
            foreach ($parts as $p)
                $data[$p['id']] = $p['title'];
        }
        return $data;
    }

    public function SetChildList()
    {
        $data = [];
        if ($this->mark and $this->gen and $this->part and $this->child) {
            $parts = Parts::find()->rightJoin('details', 'details.parts_id = parts.id')->where(['parent_id' => $this->part])->andWhere(['details.status' => Details::STATUS_ACTIVE])->andWhere(['generation_front' => $this->gen])->indexBy('id')->orderBy(['title' => SORT_ASC])->indexBy('id')->asArray()->all();;
            foreach ($parts as $p)
                $data[$p['id']] = $p['title'];
        }
        return $data;
    }


}
