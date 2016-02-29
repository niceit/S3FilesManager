<?php

function is_check_grant($arr_grants, $user, $grant){
    $checked = "checked='checked'";
    if (!empty($arr_grants)) {
        foreach ($arr_grants as $row) {
            if (!empty($row['Grantee']['DisplayName']) && $row['Grantee']['DisplayName'] == $user && $row['Permission'] == $grant) {
                return $checked;
            } else {
                $url = $row['Grantee']['URI'];
                $arr = explode("/", $url);
                if (end($arr) == $user && $row['Permission'] == $grant) {
                    return $checked;
                }
            }
        }
    }
    return '';
}

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}