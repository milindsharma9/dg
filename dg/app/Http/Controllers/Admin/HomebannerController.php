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

class HomebannerController extends Controller
{
    //
      const FILE_SUB_DIR = 'uploads/homebanner';
    public function index(){
        
    }
    public function edit($id) {
        $manualData = DB::table('homebanner')->where('id',  $id)->get();
        
       // echo "<pre/>";
      // print_r($manualData[0]->id);die;
        return view('admin.homebanner.edit', ['clients'=>$manualData[0],'filepath'=>self::FILE_SUB_DIR]);
        
    }
    
    public function update($id, Request $request) {
       
        try {
        
         $rules = array( 'filename' => 'required|mimes:jpg,jpeg,png|max:10000'); //mimes:jpeg,bmp,png and for max size max:10000
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()
                            ->back()
                            ->withInput($request->all())
                            ->withErrors($validator);
        } else {
            $userData = array();
            if (Input::hasFile('filename')) { 
                if (Input::file('filename')->isValid()) {
                    $manualData = DB::table('homebanner')->where('id',  $id)->get();
                    $fileToremove = $manualData[0]->filename;
                    LaraFile::delete(self::FILE_SUB_DIR ."/" .$fileToremove);
                    $destinationPath = self::FILE_SUB_DIR;
                    $extension = Input::file('filename')->getClientOriginalExtension();
                    $fileName = date("YmdHis") . '.' . $extension; // renameing image
                    Input::file('filename')->move($destinationPath, $fileName);
                    $userData['filename'] = $fileName;
                    
                    
                }
            }
            
            
               
               
                

                
                DB::table('homebanner')
            ->where('id', $id)
            ->update($userData);
            
            
            $request->session()->flash('message', 'Banner updated successfully!');
        return redirect()->route('admin.homebanner.edit',1);
        }
        
        
        
        } catch (Exception $ex) {
            return redirect()->route($this->currentUserTemplate.'.homebanner.index')->withErrors(trans('admin/client.not_exists'));
        }
        
    }
}
