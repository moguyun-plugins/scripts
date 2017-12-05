<?php

namespace moguyun\plugins\scripts;

use yii;
use zacksleo\yii2\plugin\components\Plugin;
use zacksleo\yii2\plugin\models\PluginSetting;
use moguyun\plugins\scripts\models\Script;

class Scripts extends Plugin
{
    public function init()
    {
        $this->identify = 'Scripts';
        $this->name = '自定义网站脚本';
        $this->version = '0.0.1';
        $this->description = '在首页添加自定义脚本';
        $this->copyright = '蘑菇云';
        $this->website = 'http://www.moguyun.ltd';
        $this->icon = 'icon.svg';
    }

    public function hooks()
    {
        return [
            'global_footer' => 'globalFooter',
            'index_bottom' => 'indexBottom',
        ];
    }

    public function indexBottom()
    {
        $position = $this->getSetting('position');
        $content = $this->getSetting('content');
        if ($position == 'indexBottom') {
            return $content;
        }
    }

    public function globalFooter()
    {
        $position = $this->getSetting('position');
        $content = $this->getSetting('content');
        if ($position == 'globalFooter') {
            return $content;
        }
    }

    public function admincp()
    {
        $model = new Script();
        $model->attributes = [
            'position' => $this->getSetting('position'),
            'content' => $this->getSetting('content'),
        ];
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $this->setSetting('position', $model->position);
            $this->setSetting('content', $model->content);
            Yii::$app->session->setFlash('success', '设置成功');
            //return $this->refresh();
        }
        return $this->render('admincp', [
            'model' => $model
        ]);
    }

    public function install()
    {
        $this->setSetting('position', 'globalFooter');
        $this->setSetting('content', '');
        return true;
    }

    public function uninstall()
    {
        PluginSetting::deleteAll([
            'plugin' => $this->identify
        ]);
        return true;
    }
}
