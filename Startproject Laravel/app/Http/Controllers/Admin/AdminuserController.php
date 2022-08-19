<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\General;
use Hash;
use Session;

class AdminuserController extends Controller
{
	function index(Request $request)
	{
		$data          = ['title' => 'Login'];
		$method        = $request->method();
		if (isset($_COOKIE['start_project_ad'])) {
			$data['rem']      = "on";
			$data['username'] =  $_COOKIE['start_project_ad'];
			$data['password'] =  $_COOKIE['start_project_sec'];
		} else {
			$data['rem'] = "";
			$data['username'] = "";
			$data['password'] = "";
		}
		if ($method == 'POST') {
			$username	  = $request->username;
			$password 	  = $request->password;
			$remember 	  = $request->remember;
			$val_array    = array(
				"username" => array($username, 'name required'),
				"password" => array($password, 'Password required')
			);
			$data['error_msg'] = validation($val_array);
			if (empty($data['error_msg'])) {
				$user    = Admin::get_user($username, $password);
				if (!empty($user)) {
					if ($remember == 'on') {
						$this->makeCookie($username, $password);
					} else {
						$this->forgetCookie($username, $password);
					}
					$request->session()->put('start_project_adminuser', $username);
					$request->session()->put('start_project_adminid', $user['user_id']);
					$request->session()->put('start_project_admintype', $user['user_type']);
					return redirect('admin/dashboard');
				} else {
					session()->flash('error', 'Credentials not matching');
				}
			} else {
				session()->flash('error', $data['error_msg']);
			}
		}

		//echo Cookie::get('swebin_user_ad');

		return view('admin.login')->with($data);
	}
	function users(Request $request)
	{
		$data               = ['title' => 'Admin Users', 'srch_div' => 'none'];
		$data['add_div']    = "none";
		$data['page']       = ($request->input('page')) ? $request->input('page') : 1;
		$data['count']      = General::get_count('admin_users');
		$search_array       = "";
		if (!empty($request->input('sr'))) {
			$data['user_name']        = $request->input('username');
			$data['user_type']        = $request->input('user_type');
			$search_array     = array("user_name" => $data['user_name'], "user_type" => $data['user_type']);
			$data['srch_div'] = "block";
		}
		if (!empty($request->input('search'))) {
			$data['srch_div']    = "block";
		}
		if (!empty($request->input('status'))) {
			$status  		= $request->input('status');
			$id      		= $request->input('id');
			$page      		= $request->input('page');
			$change_status  = Admin::changeStatus($status, $id);
			if ($change_status == "") {
				session()->flash('success', 'Admin user status updated successfully');
				return redirect('admin/list-admin?page=' . $page);
			}
		}
		if (!empty($request->input('add'))) {
			$data['add_div']    = "block";
		}
		if ($request->input('edit')) {
			$data['add_div'] = "block";
			$id              = $request->input('edit');
			$result          = Admin::get_result($id);
			$data['id']               = $id;
			$data['user_name'] 	      = $result->user_name;
			$data['user_type'] 	      = $result->user_type;
		}
		$data['admin_list'] = Admin::get_admin_result($data['page'], $search_array);
		return view('admin.adminUsers')->with($data);
	}
	function Add(Request $request)
	{
		$data                  = ['title' => 'Add Admin', 'srch_div' => 'none'];
		$data['page']		   = ($request->input('page')) ? $request->input('page') : 1;
		$data['add_div']       = "block";
		$search_array          = "";
		$method                = $request->method();
		$data['count']         = General::get_count('admin_users');
		$data['admin_list']    = Admin::get_admin_result($data['page'], $search_array);
		if ($method == 'POST') {
			$data['user_name'] 	      = $request->user_name;
			$data['user_type'] 	      = $request->user_type;
			$data['password'] 	      = $request->password;
			$pass                     = Hash::make($data['password']);
			$date                     = date('Y-m-d H:i:s');
			$val_array        = array(
				"user_name" => array($data['user_name'], 'user name required'),
				"user_type" => array(
					$data['user_type'],
					'select user type required'
				),
				"password" => array($data['password'], 'Password required')
			);
			$data['error_msg'] = validation($val_array);
			if (empty($data['error_msg'])) {
				$insert_array  = array(
					"user_name" => $data['user_name'],
					"user_type" => $data['user_type'],
					"password" => $pass,
					"created" => $date
				);
				$db_table      = "admin_users";
				$insert_data  = Admin::insert_user($insert_array, $db_table);
				if ($insert_data != "") {
					session()->flash('success', 'Admin User Created Successfully');
					return redirect('admin/list-admin');
				}
			} else {
				session()->flash('error', $data['error_msg']);
			}
		}
		return view('admin.adminUsers')->with($data);
	}
	function Update(Request $request)
	{
		$data                  = ['title' => 'Update Admin'];
		$data['page']		   = ($request->input('page')) ? $request->input('page') : 1;
		$data['add_div']       = "block";
		$method                = $request->method();
		$search_array          = "";
		$data['admin_list']    = Admin::get_admin_result($data['page'], $search_array);
		$data['count']         = General::get_count('admin_users');
		if ($method == 'POST') {
			$id                       = $request->id;
			$page                     = $request->page;
			$data['user_name'] 	      = $request->user_name;
			$data['user_type'] 	      = $request->user_type;
			$data['password'] 	      = $request->password;
			if ($data['password'] != "") {
				$pass                 = Hash::make($data['password']);
			}
			$val_array        = array(
				"user_name" => array($data['user_name'], 'user name required'),
				"user_type" => array(
					$data['user_type'],
					'select user type'
				)
			);
			$data['error_msg'] = validation($val_array);
			if (empty($data['error_msg'])) {
				if ($data['password'] != "") {
					$update_array  = array(
						"user_name" => $data['user_name'],
						"user_type" => $data['user_type'],
						"password" => $pass
					);
				} else {
					$update_array  = array(
						"user_name" => $data['user_name'],
						"user_type" => $data['user_type']
					);
				}
				$db_table      = "admin_users";
				$update_data   = Admin::update_user($update_array, $db_table, $id);
				if ($update_data != "") {
					session()->flash('success', 'Admin User Updated Successfully');
					return redirect('admin/list-admin?page=' . $page);
				}
			} else {
				session()->flash('error', $data['error_msg']);
				return redirect('admin/list-admin?edit=' . $id . '&page=' . $page);
			}
		}
		return view('admin.adminUsers')->with($data);
	}
	function Delete(Request $request)
	{
		$page   = $request->page;
		if ($request->id != "") {
			$id     = $request->id;
			$delete = Admin::delete_admin($id);
		}
		if ($delete == "") {
			session()->flash('success', 'Admin User Deleted Successfully');
			return redirect('admin/list-admin?page=' . $page);
		}
	}
	function Logout(Request $request)
	{
		Admin::get_logout(session()->get('start_project_adminid'));
		$request->session()->forget(['start_project_adminuser', 'start_project_adminid']);
		$request->session()->flush();
		return redirect('admin/login');
	}
	private function makeCookie($username, $password)
	{
		$expire = time() + 365 * 60 * 60 * 24;
		setcookie('start_project_ad', $username, $expire, '/');
		setcookie('start_project_sec', $password, $expire, '/');
	}
	private function forgetCookie($username, $password)
	{
		setcookie('start_project_ad', '', time() - 3600, '/');
		setcookie('start_project_sec', '', time() - 3600, '/');
	}
}
