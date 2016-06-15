<?php ;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RouteController
 *
 * @author Ruwina
 */
class RouteController
{
    /**
     * @param $f3 Base
     * @param $params
     */
    function standardCall($f3, $params)
    {
        $className = array_key_exists('controller', $params) ? ucfirst($params['controller']) : 'Dashboard';
        $methodName = array_key_exists('action', $params) ? $params['action'] : 'index';

        if (!Utility::checkControllerExists($className))
            $f3->reroute("/");

        $methods = get_class_methods($className . 'Controller');

        if (in_array($methodName, $methods)) {
            $f3->call($className . 'Controller->' . $methodName, array($f3, $params), 'beforeroute,afterroute');
        } else {
            $params['id'] = $methodName;

            // Shifting twice to place everything after controller into resources array
            $resources = explode("/", $params[0]);
            array_shift($resources);
            array_shift($resources);

            $params['resources'] = $resources;

            $f3->call($className . 'Controller->' . 'index', array($f3, $params), 'beforeroute,afterroute');
        }

    }

}
