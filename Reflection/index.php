<?php
/**
 * @author ShiO
 */
include_once('Person.php');
$class = new ReflectionClass('Person');//建立 Person这个类的反射类
$args = array();
$instance  = $class->newInstanceArgs($args);//相当于实例化Person 类

// 获取属性
$properties = $class->getProperties();
//foreach($properties as $property) {
//    echo $property->getName()."<br />";與
//}
// 获取注释
//foreach($properties as $property) {
//    if($property->isProtected()) {8
//        $docblock = $property->getDocComment();
//        preg_match('/ type\=([a-z_]*) /', $property->getDocComment(), $matches);
//        echo $matches[1]."<br />";
//    }
//}
// 获取类的方法
echo $instance->getBiography(); //执行Person 里的方法getBiography
//或者：
//$ec=$class->getmethod('getName');  //获取Person 类中的getName方法
//$ec->invoke($instance);       //执行getNam点e 方法