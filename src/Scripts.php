<?php

namespace moguyun\plugins\scripts;

use yii;
use zacksleo\yii2\plugin\components\Plugin;
use zacksleo\yii2\plugin\models\PluginSetting;
use moguyun\plugins\scripts\models\Script;

class Scripts extends Plugin
{
    public function init()
    {                    #插件初始化,配置插件信息 必须
        // set plugin's info
        $this->identify = 'Scripts';            #必要参数, 插件的唯一标识.
        $this->name = '自定义网站脚本';         #必要参数, 插件的显示名称.
        $this->version = '0.0.1';                 #插件版本号
        $this->description = '在首页添加自定义脚本';    #插件描述
        $this->copyright = '蘑菇云'; #插件版权信息
        $this->website = 'http://www.moguyun.ltd';      #网站
        $this->icon = 'icon.svg'; #插件图标,最大72*72, 如果不设置将使用默认图标;
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
            return $scripts;
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
        $model->load([
            'position' => $this->getSetting('position'),
            'content' => $this->getSetting('content'),
        ]);
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $this->setSetting('position', $model->position);
            $this->setSetting('content', $model->content);
            Yii::$app->session->setFlash('success', '设置成功');
            return $this->redirect('admincp');
        }
        return $this->render('admincp', [
            // 'models' => $models
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
