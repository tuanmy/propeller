<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use App\library\lessc;

class BaseController extends Controller
{
	protected function __construct(){
          //auto compile les -> css
          try{
            $css_path = base_path().'/../'.'assets'.DIRECTORY_SEPARATOR.'css';
            $css_compiled_path = $css_path.DIRECTORY_SEPARATOR.'compiled'.DIRECTORY_SEPARATOR;
            $less_path = $css_path.DIRECTORY_SEPARATOR.'less'.DIRECTORY_SEPARATOR.'style.less';
            $less = new lessc;
            $less->checkedCompile($less_path, $css_compiled_path.'style.css');
          }  catch (\Exception $e){
              //var_dump($e);
          }
	}
    
}
