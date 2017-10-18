<?php
namespace Gate\SystemStorage;

/**
 * @class StorageInf
 * @author ShiO
 */

interface StorageInf {
    public function set($key, $value = null);

    public function get($key);

    public function clean();
}