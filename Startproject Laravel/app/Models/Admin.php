<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;
use Config;

class Admin extends Model
{
    protected $table = 'admin_users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function get_user($username, $password)
    {
        $query      = Admin::where('user_name', $username)
            ->first();
        $result     = array();
        if (!empty($query)) {
            $pass_check =  Hash::check($password, $query->password);
            if ($pass_check == 1) {
                $user_id    = $query->id;
                $user_name  = $query->user_name;
                $user_type  = $query->user_type;
                $date       = date('Y-m-d H:i:s');
                Admin::where('id', $user_id)
                    ->update(['last_logged_in' => $date]);
                $result = array("user_id" => $user_id, "user_type" => $user_type);
            }
        } else {
            $result = "";
        }
        return $result;
    }
    public static function insert_user($fields, $dbtable)
    {
        $insert = DB::table($dbtable)->insert([
            $fields
        ]);
        return DB::getPdo()->lastInsertId();
    }
    public static function update_user($fields, $dbtable, $id)
    {
        $update = DB::table($dbtable)
            ->where('id', $id)
            ->update($fields);
        return DB::getPdo()->lastInsertId();
    }
    public static function delete_admin($id)
    {
        Admin::where('id', $id)
            ->delete();
    }
    public static function get_admin_result($page, $srch)
    {
        $offset = ($page - 1) * Config::get('constants.PG_LIMIT_AD');
        $query = Admin::select('id', 'user_name', 'password', 'status', 'user_type')
            ->orderBy('id', 'asc');

        if (!empty($srch)) {
            if ($srch['user_name'] != "") {
                $query->where('user_name', 'like', '%' . $srch['user_name'] . '%');
            }
            if ($srch['user_type'] != "") {

                $query->where('user_type', $srch['user_type']);
            }
        }
        //print_r($query->toSql()); exit();            
        return $query->offset($offset)
            ->limit(Config::get('constants.PG_LIMIT_AD'))
            ->get();
    }
    public static function changeStatus($status, $id)
    {
        if ($status == "active") {
            $stat = "inactive";
        } else {
            $stat  = "active";
        }
        Admin::where('id', $id)
            ->update(['status' => $stat]);
    }
    public static function get_result($id)
    {
        $query = Admin::where('id', $id);
        return $query->first();
    }
    public static function change_password($password)
    {
        $user_id    = session()->get('start_project_adminid');
        Admin::where('id', $user_id)
            ->update(['password' => $password]);
    }
    public static function get_logout($id)
    {
        $date       = date('Y-m-d H:i:s');
        Admin::where('id', $id)
            ->update(['last_logged_out' => $date]);
    }
}
