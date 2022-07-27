<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;
use Hash;
Use Config;

class Page extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function insert_page($fields,$dbtable)
    {
        $insert = DB::table($dbtable)->insert([
            $fields
        ]);
        return DB::getPdo()->lastInsertId();
    }
    public static function update_page($fields,$dbtable,$id)
    {
        $update = DB::table($dbtable)
                ->where('id',$id)
                ->update($fields);
                return DB::getPdo()->lastInsertId();
    }
    public static function get_page_result($page,$srch)
    {
        $offset= ($page-1) * Config::get('constants.PG_LIMIT_AD');
        $query = Page::select('id','title','description','image') 
                                 ->orderBy('id','asc');
                                
        if(!empty($srch))
        {
            if($srch['title'] !="")
            {
                $query->where('title','like','%'.$srch['title'].'%');
            } 
        }  
        //print_r($query->toSql()); exit();            
        return $query ->offset($offset)
                      ->limit(Config::get('constants.PG_LIMIT_AD'))
                      ->get();
    }
    public static function get_result($id)
    {
        $query = Page::where('id',$id);
        return $query->first();
    }
    public static function Existance($title)
    {
        if (Page::where('title', $title )->exists()) 
        {
            return "true";
        }
        else
        {
            return "false";
        }
    }
    public static function Existance_update($id,$title)
    {
        $query = Page::where('title',$title)
                     ->where('id', '!=', $id)  
                     ->get();
        $ResCount = $query->count();
        return $ResCount;

    }
    public static function get_image_name($id)
    {
        $query = Page::select('image')
                ->where('id',$id);
        return $query->first();        
    }
    public static function get_sub_image_name($id)
    {
        $query =  DB::table('page_images')
                ->select('image','id','page_id')
                ->where('id',$id);
        return $query->first();        
    }
    public static function get_subimages($id)
    {
        $images = DB::table('page_images')
        ->select('image','id','page_id')
        ->where('page_id',$id)
        ->get(); 
        return $images;
    }
    public static function delete_subimage($id)
    {
        DB::table('page_images')
        ->where('id', $id)
        ->delete();
    }
    public static function delete_page($id)
    {
        DB::table('pages')
        ->where('id', $id)
        ->delete();
    }
    public static function delete_sub_page($id)
    {
        DB::table('page_images')
        ->where('page_id', $id)
        ->delete();
    }
    public static function Sub_imageadd($files,$id)
    {
        foreach ($files as $key=>$value) 
        {
            DB::table('page_images')->insert([
                'image' => $value,
                'page_id' => $id
            ]);
        }
    }
}

