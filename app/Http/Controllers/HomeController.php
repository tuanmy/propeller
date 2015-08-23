<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRequest;
use App\User_Role;
use App\Person;
use App\Tenant;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use DB;
use Redirect; 
use Session;
use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
	protected $_user_id = null;
    public function __construct() {

        parent::__construct(); 

        $this->middleware('auth');
        $this->user_id = Auth::id();
    }

    public function index(){
        return  view("home.index");
    }

    public function changeTenant(Request $request){
    	Session::put('tenant_id',$request->select_tenant);
           $tenant_id = Session::get('tenant_id');

          $role = DB::table('user_role')
            ->select('user_role.role_id')
            ->where('user_role.user_id','=',Auth::id())
            ->where('tenant_id','=',$tenant_id)
            ->first();

            Session::put('role',$role->role_id);
            
    	return Redirect::back();
    	//return $this->index();

    }
        
    public function test(){        
       return view("test", ["title" => "test"]);
    }
}
