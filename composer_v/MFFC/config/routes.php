<?php
/**
 * @author ShiO
 */
use NoahBuscher\Macaw\Macaw;

Macaw::get('fuck', function() {
    echo "成功！";
});

Macaw::get('(:all)', function($fu) {
    echo '未匹配到路由<br>'.$fu;
});

Macaw::get('', 'HomeController@home');

Macaw::dispatch();