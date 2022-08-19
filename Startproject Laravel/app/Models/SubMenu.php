<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;

class SubMenu extends Model
{
    protected $table = 'left_sub_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function get_sub_list($id)
    {
        $query = SubMenu::where('menu_id', $id)
                       ->select('id','name','menu_id','url','menu_order') 
                       ->orderBy('menu_order','asc');
        return $query->get();
    }
    public static function insert_order_s($new_order,$menu_id)
    {
        DB::statement('UPDATE left_sub_menu SET menu_order = menu_order+1 WHERE menu_order  >='.$new_order.' AND menu_id ='.$menu_id);     
    }   
    public static function greater_order_s($id)
    {
        $order = SubMenu::where('menu_id', $id)
                        ->max('menu_order');
        return $order;  
    }
    public static function delete_menu($id)
    {
        SubMenu::where('id', $id)
              ->delete();
    }
    public static function delete_sub_menu($id)
    {
        SubMenu::where('menu_id', $id)
                        ->delete();
    }
    public static function update_order_s($new_order,$p_id,$id)
    {
        $current_order = SubMenu::get_current_order_s($id,$p_id);
        $current_order = $current_order->menu_order;
        if($current_order > $new_order)
        { 
            $current_order = $current_order-1;
            DB::statement('UPDATE left_sub_menu SET menu_order = menu_order+1 WHERE menu_order  <='.$current_order.' AND menu_order >='.$new_order.' AND menu_id ='.$p_id);
        }
        else
        {
            DB::statement('UPDATE left_sub_menu SET menu_order = menu_order-1 WHERE menu_order  >'.$current_order.' AND menu_order <='.$new_order.' AND menu_id ='.$p_id);
        }     
    }
    public static function get_result($id)
    {
        $query = SubMenu::where('id',$id);
        return $query->first();
 
    }
    public static function get_current_order_s($id,$p_id)
    {
        $query = SubMenu::select('menu_order')
                          ->where('menu_id',$p_id)
                          ->where('id',$id);
        return $query->first();
    }  
}
