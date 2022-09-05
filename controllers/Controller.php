<?php

namespace controllers;

use core\Template;
use core\Utils;

/**
 * Базовий клас для всіх контролерів
 */
class Controller
{
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            return true;
        else
            return false;

    }


    public function render($viewName, $localParams = null, $globalParams = null)
    {
        $tpl = new Template();
        if (is_array($localParams)) {
            $tpl->setParams($localParams);
        }
        if (!is_array($globalParams)) {
            $globalParams = [];
        }
        $moduleName = strtolower((new \ReflectionClass($this))->getShortName());
        $globalParams['PageContent'] = $tpl->render("views/{$moduleName}/{$viewName}.php");
        return $globalParams;
    }

    public function renderMessage($type, $message, $localParams = null, $globalParams = null)
    {
        $tpl = new Template();
        if (is_array($localParams)) {
            $tpl->setParams($localParams);
        }
        $tpl->setParam('MessageText', $message);
        switch ($type) {
            case 'ok':
                $tpl->setParam('MessageClass', 'success');
                break;
            case 'error':
                $tpl->setParam('MessageClass', 'danger');
                break;
            case 'info':
                $tpl->setParam('MessageClass', 'info');
                break;
        }
        if (!is_array($globalParams)) {
            $globalParams = [];
        }
        $globalParams['PageContent'] = $tpl->render("views/layout/message.php");
        return $globalParams;
    }

}