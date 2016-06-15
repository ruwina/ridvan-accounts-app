<?php use base\TemplateController;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DashboardController
 *
 * @author Ruwina
 */
class DashboardController extends TemplateController
{


    /**
     * @param Base $f3
     * @param $params
     */
    public function index($f3, $params)
    {
        
            $this->f3->set('view', 'Dashboard/index.html');
        
    }

   

}
