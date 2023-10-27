<?php

namespace App\Http\Services;

class MenuTree
{
    public static function tree($menus = NULL, $parent = 0)
    {
        $menus_collection = clone $menus;
        $data = array();
        foreach ($menus_collection as $key => $menu) {
            if (!array_key_exists($menu->id, $data) && $menu->p_menu_id == $parent) {
                $data[$menu->id] = $menu->toArray();
                unset($menus[$key]);
            }

            if (array_key_exists($menu->p_menu_id, $data) && $menu->p_menu_id != $parent) {
                $child = self::tree($menus, $menu->p_menu_id);
                if ($child) {
                    $data[$menu->p_menu_id]['children'] = $child;
                }
            }
        }
        return $data;
    }
}
