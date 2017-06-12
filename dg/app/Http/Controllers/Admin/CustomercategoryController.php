<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\Manual;
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
class CustomercategoryController extends Controller
{
    //
     private $paginatorvalue;
    public function index() {
        
        $params = null;
        if (Input::has('title')){
        
            $params['title'] = Input::get('title');
        
        }
        
        $data =  DB::table('customercategory');
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
        //$filepath=self::FILE_SUB_DIR;
        return view('admin.customercategories.index', compact('blog'));
    }
     public function __construct() {
        $this->paginatorvalue = \Config::get('appConstants.paginatorvalue');
     }
      public function create() {
        return view('admin.customercategories.create');
    }
    
     public function store(Request $request) {
        
        try {

        $rules = array('title' => 'required|unique:customercategory'); //mimes:jpeg,bmp,png and for max size max:10000
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
               
                

                if ($request->status) {
                    $userData['status'] = 1;
                } else {
                    $userData['status'] = 0;
                }
                DB::table('customercategory')->insert($userData);
                $request->session()->flash('message', 'Customer Category added successfully!');
                return redirect()->route('admin.customercategories.index');
               
          
        }

        /*
          $product = new Product(array(
          'name' => $request->get('name'),
          'sku'  => $request->get('sku')
          ));

          $product->save();

         */
        } catch (Exception $ex) {
            return redirect()->route('admin.customercategories.index')->withErrors(trans('admin/customercategories.not_exists'));
        }
        
    }
    public function edit($id) {
        $manualData = DB::table('customercategory')->where('id',  $id)->get();
        
       // echo "<pre/>";
      // print_r($manualData[0]->id);die;
        return view('admin.customercategories.edit', ['clients'=>$manualData[0]]);
        
    }
     public function update($id, Request $request) {
         
     }
    
}
