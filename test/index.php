<?php
/**
 * @author ShiO
 */
$a = array(
    0 => array(
        'id' => 1,
        'pid' => 0,
        'name' => '哈哈哈',
    ),
    1 => array(
        'id' => 2,
        'pid' => 1,
        'name' => '哈哈哈111',
    ),
    2 => array(
        'id' => 3,
        'pid' => 1,
        'name' => '哈哈哈222',
    ),
    3 => array(
        'id' => 4,
        'pid' => 2,
        'name' => '哈哈哈1111 444444',
    ),
    4 => array(
        'id' => 5,
        'pid' => 2,
        'name' => '哈哈哈22222 5555',
    ),
    5 => array(
        'id' => 6,
        'pid' => 5,
        'name' => '666666',
    ),
    6 => array(
        'id' => 7,
        'pid' => 6,
        'name' => '777777777',
    ),
    7 => array(
        'id' => 8,
        'pid' => 1,
        'name' => '8888888',
    ),
);
//$data = list_to_tree($a, 'id', 'pid', 'child', 2, 'id');
//dump($a);
//print_r($data);
//print_r(listToTreeCompatible($a, 2));

/**
 * @author ShiO
 * @param $list
 * @param string $pk
 * @param string $pid
 * @param string $child
 * @param int $root
 * @param string $keep
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0, $keep = null) {
    // 创建Tree
    $tree = array();
    $ids = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            // 变为了一维数组
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
                if ($keep) {
                    $temp = &$list[$key][$keep];
                    $ids[] = $temp;
                }
            } else {
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    dump($parent);
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    if ($keep) {
        return $ids;
    }
    return $tree;
}

// $list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0, $keep = null
print_r(parseTree($a,2));
function parseTree($tree, $root = null) {
    $nested = array();
    foreach($tree as $index => $child) {
        if($child['pid'] == $root) {
            unset($tree[$index]);
            $child = parseTree($tree, $child['id']);
            $child['children'] = $child;
            $nested[] = $child;
        }
    }
    return empty($nested) ? null : $nested;
}
/**
 * @author ShiO
 * @param $list
 * @param string $pk
 * @param string $pid
 * @param string $child
 * @param int $root
 * @param null $keep
 * @return array|null
 */
function listToTreeCompatible($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0, $keep = null) {
    $nested = array();
    $ids = array();
    foreach ($list as $index => $childArr) {
        if ($childArr[$pid] == $root) {
            unset($list[$index]);
            $childArr[$child] = listToTreeCompatible($list, $pk, $pid, $child, $root, $keep);
            $nested[] = $childArr;
            if ($keep) {
                $ids[] = $childArr[$keep];
            }
        }
    }
    if ($keep) {
        return empty($ids) ? null : $ids;
    }
    return empty($nested) ? null : $nested;
}

/**
 * @author ShiO
 * @param $var
 * @param bool $echo
 * @param null $label
 * @param bool $strict
 * @return mixed|null|string
 */
function dump($var, $echo = true, $label = null, $strict = true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    } else
        return $output;
}
