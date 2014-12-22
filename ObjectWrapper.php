<?php namespace Designplug\Utility\Object;


class ObjectWrapper{

  protected $staticObject,
            $instance;

  public function __construct($object){

    $this->staticObject = $object;

  }

  public function getName(){

    return $this->staticObject;
    
  }

  public function getInstance(){

    $arguments = func_get_args();

    if(is_callable($this->staticObject)){

      return call_user_func_array($this->staticObject, $arguments);

    }

    $class = $this->staticObject;

    return \getInstance($class, $arguments);

  }

  public function getSingleton(){

    if(!isset($this->instance))
      $this->instance = $this->getInstance();

    return $this->instance;

  }

  public function __destroy(){

    unset($this->staticObject);
    unset($this->instance);

  }


}
