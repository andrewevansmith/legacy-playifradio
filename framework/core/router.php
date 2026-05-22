<?php

/* 
 * Router Class
 * 
 * Used to route URI requests to different bits of functionality 
 * within the application.  For example: http://myapp.tld/c/m/p1/p2 
 * will execute (controller) C->m(p1,p2) 
 * 
 * @author Andrew Evan Smith
 * @copyright 2012 Andrew Evan Smith
 * @license http://www.php.net/license/3_01.txt PHP License 3.01 
 */  

class Router 
{
   /* 
    * Starts a MVC application
    * 
    * Uses URI request to call methods of one of the apps
    * controllers.
    * 
    * @return void
    */  
    public static function start_application()
    {
        $params = Router::get_uri();

        // If no controller given, route to default, append '_controller' to the end to enforce
        // good practice naming
        $controller_name = reset($params);
        $controller_name = ($controller_name != "") ? $controller_name.'_controller' : 'site_controller';
        array_shift($params); // Remove controller

	    if (!include 'controllers/'. $controller_name .'.php') {
            redirect('site/page404');
        }

        $controller_name = str_replace('_ ','_',ucwords(str_replace('_','_ ',$controller_name)));
        $controller = new $controller_name();

        $method = isset($params[0]) ? $params[0] : 'index';
        if(!method_exists($controller_name, $method))
        {
            redirect('site/page404');
            //$errorhandler->show_error("404", "This page cannot be found, sorry!");
        }
        else 
        {
            array_shift($params); // Remove method, leaving only parameters
            if (count($params) > 0) call_user_func_array(array($controller, $method), $params);
            else call_user_func_array(array($controller, $method), array());
        }

    }



   /* 
    * Gets array of URI parameters
    * 
    * Turns /path/to/method/ into:  
    * array('path', 'to', 'method'), note that
    * This works for both mod_rewrite enabled servers and
    * query strings
    * 
    * @return array uri parameters
    */  
    private function get_uri()
    {
        if (ROUTING_METHOD == 'QUERY_STRING')
        {
            $params = explode("/", $_GET['q']);  
        }
        else  // HTACCESS rewrites enabled
        {
            $base   = explode("/", BASE_URL);  
            $uri    = explode("/", $_SERVER['REQUEST_URI']);  
            $params = array_diff($uri, $base);
        }
        return $params;
    }
}
