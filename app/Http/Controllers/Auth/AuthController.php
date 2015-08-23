<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tenant;
use App\Organization;
use App\Person;
use App\User_Role;
use Session;
use Mail;
use Illuminate\Contracts\Mail\Mailer;
use App\Http\Controllers\BaseController;

class AuthController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $redirectTo ="/home";
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        parent::__construct();
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       
        return Validator::make($data, [
            'username' => 'required|max:255|unique:user',
            'email' => 'required|email|max:255|confirmed|unique:user',
            //'password' => 'required|confirmed|min:7|regex:',
            'password' =>array('required','confirmed','min:7','regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,}$/'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * Tạo Organization, tạo Tenant và Person thuộc tenant vừa tạo
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
       $org = Organization::create([
            'name' =>$data['org_name'],
        ]);

        $tenant = Tenant::create([
            'org_name'     => $data['org_name'],
            'subscription' => $data['subscription'],
            'org_id'       => $org->id,
            'billing_method' => $data['billing_method']
        ]);

     
        $active_code = str_random(60) . $data['email'];

        $user = User::create([
            'username'      => $data['username'],
            'email'         => $data['email'],
            'password'      => bcrypt($data['password']),
            'active_code'   => $active_code
        ]);

        if($user->id) {
           Mail::send('emails.active', array('active_code' =>$active_code), function ($message) use ($user) {
  
                $message->to($user->email)->subject('Verify your email address');
            });
            // \Session::flash('notification_verify','Please activate your account to proceed!');
        }

        $user_role = User_Role::create([
            'user_id' => $user->id,
            'tenant_id' => $tenant->id,
            'role_id' => 'role-admin',
        ]);

        Person::create([
            'user_id' => $user->id,
            //'tenant_id' =>  $tenant->id,

        ]);

       
        if($user->id) {
            \Session::flash('success','Create account successful!');
        }
        else {
            \Session::flash('error','Action error!');
        }
        //return $user;
    }

 

    public function postRegister(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->create($request->all());
        //Auth::login($this->create($request->all()));
        return redirect('/login');

        //return redirect($this->redirectPath());
    }

    public function getLogout()
    {
        if (Auth::user()){
            if(Session::has('tenant_id'))  {
                Session::forget('tenant_id');
            } 
            Auth::logout();
            return  view("auth.logout");

        }
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {

        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);


        // xem có block hay chưa, nếu chưa thi check count
        $user = User::where('email','=',$request->email)->first();
        if($user && $user->count_fail == 3) {
            \Session::flash('block','Block message');
             return redirect()->route('auth.block');
        }
        // if((\Session::has('block') && \Session::get('block') != $request->email) || $user->count_fail == 10) {
        //     //if(!\Session::has('block')) {
        //         \Session::put('block',$request->email);
        //     //}
        //     //show block và link reset password
        //     \Session::flash('block','Block message');
        //     return redirect($this->loginPath());
        // }

     
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

         $throttles = $this->isUsingThrottlesLoginsTrait();

        // if ($throttles && $this->hasTooManyLoginAttempts($request)) {
        //     return $this->sendLockoutResponse($request);
        // }

        $credentials = $this->getCredentials($request);


        if (Auth::attempt($credentials, $request->has('remember'))) {
            /**
             * save default role for the 
             */
                // $active = Auth::user()->active;
                // if($active == 0 || $active == null) {
                //     $email = Auth::user()->email;
                //     \Session::flash('verify','Verify email');
                //     Auth::logout(); 
                //     return view('auth.login',['emailverify' => $email]);
                // }
            $role = \DB::table('user_role')
                ->select('user_role.role_id')
                ->where('user_role.user_id','=',Auth::id())
                ->first();
                Session::put('role',$role->role_id);

                // trả về lỗi bằng 0
                User::where('id','=',Auth::id())
                        ->update(['count_fail'=> 0]);

            $active = Auth::user()->active;
            if($active == 0 || $active == null){
                $now = date('Y-m-d H:i:s');
                $created_at = Auth::user()->created_at;
                $total      =  strtotime($now ) - strtotime($created_at );
                $hours      = floor($total / 60 / 60);
                if($hours > 24) {
                    $email = Auth::user()->email;
                    //\Session::put('email_verify',$email);
                    return redirect()->route('auth.verify');     
                }
            }
               
              
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // update count_fail
        if($user){
            $user->count_fail+=1;
            $user->save();
        }


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.

        // if ($throttles) {
        //     $this->incrementLoginAttempts($request);
        // }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => 'Email and password do not match or you do not have an account yet.' //$this->getFailedLoginMessage(),
            ]);
    }
    public function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/login';
    }

}
