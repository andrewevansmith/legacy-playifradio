<?php 

abstract class Controller {

    abstract protected function index();

   /* 
    * Loads a model from the /models directory
    *
    * This function will append _model.php to the end of the model
    * name, to maintain consistency within naming
    * 
    * @param string $name a model to be loaded
    * @return $name Model instance
    */
    public final function load_model($name) 
    {
        $name = $name . '_model';
        if (!require_once 'models/'.$name.'.php') die("Could not find $name model");
        $name = str_replace('_ ','_',ucwords(str_replace('_','_ ',$name)));
        return new $name();
    }

   /* 
    * Loads a view from the /views directory 
    *  
    * @param string $name a model to be loaded
    * @param array $data any data you wish to pass to the view
    * @return void
    */
    public final function load_view($name, $data=array()) 
    {
        extract($data);
        include 'views/'.$name.'.php';
    }

    public final function redirect($str)
    {
        header("Location: ".BASE_URL."$str");
    }

}
