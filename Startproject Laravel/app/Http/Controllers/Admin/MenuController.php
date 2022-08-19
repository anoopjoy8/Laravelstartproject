<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Admin;
use App\Models\SubMenu;
use App\Models\General;
use helpers;
use Illuminate\Support\Facades\Hash;


class MenuController extends Controller
{
    function Home()
    {
        $data                     = ['title' => 'Home'];
        $data['dashboard_list']   = Menu::get_dashboard_list();
        return view('admin.dashboard')->with($data);
    }

    function index(Request $request)
    {
        $data                  = ['title' => 'Menu Management', 'srch_div' => 'none'];
        $data['page']           = ($request->input('page')) ? $request->input('page') : 1;
        $data['add_div']       = "none";
        $data['dash_status']   = "";
        $data['accor_status']  = "true";
        $data['accor_show']    = "show";
        $data['count']         = General::get_count('left_main_menu');
        $search_array          = "";
        if (!empty($request->input('sr'))) {
            $name             = $request->input('menu_name');
            $parent_menu      = $request->input('parent_menu');
            $table_name       = $request->input('table_name');
            $search_array     = array("name" => $name, "table_name" => $table_name);
            $data['srch_div'] = "block";
        }
        $data['menu_list']     = Menu::get_menu_result($data['page'], $search_array);
        if (!empty($request->input('add'))) {
            $data['add_div']    = "block";
        }
        if (!empty($request->input('search'))) {
            $data['srch_div']    = "block";
        }
        if (($request->input('edit')) || ($request->input('edit_s'))) {
            $data['add_div'] = "block";
            if ($request->input('edit')) {
                $id = $request->input('edit');
                $result  = Menu::get_result($id);
            }
            if ($request->input('edit_s')) {
                $id = $request->input('edit_s');
                $result  = SubMenu::get_result($id);
            }
            $data['id']               = $id;
            $data['name']               = $result->name;
            $data['parent_menu']       = $result->menu_id;
            $data['url']               = $result->url;
            $data['icon']             = $result->icon;
            $data['menu_order']       = $result->menu_order;
            $data['table_name']       = $result->menu_table;
            $data['color']            = $result->menu_color;
            $data['set_home']         = $result->show_home;
            $data['active_url']       = $result->active_url;
        }
        return view('admin.menu')->with($data);
    }

    function Add(Request $request)
    {
        $data                  = ['title' => 'Add Menu', 'srch_div' => 'none'];
        $data['page']           = ($request->input('page')) ? $request->input('page') : 1;
        $data['add_div']       = "block";
        $data['dash_status']   = "";
        $data['accor_status']  = "true";
        $data['accor_show']    = "show";
        $method                = $request->method();
        $data['menu_list']     = Menu::get_menu_list($data['page'], "");
        $data['count']         = General::get_count('left_main_menu');
        if ($method == 'POST') {
            $data['name']               = $request->menu_name;
            $data['parent_menu']       = $request->parent_menu;
            $data['url']               = $request->url;
            $data['icon']             = $request->icon;
            $data['menu_order']       = $request->menu_order;
            $data['table_name']       = $request->table_name;
            $data['color']            = $request->color;
            $data['set_home']         = $request->set_home;
            $data['active_url']       = $request->active_url;
            $date                     = date('Y-m-d H:i:s');
            $val_array        = array(
                "name" => array($data['name'], 'name required'),
                "menu-order" => array(
                    $data['menu_order'],
                    'menu-order required'
                ),
                "icon" => array($data['icon'], 'Fa-icon required')
            );
            $data['error_msg'] = validation($val_array);
            if (empty($data['error_msg'])) {
                if ($data['parent_menu'] == 0) {
                    $new_order     = $this->orderSort($data['menu_order'], 0, 'i');
                    $insert_order  = Menu::insert_order_m($new_order);
                    $insert_array  = array(
                        "name" => $data['name'],
                        "url" => $data['url'],
                        "icon" => $data['icon'],
                        "menu_order" => $new_order,
                        "menu_table" => $data['table_name'],
                        "menu_color" => $data['color'],
                        "show_home" => $data['set_home'],
                        "active_url" => $data['active_url'],
                        "date_created" => $date
                    );
                    $db_table     = "left_main_menu";
                } else {
                    $new_order    = $this->orderSort($data['menu_order'], $data['parent_menu'], 'i');
                    $insert_order = SubMenu::insert_order_s($new_order, $data['parent_menu']);
                    $insert_array = array(
                        "name" => $data['name'],
                        "url" => $data['url'],
                        "menu_id" => $data['parent_menu'],
                        "icon" => $data['icon'],
                        "menu_order" => $data['menu_order'],
                        "menu_table" => $data['table_name'],
                        "active_url" => $data['active_url'],
                        "date_created" => $date
                    );
                    $db_table     = "left_sub_menu";
                }
                $insert_data  = Menu::insert_menu($insert_array, $db_table);
                if ($insert_data != "") {
                    session()->flash('success', 'Menu Created Successfully');
                    return redirect('admin/list-menu');
                }
            } else {
                session()->flash('error', $data['error_msg']);
            }
        }
        return view('admin.menu')->with($data);
    }
    function Update(Request $request)
    {
        $data                  = ['title' => 'Update Menu'];
        $data['page']          = ($request->input('page')) ? $request->input('page') : 1;
        $data['add_div']       = "block";
        $data['dash_status']   = "";
        $data['accor_status']  = "true";
        $data['accor_show']    = "show";
        $method                = $request->method();
        $data['menu_list']     = Menu::get_menu_list($data['page'], "");
        $data['count']         = General::get_count('left_main_menu');
        if ($method == 'POST') {
            $id                       = $request->id;
            $page                     = $request->page;
            $data['name']             = $request->menu_name;
            $data['parent_menu']      = $request->parent_menu;
            $data['url']              = $request->url;
            $data['icon']             = $request->icon;
            $data['menu_order']       = $request->menu_order;
            $data['table_name']       = $request->table_name;
            $data['color']            = $request->color;
            $data['set_home']         = $request->set_home;
            $data['active_url']       = $request->active_url;
            $date                     = date('Y-m-d H:i:s');
            $val_array        = array(
                "name" => array($data['name'], 'name required'),
                "menu-order" => array(
                    $data['menu_order'],
                    'menu-order required'
                ),
                "icon" => array($data['icon'], 'Fa-icon required')
            );
            $data['error_msg'] = validation($val_array);
            if (empty($data['error_msg'])) {
                if ($data['parent_menu'] == 0) {
                    $new_order     = $this->orderSort($data['menu_order'], 0, 'u');
                    $update_order  = Menu::update_order_m($new_order, $id);
                    $update_array  = array(
                        "name" => $data['name'],
                        "url" => $data['url'],
                        "icon" => $data['icon'],
                        "menu_order" => $new_order,
                        "menu_table" => $data['table_name'],
                        "menu_color" => $data['color'],
                        "show_home"  => $data['set_home'],
                        "active_url" => $data['active_url'],
                        "date_modified" => $date
                    );
                    $db_table     = "left_main_menu";
                } else {
                    $new_order    = $this->orderSort($data['menu_order'], $data['parent_menu'], 'u');
                    $update_order = SubMenu::update_order_s($new_order, $data['parent_menu'], $id);
                    //echo $update_order; exit();
                    $update_array = array(
                        "name" => $data['name'],
                        "url" => $data['url'],
                        "menu_id" => $data['parent_menu'],
                        "icon" => $data['icon'],
                        "menu_order" => $new_order,
                        "menu_table" => $data['table_name'],
                        "active_url" => $data['active_url'],
                        "date_modified" => $date
                    );
                    $db_table     = "left_sub_menu";
                }
                $update_data  = Menu::update_menu($update_array, $db_table, $id);
                if ($update_data != "") {
                    session()->flash('success', 'Menu Updated Successfully');
                    return redirect('admin/list-menu?page=' . $page);
                }
            } else {
                session()->flash('error', $data['error_msg']);
                if ($data['parent_menu'] == 0) {
                    return redirect('admin/list-menu?edit=' . $id . '&page=' . $page);
                } {
                    return redirect('admin/list-menu?edit_s=' . $id . '&page=' . $page);
                }
            }
        }
        return view('admin.menu')->with($data);
    }
    function Delete(Request $request)
    {
        $page   = $request->page;
        if ($request->m_id != "") {
            $id     = $request->m_id;
            $delete = Menu::delete_menu($id);
            $delete = SubMenu::delete_sub_menu($id);
        } else {
            $id     = $request->s_id;
            $delete = SubMenu::delete_menu($id);
        }
        if ($delete == "") {
            session()->flash('success', 'Menu Deleted Successfully');
            return redirect('admin/list-menu?page=' . $page);
        }
    }
    function changePassword(Request $request)
    {
        $data     = ['title' => 'Change Password'];
        $data['dash_status']   = "";
        $data['accor_status']  = "true";
        $data['accor_show']    = "show";
        $method                = $request->method();
        if ($method == 'POST') {
            $data['pass1']       = $request->pass1;
            $data['pass2']       = $request->pass2;
            $val_array        = array(
                "Password" => array($data['pass1'], 'Password required'),
                "password2" => array(
                    $data['pass2'],
                    'Repeat Password required'
                )
            );
            $data['error_msg'] = validation($val_array);
            if (empty($data['error_msg'])) {
                if($data['pass1'] == $data['pass2']){
                    $pass   = Hash::make($data['pass1']);
                    Admin::change_password($pass);
                    session()->flash('success', "password Changed Successfully");
                }
                else
                {
                    session()->flash('error', "passwords not matching");  
                }
            }
            else
            {
                session()->flash('error', $data['error_msg']);
            }
        }
        return view('admin.change-password')->with($data);
    }
    private function orderSort($order, $type, $operation)
    {
        if ($type == 0) {
            $greatest_order = Menu::greater_order_m();
        } else {
            $greatest_order = SubMenu::greater_order_s($type);
        }
        if ($order > $greatest_order) {
            if ($operation == "i") {
                $menu_order  = $greatest_order + 1;
            } else {
                $menu_order  = $greatest_order;
            }
        } else {
            $menu_order  = $order;
        }
        return $menu_order;
    }
}
