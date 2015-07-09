<?php namespace Quallsbenson\Utility\Object;


class ObjectWrapper{

  protected $staticObject,
            $instance;

  public function __construct($object){

    $this->setObject( $object );

  }

  public static function wrap($object)
  {

    $wrapper = __CLASS__;

    if(!is_array($object))
      return new $wrapper($object);

    $objectArray = array();

    foreach($object as $tag => $staticObject)
      $objectArray[$tag] = new $wrapper($staticObject);

    return $objectArray;

  }

  public function setObject( $object )
  {

    if( is_object( $object ) )
    {
        $this->setInstance( $object );

        //convert to string for static object
        $object = get_class( $object );
    }

    $this->setStatic( $object );  

    return $this;

  }


  public function setStatic( $class )
  {

    if(!is_string( $class ))
      throw new \Exception( "Argument 1 passed to setStatic must be a string name of the class" );

    $this->staticObject = $class;

    return $this;
  }


  public function setInstance( $instance )
  {

    if( !is_object( $instance ) )
      throw new \Exception( "Argument 1 passed to setInstance must be an instance of an object, type: " .gettype( $instance ) ." was given" );

    $this->instance = $instance;

    return $this;

  }


  public function getName()
  {

    return $this->staticObject;

  }

  public function getInstance()
  {

    $arguments = func_get_args();

    if(is_callable($this->staticObject)){

      return call_user_func_array($this->staticObject, $arguments);

    }

    $class = $this->staticObject;

    return \getInstance($class, $arguments);

  }

  public function getSingleton()
  {

    if(!isset($this->instance))
      $this->instance = call_user_func_array([$this, 'getInstance'], func_get_args() );

    return $this->instance;

  }

  public function __destroy()
  {

    unset($this->staticObject);
    unset($this->instance);

  }


}
