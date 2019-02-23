<?php

namespace App\Http\Controllers\Guide;

use App\User;
use App\profile;
use App\Category;
use Illuminate\Http\Request;

use Dingo\Api\Routing\Helpers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

class GuidePrfolieController extends ApiController
{
    use Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return $this->errorResponse("user not found",404);
                   }
                 $user1=User::find($user->id);
               
              
    
                return $this->showOne($user1,200);
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
                   }

       $data= profile::where('user_id', Auth::user()->id)->first();
       
     if (!$data->user_id == Auth::user()->id){
         $this->errorResponse("Profile tidak sama",404);
     }
        $rules = [
            'frist_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
        ];
        $this->validate($request, $rules);

        $data->first_name = $request->frist_name;
        $data->lastt_name = $request->last_name;
        $data->phone = $request->phone;

        if($data->save()){
           return $this->successResponse($data,201);
        }
        else{
           
            return $this->errorResponse("tejadi masalah saat mengupdate data",500);
        }



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
