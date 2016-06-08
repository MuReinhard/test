<?php
/**
 * @author ShiO
 * 具体工厂
 */
class CreatorConcrete extends Creator
{
    // 具体方法(负责实例化具体产品类)
    public function CreateProduct($mark)
    {
        switch($mark) {
            case 'A':
                return new ProductConcrete();
                break;
        }
    }
}