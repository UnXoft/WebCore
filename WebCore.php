<?php

/**
 * Created by Daniel Vidmar.
 * User: Daniel
 * Date: 5/10/2016
 * Time: 6:45 PM
 * Version: Beta 1
 * Last Modified: 5/10/2016 at 6:45 PM
 * Last Modified by Daniel Vidmar.
 */
class WebCore
{
  /**
   * The instance of the WebCore Registry class.
   * @var
   */
    private static $instance;
  /**
   * An array controller all controller instances.
   * @var array
   */
    private static $controllers = array();

  /**
   * Override the constructor class.
   */
    private function __construct() {

    }

  /**
   * Returns an instance of the WebCore Registry class, or creates and returns a new one if needed.
   * @return mixed
   */
    public static function instance() {
        if(!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }

  /**
   * Override, to ensure we don't allow new instances.
   */
    public function __clone() {
        trigger_error("Unable to clone WebCore registry class!");
    }

   /**
    * Used to get the instance of controller with name "@param $name".
    * @param $name - The name of the controller to get
    * @return mixed - Returns the controller's instance if it exists.
    * @throws Exception - Throws if controller with name "@param $name" doesn't exists.
    */
    public function get_controller($name) {
        if(is_object(self::$controllers[$name])) {
            return self::$controllers[$name];
        }
        throw new Exception("Unable to get controller with name of \"".$name."\".");
    }

  /**
   * Used to add a controller with name "@param $name" to the controllers array.
   * @param $name - The file name of the controller to add.
   * @param $controller - The class name of the controller to add.
   */
    public function add_controller($name, $controller) {
        require_once('Controllers/'.$controller.'.php');
        self::$controllers[$name] = new $controller(self::$instance);
    }
}