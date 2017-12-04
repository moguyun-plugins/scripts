<?php

namespace moguyun\plugins\scripts\models;

use yii\base\Model;

class Script extends Model
{
    const POSITION_INDEX_BOTTOM = 'indexBottom';
    const POSITION_GLOBAL_FOOTER = 'globalFooter';

    public function rules()
    {
        return [
            [['position', 'scripts'], 'required'],
            ['position', 'in', 'range' => self::POSITION_GLOBAL_FOOTER, self::POSITION_INDEX_BOTTOM],
            ['scripts', 'string'],
        ];
    }

    public function getPositionList()
    {
        return [
            self::POSITION_INDEX_BOTTOM => '首页底部',
            self::POSITION_GLOBAL_FOOTER => '全局底部',
        ];
    }
}
