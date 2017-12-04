<?php

namespace moguyun\plugins\scripts\models;

use yii\base\Model;

class Script extends Model
{
    public $position;
    public $content;

    const POSITION_INDEX_BOTTOM = 'indexBottom';
    const POSITION_GLOBAL_FOOTER = 'globalFooter';

    public function rules()
    {
        return [
            [['position', 'content'], 'required'],
            ['position', 'in', 'range' => [self::POSITION_GLOBAL_FOOTER, self::POSITION_INDEX_BOTTOM]],
            ['content', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'position' => '显示位置',
            'content' => '脚本内容',
        ];
    }

    public static function getPositionList()
    {
        return [
            self::POSITION_INDEX_BOTTOM => '首页底部',
            self::POSITION_GLOBAL_FOOTER => '全局底部',
        ];
    }
}
