<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        return view('admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
          try{
            if($request->ajax()){

                DB::beginTransaction();
                $name=$request->name;
                $email=$request->email;
                $password1=$request->password1;

                $data=['name'=>$name,'email'=>$email,'password'=>$password1];
                
                $filter1=[ 
                    'name' => 'trim|escape',
                    'password'=>'trim|escape',
                    'email'=>'trim|escape',
                  ];

                  $rules1 = array(
                    'name' => 'Required',
                    'password' => 'Required',
                    'email' => 'Required',
                    );

                    $messages1 = [];
                    $validator1 = Validator::make($data, $rules1, $messages1);

                    if($validator1->fails())
                    {
                        $errors = $validator1->errors()->toArray();
                        $data = array('error'=>$errors);
                        echo json_encode($data);
                        exit();
                    }else{
                       
                        $data_exists = DB::table('creation.user_details')
                                    ->where('email',$email)
                                    ->exists();
                        if($data_exists==false){
                                $ins=DB::table('creation.user_details')
                                        ->insertGetId($data,'id');
                                        if($ins){
                                             DB::commit();
                                            echo json_encode(1);//data inserted successfully
                                            exit();
                                        }else{
                                             DB::rollback();
                                            echo json_encode(2);//data inserted successfully
                                            exit();
                                        }
                                           

                        }else{
                            echo json_encode(3); 
                            exit(); //Email id Exists
                        }            
                    }

            }else{
                return abort(404);
            }

        }catch(Exception $e){
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
