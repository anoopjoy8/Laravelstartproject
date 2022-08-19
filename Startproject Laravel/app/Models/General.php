<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;
Use Config;

class General extends Model
{
    protected $table = 'left_main_menu';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function get_count($tb_name)
    {
        $count = DB::table($tb_name)->count();
        return $count;
    }
}
