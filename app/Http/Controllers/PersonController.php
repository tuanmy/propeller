<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Person;
use App\Http\Requests\PersonRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Tenant;

class PersonController extends BaseController
{

    protected $_user_id = null;
    public function __construct(){
        $this->user_id = Auth::id();
    }

     /**
     * Tạo mới Person.
     * @param  array  $request
     * @return view person create
     */
    public function postCreate(PersonRequest $request)
    {

        $person = new Person();
        $person->firstname =  $request->firstname;
        $person->lastname =  $request->lastname;
        $person->middle =  $request->middle;
        if($this->user_id != null ) {
            $person->user_id = $this->user_id;
        }
        $person->tenant_id = $request->tenant_id;
        $person->save();
        $id = $person ->id;
        if($id)  \Session::flash('message','Thêm thành công!');
        return $this->getCreate();
    }
    /**
     * Hiển thị giao diện tạo Person.
     * @param  
     * @return view person create
     */
    public function getCreate(){
        $listTenant = Tenant::all();
        return view("person.create",compact('listTenant'));
    }


}
