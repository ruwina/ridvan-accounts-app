<?php

namespace base;

use Base;
use SessionUtils;
use StringUtils;
use Template;

class TemplateController {

    /**
     * @var Base
     */
    protected $f3;
    protected $action;

    /**
     * @var $session SessionUtils
     */
    protected $session;

    function __construct()
    {
        $f3 = Base::instance();
       
        $this->session = SessionUtils::instance();
        $this->f3 = $f3;
    }

    function beforeroute() { 
        $this->action = $this->getAction();
        if (StringUtils::startsWith($this->f3->get('PATH'), "/") || !($this->isAuthenticated())) {
            $this->f3->set('SESSION.FlashMessage', "");
            $this->f3->set('view','Portal/loginView.html');
            //$this->loggedOutView();
        }
        else if($this->noAccessControl()){
            $this->f3->set('view','Portal/loginView.html');
        }

    }

    protected function getAction()
    {
        $hive = $this->f3->hive();
        $path = $hive['PATH'];
        $arr = explode('/', $path);

        if (array_key_exists(2, $arr)) {
            $action = $arr[2];
        } else {
            $action = 'index';
        }

        $methods = get_class_methods(static::class);

        $action = in_array($action, $methods) ? $action : "index";

        return $action;
    }

    protected function isAuthenticated() {
        $userID = $this->f3->get('SESSION.userId');
        return strlen($userID) !== 0;
    }

    protected function loggedOutView(){
        echo Template::instance()->render('Portal/loggedOutTemplate.html');
        exit;
    }

    /**
     * Return true to disable access control on this controller
     *
     * For disabling access control of a certain action. Check PATH system variable
     *
     * @return bool
     */
    protected function noAccessControl() {
        $hive = $this->f3->hive();
        $path = $hive['PATH'];

        return StringUtils::startsWith($path, "/portal");
    }

    /**
     * Return the permissions that the user's role must have to access this controller
     *
     * @return null|array
     */
    protected function requiredPermissions() {
        return array();
    }


    function afterroute() {
        if (!$this->isAuthenticated()) {
            $this->f3->set('view', 'Portal/loginView.html');
            echo Template::instance()->render('template.html');

            exit;
        }

        $vModel = $this->f3->get('vModel');

        if (!$vModel)
            $vModel = array();

        $this->f3->mset($vModel);

        if ($this->f3->get('forgot_password')) {
            // do not redirect
        } else if ($this->f3->get('no_navigation')) {
            $this->f3->set('view', 'Portal/loginView.html');
            $this->loggedOutView();
        } else {
            if ($this->f3->get('navigate_to_full_screen_workset')) {
                $this->f3->set('header', FALSE);
                $this->f3->set('footer', FALSE);
            } else {
                $this->f3->set('header', TRUE);
                $this->f3->set('footer', TRUE);
            }

            echo Template::instance()->render('template.html');
        }

    }

    /**
     *
     *
     * @param $f3
     * @param $params
     */
    public function errorHandler($f3, $params)
    {
        $error = $this->f3->get('SESSION.dewp_error');

        if (!$error) {
            $error = [];
            $error['status'] = 'Something went wrong';
            $error['path'] = 'errorHandler$';
            $error['code'] = "SWW";
            $error['text'] = "Sorry we could not find what you were looking for. Please contact your system administrator for help";
            $error['date'] = date('d-m-Y, H:i:s');
        }

        $this->f3->set('ER', $error);
        $this->f3->set('view', 'Error/error.html');
    }

    /**
     *
     * @param $f3 Base
     * @param $params
     */
    public function index($f3, $params)
    {
        $this->f3->reroute('/dashboard');
    }


}
