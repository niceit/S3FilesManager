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