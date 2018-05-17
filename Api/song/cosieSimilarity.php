<?php
/**
 * Created by PhpStorm.
 * User: Shmily
 * Date: 2018/5/17
 * Time: 21:06
 * Keyword:
 * Description:
 */

function dotp($arr1, $arr2)
{
    return array_sum(array_map(create_function('$a, $b', 'return $a * $b;'), $arr1, $arr2));
}
//$similarity=dotp($id1,$id2)/sqrt(dotp($id1,$id1)*dotp($id2,$id2));