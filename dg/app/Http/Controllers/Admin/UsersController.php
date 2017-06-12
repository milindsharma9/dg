<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Illuminate\Support\Facades\Redirect;
//use App\PaymentModel;
use Illuminate\Support\Facades\Auth;
//use App\BankDetails;
use Exception;
//use App\StoreModel;
use DB;
use Input;
use PDF;
use Session;

use Illuminate\View\Middleware\ShareErrorsFromSession;
class UsersController extends Controller {

    private $currentUserTemplate = null;

    /**
     * @var \MangoPay\MangoPayApi
     */
    private $mangopay;
    private $paginatorvalue;
    /**
     *
     * @var type
     */
    private $paymentModel = null;

    /**
     *
     * @param \MangoPay\MangoPayApi $mangopay
     */
    public function __construct() {
        $this->paginatorvalue =  \Config::get('appConstants.paginatorvalue');
      //  $this->mangopay = $mangopay;
        //$this->currentUserTemplate = 'store';
        if(Auth::check()){
            if (Auth::user()->fk_users_role == \Config::get('appConstants.admin_role_id')) {
                $this->currentUserTemplate = 'admin';
            } 
             if (Auth::user()->fk_users_role == \Config::get('appConstants.subadmin_role_id')) {
                $this->currentUserTemplate = 'admin';
                
            } 
        }
        
    }
     public function getAdminDasboard() {
         
         //echo \Route::getCurrentRoute()->getActionName();die;
         return view('admin.payment.index');

    }
             
	 /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        $params='';
        
       if (Input::has('name') || Input::has('email') || Input::has('mobile') || Input::has('companyname')){
        $params['email'] = Input::get('email');
        $params['fullname'] = Input::get('name');
        $params['mobile'] = Input::get('mobile');
        $params['companyname'] = Input::get('companyname');
        }
        $users = User::getSystemUsers($this->paginatorvalue,$params);
        if (Input::has('name') || Input::has('email') || Input::has('mobile')){
             $users->appends( Input::only('email', 'name','mobile','companyname') ); 
           // $users->appends(array('email' => Input::get('email')));
        }
        return view($this->currentUserTemplate.'.users.index', compact('users'));
    }
	/**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('admin.users.create');
    }
	public function getValidationMessages() {
        $aMessage = array(
            'fullname.required'         => 'The Name field is required.',
            'companyname.required'  => 'The CompanyName field is required.',
            'address.required'   => 'The Address field is required.',
			'mobile.numeric'   => 'The Mobile field must be numeric.',
        );
        return $aMessage;
    }
	public function store(Request $request) {
		 $aMessage = $this->getValidationMessages();
        $rules = array(
			  'fullname'    => 'required|max:250',
            'companyname'     => 'required|max:255',
			'address'     => 'required',
            'mobile'         => 'required|numeric|digits_between:7,15',            
            'email'       => 'required|email|unique:users',
			'password'      => 'min:6|confirmed'       
			
            
        );
		$validator = Validator::make($request->all(), $rules, $aMessage);
		if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput($request->all())
                ->withErrors($validator);
        }
		// Users::create($request->all());
		 $userData = array();
		 $userData['fullname'] = $request->input('fullname');
		 $userData['companyname']  = $request->input('companyname');
		 $userData['address'] = $request->input('address');
		 $userData['mobile'] = $request->input('mobile');
		 $userData['email'] = $request->input('email');
		 $userData['password'] = bcrypt($request->input('password'));
		 $userData['fk_users_role'] = 3;
		 
		 if($request->activated){
				$userData['activated'] =1;
		 } else{
			 $userData['activated'] =0;
		 }
		/* $userData[''] = ;
			*/
			DB::table('users')->insert($userData);
			//print_r($userData);
		/* DB::table('users')->insert($userData);*/
                 $request->session()->flash('message', 'User added successfully!');
		 return redirect()->route('admin.users.index');
	}
	
	 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        try {
            $users = User::findOrFail($id)->where('id', '=', $id)
                ->where('fk_users_role', '=', config('appConstants.user_role_id'))
                ->firstOrFail();
            //$users['userOrderDetails'] = User::getUserOrderDetails($id);
           // $users['productDetails'] = User::fetchOrderProducts($id);
            return view('admin.users.edit', compact('users'));
        } catch (Exception $ex) {
            return redirect()->route($this->currentUserTemplate.'.users.index')->withErrors(trans('admin/users.not_exists'));
        }
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {
        $users = User::findOrFail($id);
        $rules = array(
            'fullname'    => 'required|max:250',
            'companyname'     => 'required|max:255',
			'address'     => 'required',
            'email'       => 'required|email|unique:users,email,'. $id,
            'mobile'         => 'required|numeric|digits_between:7,15',
            'password'      => 'min:6|confirmed',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if(empty($request->get('password'))){
            $users->update($request->only('fullname', 'companyname', 'address','mobile','activated','email'));
        } else {
            $aInputRequest = $request->only('fullname', 'companyname', 'address', 'mobile','password','activated','email');
            $aInputRequest['password'] = bcrypt($aInputRequest['password']);
            $users->update($aInputRequest);
        }
        $request->session()->flash('message', 'User details updated successfully!');
        return redirect()->route('admin.users.index');
    }
     /**
     *
     * @return view Object
     */
    public function changePassword() {
        $routePrefix = $this->currentUserTemplate;
        if (Auth::user()->fk_users_role == \Config::get('appConstants.user_role_id')) {
            $routePrefix = 'customer';
        }
        return view($routePrefix.'.change-password', compact('routePrefix'));
    }
    public function getContact() {
    return view('admin.users.contact');
  }
  public function postContact(Request $request)
  {
      $rules =[
      'fullname' => 'required',
      
      'CaptchaCode' => 'required|valid_captcha'
    ];
     $validator = Validator::make($request->all(), $rules,[
      'valid_captcha' => 'Wrong code. Try again please.'
    ]);
       //$validator      = Validator::make($request->all());
   // $validator = $this->validator($request->all());

    if ($validator->fails())
    {
      return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator);
    }

    // Captcha validation passed
    // TODO: send email
return view('admin.users.contact');
   /* return redirect()
          ->back()
          ->with('status', 'Your message was sent successfully.');*/
  }

    /*
     * for export as excel
     */
       public function excel() {
           
            $data = \Excel::load("C:/xampp/htdocs/diageo/public/uploads/Test.xlsx")->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $dr = $value->toArray();
                     echo "<pre>";
                    print_r($dr);die;
                   // $arr[] = ['name' => $value->name, 'details' => $value->details];
                    echo "<pre>"; //echo $value->owner;
                    var_dump($value);
                }
                die("opp");
            }
                echo "<pre/>";
                print_r($arr);die ;
            // Execute the query used to retrieve the data. In this example
            // we're joining hypothetical users and payments tables, retrieving
            // the payments table's primary key, the user's first and last name, 
            // the user's e-mail address, the amount paid, and the payment
            // timestamp.

           /* $payments = Payment::join('users', 'users.id', '=', 'payments.id')
                ->select(
                  'payments.id', 
                  \DB::raw("concat(users.first_name, ' ', users.last_name) as `name`"), 
                  'users.email', 
                  'payments.total', 
                  'payments.created_at')
                ->get();
                */
           $payments = User::select('id','fullname','email')->get();
            // Initialize the array which will be passed into the Excel
            // generator.
            $paymentsArray = []; 

            // Define the Excel spreadsheet headers
            $paymentsArray[] = ['id', 'fullname','email'];

            // Convert each member of the returned collection into an array,
            // and append it to the payments array.
            foreach ($payments as $payment) {
                $paymentsArray[] = $payment->toArray();
            }
               
            // Generate and return the spreadsheet
            \Excel::create('users', function($excel) use ($paymentsArray) {

                // Set the spreadsheet title, creator, and description
                $excel->setTitle('Users');
                $excel->setCreator('Laravel')->setCompany('test company');
                $excel->setDescription('Users file');

                // Build the spreadsheet, passing in the payments array
                $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                    $sheet->fromArray($paymentsArray, null, 'A1', false, false);
                });

            })->download('xlsx');  
            
            
            
            
        }
       // public function downpdf(){
             public function downpdf() {
            $payments = User::select('id','fullname','email')->get();
            // Initialize the array which will be passed into the Excel
            // generator.
            $paymentsArray = []; 
               //https://github.com/barryvdh/laravel-dompdf 
            // Define the Excel spreadsheet headers
            $paymentsArray = "<h1>user list</h1>";
            $paymentsArray .= "<table colspan='1' cellpadding='10' style='border 1px solid' >";
            $paymentsArray .="<tr>";
            $paymentsArray .="<td>id</td>";
            $paymentsArray .="<td>Name</td>";
            $paymentsArray .="<td>Email</td>";
            $paymentsArray .="</tr>";
            foreach ($payments as $payment) {
                $paymentsArray1='';
                $paymentsArray1[0] = $payment->toArray();
                $paymentsArray .="<tr>";
                $paymentsArray .="<td>" .$paymentsArray1[0]['id']."</td>";
                $paymentsArray .="<td>" .$paymentsArray1[0]['fullname']."</td>";
                $paymentsArray .="<td>" .$paymentsArray1[0]['email']."</td>";
                $paymentsArray .="</tr>";
            }
            //$paymentsArray[] = ['id', 'fullname','email'];
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf = PDF::loadHTML($paymentsArray);
            return $pdf->download('users.pdf');
        }
    
    /**
     * Function to Instatntiate Store Model.
     * @return type
     */
    private function getPaymentModel() {
        if ($this->paymentModel == null) {
            $this->paymentModel = new PaymentModel($this->mangopay);
        }
        return $this->paymentModel;
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
//    public function show($id) {
//        $users = User::getSalesOrder($id);
//        return view('admin.users.index', compact('users'));
//    }
    
    
   
    




   

}
