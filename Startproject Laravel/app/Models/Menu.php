<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Menu extends Model
{
    protected $table = 'left_main_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function get_dashboard_list()
    {
        $query = Menu::select('id', 'name', 'icon', 'menu_order', 'show_home', 'menu_color')
            ->where('show_home', 'yes')
            ->orderBy('menu_order', 'asc');
        return $query->get();
    }
    public static function get_menu_list()
    {
        $query = Menu::select('id', 'name', 'icon', 'menu_order', 'url', 'active_url')
            ->orderBy('menu_order', 'asc');
        return $query->get();
    }
    public static function insert_menu($fields, $dbtable)
    {
        $insert = DB::table($dbtable)->insert([
            $fields
        ]);
        return DB::getPdo()->lastInsertId();
    }
    public static function insert_order_m($new_order)
    {
        DB::statement('UPDATE left_main_menu SET menu_order = menu_order+1 WHERE menu_order  >=' . $new_order);
    }
    public static function update_order_m($new_order, $id)
    {
        $current_order = Menu::get_current_order_m($id);
        $current_order = $current_order->menu_order;
        if ($current_order > $new_order) {
            $current_order = $current_order - 1;
            DB::statement('UPDATE left_main_menu SET menu_order = menu_order+1 WHERE menu_order  <=' . $current_order . ' AND menu_order >=' . $new_order);
        } else {
            DB::statement('UPDATE left_main_menu SET menu_order = menu_order-1 WHERE menu_order  >' . $current_order . ' AND menu_order <=' . $new_order);
        }
    }
    public static function greater_order_m()
    {
        $order = menu::max('menu_order');
        return $order;
    }
    public static function delete_menu($id)
    {
        Menu::where('id', $id)
            ->delete();
    }
    public static function get_menu_result($page, $srch)
    {
        $offset = ($page - 1) * Config::get('constants.PG_LIMIT_AD');
        $query = Menu::select('id', 'name', 'icon', 'menu_order')
            ->orderBy('menu_order', 'asc');
        if (!empty($srch)) {
            if ($srch['name'] != "") {
                $query->where('name', 'like', '%' . $srch['name'] . '%');
            }
            if ($srch['table_name'] != "") {

                $query->where('menu_table', 'like', '%' . $srch['table_name'] . '%');
            }
        }
        return $query->offset($offset)
            ->limit(Config::get('constants.PG_LIMIT_AD'))
            ->get();
    }
    public static function update_menu($fields, $dbtable, $id)
    {
        $update = DB::table($dbtable)
            ->where('id', $id)
            ->update($fields);
        return DB::getPdo()->lastInsertId();
    }
    public static function get_result($id)
    {
        $query = Menu::where('id', $id);
        return $query->first();
    }
    public static function get_current_order_m($id)
    {
        $query = Menu::select('menu_order')
            ->where('id', $id);
        return $query->first();
    }
}
