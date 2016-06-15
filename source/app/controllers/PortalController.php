<?php use base\TemplateController;

class PortalController extends TemplateController
{

    /**
     * @param $f3 Base
     * @param $params
     */
    public function loginView($f3, $params)
    {

        //no_navigation is set to true, so that header and footer part of other pages doesn't appear.
        $f3->set('SESSION.FlashMessage', "");
        $f3->set('no_navigation', TRUE);
        $f3->set('view', 'Portal/loginView.html');
        $this->loggedOutView();
    }

}
