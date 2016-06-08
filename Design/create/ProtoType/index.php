<?php
/**
 * @author ShiO
 */
class a{

}

$a = new a();
$pro = new ProtoTypeConcrete($a);
$proCopy = $pro->copy();

echo $proCopy->getName();