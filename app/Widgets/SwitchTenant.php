<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class SwitchTenant extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        if(!Auth::guest()){
            $getTenant = DB::table('user')
            ->join('user_role', 'user.id', '=', 'user_role.user_id')
            ->join('tenant','user_role.tenant_id','=','tenant.id')
            ->select('tenant.id as tenant_id','tenant.org_name as tenant_name','user_role.role_id')
            ->where('user.id','=',Auth::id())
            ->get();

            if(!Session::has('tenant_id')){
                Session::put('tenant_id',$getTenant[0]->tenant_id);
            } 

        }

        return view("widgets.switch_tenant",compact('getTenant'));
        // return view("widgets.switch_tenant", [
        //     'config' => $this->config,
        //     'getTenant' =>$getTenant
        // ]);
    }
}