<?php

namespace App\Library;

use Session;

class Helper {

    public static function getBrand($prod) {
        $brands = array_flatten(\App\Models\Category::findBySlug("brand-name")->getDescendants(1, ['id'])->toArray());
        $prodCats = array_flatten($prod->categories()->get(['cat_id'])->toArray());
        @$brand = array_flatten(array_intersect($brands, $prodCats))[0];

        return $brand;
    }

    public static function searchForKey($keyy, $value, $array) {
        foreach ($array as $key => $val) {
            if ($val[$keyy] == $value) {
                return TRUE;
            }
        }
        return FALSE;
    }

    public static function chkPerm($route) {

        $user = \App\Models\User::with('roles')->find(Session::get('loggedinUserId'));
        $roles = $user->roles;
        $roles_data = $roles->toArray();
        $r = \App\Models\Role::find($roles_data[0]['id']);
        $per = $r->perms()->get(['name'])->toArray();


        if (in_array($route, array_flatten($per))) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

}

?>