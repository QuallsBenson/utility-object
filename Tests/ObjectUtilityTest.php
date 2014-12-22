<?php

use Designplug\Utility\Object\ObjectResolver;
use Designplug\Utility\Object\ObjectWrapper;

require dirname(dirname(__FILE__)) .'/vendor/autoload.php';

class ObjectUtilityTest extends PHPUnit_Framework_TestCase{

      public function testObjectResolver(){

        $resolver = new ObjectResolver;
        $resolver->addNamespace('\Designplug\Utility\Object\Tests');
        $class    = $resolver->resolve(array('ResolvedObjectNonExisting', 'ResolvedObject1'));

        $this->assertEquals($class->getName(), 'Designplug\Utility\Object\Tests\ResolvedObject1');

        return $class;

      }

      /**
      *
      * @depends testObjectResolver
      */

      public function testObjectWrapper($objectWrapper){

        $this->assertTrue($objectWrapper->getInstance() instanceof Designplug\Utility\Object\Tests\ResolvedObject1);

      }


}
