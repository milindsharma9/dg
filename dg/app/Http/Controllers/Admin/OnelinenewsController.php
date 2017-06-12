<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\News;
use Illuminate\Support\Facades\File as LaraFile;
use DB;
//use Illuminate\Support\Facades\DB;
use Auth;

use Exception;

#use Intervention\Image\Facades\Image;
#use App\Http\Helper\FileUpload;
use Input;
//use Validator;
use Redirect;
//use Request;file" => "required|mimes:pdf|max:10000"
use Session;

class OnelinenewsController extends Controller
{
    //
    
     private $paginatorvalue;
    
    public function __construct() {
        $this->paginatorvalue = \Config::get('appConstants.paginatorvalue');
        if (Auth::user()->fk_users_role == \Config::get('appConstants.admin_role_id')) {
            $this->currentUserTemplate = 'admin';
        }
    }
    
    public function index() {
        $params = null;
        if (Input::has('title')){
        
            $params['title'] = Input::get('title');
        
        }
        
        $data =  DB::table('onelinenews');
        if($params!=null && count($params)>0 && trim($params['title'])!=''){
                        $data->where('title','LIKE',"%" .$params['title'] . "%");
          }
        $blog = $data->paginate($this->paginatorvalue);
        if (Input::has('title')){
             $blog->appends( Input::only('title') ); 
        }
          /*  $blog->appends(array(
    'date-from' => Input::get('date-from'),
    'date-to'   => Input::get('date-to'),

           * 
           * or 
           * $searchResult->appends( Input::only('data-from', 'date-to') ); 
           *            */
        //echo "<pre/>"
       
        return view('admin.onelinenews.index', compact('blog'));
    }
     public function create() {
        return view('admin.onelinenews.create');
    }
    
     public function store(Request $request) {
        
        try {
/*
        $file = array('image' => Input::file('image'));
        // getting all of the post data
        $file = array('image' => Input::file('image'));*/
        // setting up rules
        $rules = array('title' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                            ->back()
                            ->withInput($request->all())
                            ->withErrors($validator);
        } else {
            // die("ooooppppp");
            // checking file is valid.
            
               
                $userData = array();
                $userData['title'] = $request->input('title');
               
                

                if ($request->published) {
                    $userData['published'] = 1;
                } else {
                    $userData['published'] = 0;
                }
                DB::table('onelinenews')->insert($userData);
                $request->session()->flash('message', 'Marquee news added successfully!');
                return redirect()->route('admin.onelinenews.index');
               
          
        }

        /*
          $product = new Product(array(
          'name' => $request->get('name'),
          'sku'  => $request->get('sku')
          ));

          $product->save();

         */
        } catch (Exception $ex) {
            return redirect()->route($this->currentUserTemplate.'.onelinenews.index')->withErrors(trans('admin/onelinenews.not_exists'));
        }
        
    }
    
    
    public function edit($id) {
        $manualData = DB::table('onelinenews')->where('id',  $id)->get();
        
       // echo "<pre/>";
      // print_r($manualData[0]->id);die;
        return view('admin.onelinenews.edit', ['onelinenews'=>$manualData[0]]);
        
    }
    
    public function update($id, Request $request) {
       
        try {
        
       
            $rules = array('title' => 'required');
            
      
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                            ->back()
                            ->withInput($request->all())
                            ->withErrors($validator);
        } else {
            $userData = array();
           
            
            
                $userData['title'] = $request->input('title');
               
                

                if ($request->published) {
                    $userData['published'] = 1;
                } else {
                    $userData['published'] = 0;
                }
                
                DB::table('onelinenews')
            ->where('id', $id)
            ->update($userData);
            
            
            $request->session()->flash('message', 'Marquee news details updated successfully!');
        return redirect()->route('admin.onelinenews.index');
        }
        
        
        
        } catch (Exception $ex) {
            return redirect()->route($this->currentUserTemplate.'.onelinenews.index')->withErrors(trans('admin/onelinenews.not_exists'));
        }
        
    }
    
    public function destroy($id){
        //echo $id;die;
        try {
            
                  //  $manualData = DB::table('onelinenews')->where('id',  $id)->get();
                    
                    DB::table('onelinenews')->where('id', '=', $id)->delete();
                    echo "1"; exit();
          ///          $request->session()->flash('message', 'Manual deleted successfully!');
           //         return redirect()->route('admin.manuals.index');
        } catch (Exception $ex) {
    //           return redirect()->route($this->currentUserTemplate.'.manuals.index')->withErrors(trans('admin/manual.not_exists')); 
            echo "0";exit();
        }
    }
    
}
