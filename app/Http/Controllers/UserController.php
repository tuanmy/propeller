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
use URL;
use App\Http\Controllers\BaseController;
use Mail;

class UserController extends BaseController
{
    /**
     * Kiểm tra username có tồn tại hay không.
     * @param  array  $request
     * @return json 
     */
    protected $_user_id = null;
    public function __construct(){
        parent::__construct();
        $this->user_id = Auth::id();
    }

    public function resendemail($email){

        $active_code = str_random(60) . $email;
        $user = DB::table('user')
            ->where('email', $email)
            ->update(['active_code' => $active_code]);

        Mail::send('emails.active', array('active_code' => $active_code), function ($message) use($email){
            $message->to($email)->subject('Verify your email address');
        });

        \Session::flash('success','A verified email was sent your email.');
        return redirect()->route('auth.verify');  
    }
    
    public function active($active_code){
        if( ! $active_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::where('active_code','=',$active_code)->first();

        if ( ! $user)
        {
             \Session::flash('error','Invalid active code.');

            return redirect('/login');
           // throw new InvalidConfirmationCodeException;
        }

        $user->active = 1;
        $user->active_code = null;
        $user->save();
        // if(\Session::has('email_verify')) {
        //     \Session::forget('email_verify');
        // }
        \Session::flash('success','You have successfully verified your account.');

        return redirect('/home');
    }

    public function checkExistUsername(Request $request){
    	if ($request->ajax()) {
    		$username = $request->username;
    		$check = User::where('username','=',$username)->get()->toArray();
    		if(count($check) == 0) {
    			echo json_encode(array(
					    'valid' => true,
				));
				die;
				//die('not exist');
    		}
    		else {
    			echo json_encode(array(
					    'valid' => false,
				));
				die;
    			//die('exist');
    		}
    	}
    }

      /**
     * Bỏ qua validator username tồn tại của tài khoản đang login hiện tại
     * @param  array  $request
     * @return json 
     */
    public function checkExistUsernameIgnore(Request $request){
        if ($request->ajax()) {
            $username = $request->username;
            //$check = User::where('username','=',$username)->get()->toArray();
            //$check = User::where(['username'=>'unique:user,id,'.$this->user_id])->get()->toArray();
            $check = User::where('username','=',$username)
                           ->where('id','<>',$this->user_id)->get()->toArray();
            if(count($check) == 0) {
                echo json_encode(array(
                        'valid' => true,
                ));
                die;
                //die('not exist');
            }
            else {
                echo json_encode(array(
                        'valid' => false,
                ));
                die;
                //die('exist');
            }
        }
    }

      /**
     * Bỏ qua validator username tồn tại của tài khoản đang được cập nhật
     * @param  array  $request
     * @return json 
     */
    public function checkeuEditProfile(Request $request){
        if ($request->ajax()) {
            $username = $request->username;
            $userid  = $request->user_id;
                $check = User::where('username','=',$username)
                               ->where('id','<>',$userid)->get()->toArray();
                if(count($check) == 0) {
                    echo json_encode(array(
                            'valid' => true,
                    ));
                    die;
                    //die('not exist');
                }
                else {
                    echo json_encode(array(
                            'valid' => false,
                    ));
                    die;
                    //die('exist');
                }
            }
    }
    


     /**
     * Kiểm tra email có tồn tại hay không.
     * @param  array  $request
     * @return json 
     */
    public function checkExistEmail(Request $request){
    	if ($request->ajax()) {
    		$email = $request->email;
    		$check = User::where('email','=',$email)->get()->toArray();
    		if(count($check) == 0) {
    			echo json_encode(array(
					    'valid' => true,
				));
				die;
				//die('not exist');
    		}
    		else {
    			echo json_encode(array(
					    'valid' => false,
				));
				die;
    			//die('exist');
    		}
    	}
    }

    public function getCreate(){
        if(\Session::get('role') == ROLE_ADMIN){
            $roleList = Role::all();
            return view('user.create',compact('roleList'));
        }
        else 
            //return \Redirect::route('user.create'); <---- OK
            return redirect('/home');
        
    }

    public function postCreate(UserRequest $request){
        $this->validate($request, [
            'role' => 'required',
        ]);
        // create new user in user table
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $new_user_id = $user->id;

        //save role of user in tenant
        //$tenant_id = Person::where('user_id','=',$this->user_id)->first()->tenant_id;
        $tenant_id = \Session::get('tenant_id');
        $user_role = new User_Role();
        $user_role->user_id = $new_user_id;
   
        $user_role->role_id =  $request->role;
        $user_role->tenant_id =  $tenant_id;
        $user_role->save();

        //create new person in person table
        $person = new Person();
        $person->user_id = $new_user_id;
        $person->tenant_id =  $tenant_id;
        $person->save();

        return $this->getCreate();

    }
    public function getInfoUser(Request $request){

        // if ($request->ajax()) {
        //     $email = $_POST['email'];
        //     $user = DB::table('user')
        //     ->join('person', 'user.id', '=', 'person.user_id')
        //     ->select('firstname', 'lastname', 'middle','email')
        //     ->where('email','=',$email)
        //     ->first();
        //     echo json_encode($user);
        // }
        $role_id = null;
        if ($request->ajax()) {
            $roleList = Role::all();
            $email = $_POST['email'];
            $user = DB::table('user')
            ->join('person', 'user.id', '=', 'person.user_id')
            ->select('firstname', 'lastname', 'middle','email','user.id as userid')
            ->where('email','=',$email)
            ->first();
            $myemail = User::find($this->user_id)->email;
            if($myemail == $user->email) {
                $owner = true;
            }
            else {
                $owner =false;
                   // kiểm tra xem user đã tồn tại trong tenant chưa
                $userInfo = User::where('email','=',$request->email)->first();

                // $person = Person::where('user_id','=',$this->user_id)->first();
                // $tenant_id = $person->tenant_id;
                $tenant_id = \Session::get('tenant_id');


                $check = User_Role::where('user_id','=',$userInfo->id)
                                    ->where('tenant_id','=',$tenant_id)
                                    ->first();


                if(count($check) > 0) {
                    // đã tồn tại -> set lại role
                    $role_id = User_Role::where('user_id','=',$userInfo->id)
                                        ->where('tenant_id','=',$tenant_id)
                                        ->first()->role_id;
                }

            }
            return view('user.infouser',compact('user','roleList'))->with(array('owner'=>$owner,'role_id'=>$role_id));
        }

    }


    /**
     * Hiển thị thông tin của user hiện tại - my profile
     * @param  $request,$id
     * @return 
     */
    public function getProfile($id){
        //$item = User::find($id);
        $item =  DB::table('user')
            ->join('person', 'user.id', '=', 'person.user_id')
            ->select('user.id','username','firstname','lastname','phone','middle')
            ->where('person.user_id','=',$this->user_id)
            ->first();
        return view('user.editprofile',compact('item'));
    }

    /**
     * Cập nhật lại thông tin của user (update my profile)
     * @param  $request,$id
     * @return 
     */
    public function postProfile(Request $request,$id){

        $this->validate($request, [
            'username' => 'required',
        ]);

        $user = User::find($id);

        $user->username = $request->username;
        $user->save();

        $person = Person::where('user_id','=',$id)
                         ->update([
                            'firstname'=>$request->firstname,
                            'lastname' =>$request->lastname,
                            'middle' =>$request->middle,
                            'phone' =>$request->phone
                        ]);

        \Session::flash('message','Update successful!');
        return $this->getProfile($id);
    }

     /**
     * Hiển thị thông tin cần chỉnh sửa của user được quản lý
     * @param  $id
     * @return 
     */
    function getEditProfile($id){
        //lấy tenant hiện tại
        // $person = Person::where('user_id','=',$this->user_id)->first();
        // $tenant_id = $person->tenant_id;

        if(\Session::get('role') == ROLE_ADMIN){
            $tenant_id = \Session::get('tenant_id');

               $roleList = Role::all();
               $item =  DB::table('user')
                ->join('person', 'user.id', '=', 'person.user_id')
                ->join('user_role','user.id','=','user_role.user_id')
                ->select('user.id','username','firstname','lastname','phone','middle','user_role.role_id')
                ->where('user_role.user_id','=',$id)
                ->where('user_role.tenant_id','=',$tenant_id)
                ->first();
                if($item == null) {
                    \Session::flash('error','User does not exist!');
                    return redirect('/home')  ;
                }
            return view('user.admineditprofile',compact('item','roleList'));
        }
        else {
            \Session::flash('error','You do not have this permission!');
            return redirect('/home');
        }
    }

     /**
     * Thực hiện chỉnh sửa của user được quản lý
     * @param  $request,$id
     * @return 
     */
    function postEditProfile(Request $request, $id){
        // $person = Person::where('user_id','=',$this->user_id)->first();
        // $tenant_id = $person->tenant_id;
         $tenant_id = \Session::get('tenant_id');

        $this->validate($request, [
            'username' => 'required',
        ]);

        $user = User::find($id);

        $user->username = $request->username;
        $user->save();

        $person = Person::where('user_id','=',$id)
                         ->update([
                            'firstname'=>$request->firstname,
                            'lastname' =>$request->lastname,
                            'middle' =>$request->middle,
                            'phone' =>$request->phone
                        ]);
        $user_role = User_Role::where('user_id','=',$id)
                                ->where('tenant_id','=',$tenant_id)
                                ->update([
                                    'role_id'=>$request->role,
                                ]); 

        \Session::flash('message','Update successful!');
        return redirect('/home');
    }

    /**
     * Lấy tất cả những user thuộc tenant của user hiện tại
     * ngược lại add vào tenant va set role
     * @param  
     * @return view('user.usersametenant')
     */
    public function getUserSameTenant(){
        if(\Session::get('role') == ROLE_ADMIN){
            // $item = Person::where('user_id','=',$this->user_id)->first();
            // $tenant_id = $item->tenant_id;
            $tenant_id = \Session::get('tenant_id');

            $listItem =  DB::table('user')
                ->join('person', 'user.id', '=', 'person.user_id')
                ->join('user_role','user.id','=','user_role.user_id')
                ->select('user.id','username','firstname','lastname','phone','middle','user_role.tenant_id as tenantid','email')
                ->where('user_role.tenant_id','=', $tenant_id)
                ->where('user_role.user_id','<>',$this->user_id)
                ->get();

            return view('user.usersametenant',compact('listItem'));
        }
        else {
       
            return redirect('/home');
        }
            
    }


    /**
     * Thêm user vào tenant, nếu tồn tại trong tenant rồi thì update role, 
     * ngược lại add vào tenant va set role
     * @param  array  $request
     * @return view('user.usersametenant')
     */
    public function addUserExist(Request $request){
        // lấy tenant mà user hiện tại là admin
        // $item = Person::where('user_id','=',$this->user_id)->first();
        // $tenant_id = $item->tenant_id;
        $tenant_id = \Session::get('tenant_id');
        // kiểm tra xem user đã tồn tại trong tenant chưa
        $check = User_Role::where('user_id','=',$request->user_id)
                            ->where('tenant_id','=',$tenant_id)
                            ->get();
        if(count($check) > 0) {

            // đã tồn tại -> set lại role
             DB::table('user_role')
               
                ->where('user_id','=',$request->user_id)
                ->where('tenant_id','=',$tenant_id)
                ->update(['role_id' => $request->role]);
        }
        else {
            // add vao tenant
            $user_role = new User_Role();
            $user_role->user_id = $request->user_id;
            $user_role->role_id = $request->role;
            $user_role->tenant_id =  $tenant_id;
            $user_role->save();
        }
        return $this->getUserSameTenant();
    }
}
