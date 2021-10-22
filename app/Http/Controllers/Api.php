<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\User;
use App\Router;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Api extends Controller
{
    public function signup(Request $request){
        $validation = array(
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
        );
        $validator = Validator::make($request->all(), $validation);
	    if ($validator->fails()) {
	    	$response['message']=$validator->errors($validator)->first();
	     	return Response::json($response,400);
	    } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->api_token = Str::random(60);
            if($user->save()){
                $users=$this->getUserData($user->id);
                $response["message"]="User Register Sucessfully";
                $response['result']=[$users];
                return Response::json($response,201);
            } else {
               $response["message"]='some thing wrong';
               return Response::json($response,400);
            }
        }

    }
    public function getUserData($user_id){
        $user = new User();
        return $user->find($user_id);
    }

    public function tokenVeryfication($accessToken){
        $user = new User();
        $token = $user->where('api_token',$accessToken)->first();
		if(!empty($token)){
            return $token;
        }  else {
            return false;

        }
    }

    public function login(Request $request){
        $apiToken=$request->header('api_token');
        $token  = $this->tokenVeryfication($apiToken);
        $user = new User();
        if($token){
            $validation = array(
                'email'=>'required|email',
                'password'=>'required',
            );

            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                $response['message']=$validator->errors($validator)->first();
                 return Response::json($response,400);
            } else {
                $user_email = $user->where('email',$request->email)->first();
                if(!empty($user_email)){
                    if (Hash::check($request->password, $user_email->password)) {
                        $users=$this->getUserData($user_email->id);
                        $response["message"]="User Login Sucessfully";
                        $response['result']=[$users];
                        return Response::json($response,200);
                    } else {
                        $response["message"]='Password not match';
                        return Response::json($response,401);
                    }
                } else {
                    $response["message"]='This email is not registred';
                    return Response::json($response,401);
                }
            }

        } else {
            $response["message"]='your session has been expired';
            return Response::json($response,401);
        }

    }

    public function updateRouterByIp(Request $request){
        $apiToken=$request->header('api_token');
        $token  = $this->tokenVeryfication($apiToken);
        $user = new User();
        $router = new Router();

        if($token){
            $validation = array(
                'ip'=>'required',
            );
            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                $response['message']=$validator->errors($validator)->first();
                 return Response::json($response,400);
            } else {
            
                $isExist = $router->where('ip', $request->ip)->first();
                if($isExist){
                    $updateRouter = $router->find($isExist->id);
                    $updateRouter->sapid = $request->sapid ? $request->sapid : $isExist->sapid;
                    $updateRouter->hostname = $request->hostname ? $request->hostname : $isExist->hostname;
                    $updateRouter->loopback = $request->loopback ? $request->loopback : $isExist->loopback;
                    $updateRouter->mack_address = $request->mack_address ? $request->mack_address : $isExist->mack_address;

                    if($updateRouter->save()){
                        $response["message"]='Sucessfull';
                        return Response::json($response,200);
                    } else {
                        $response["message"]='Something wrong';
                        return Response::json($response,500);
                    }         

                } else {
                    $response["message"]='This record not found.';
                    return Response::json($response,200);
                }
            }

        } else {
            $response["message"]='your session has been expired';
            return Response::json($response,401);
        }
    }

    public function createRouter(Request $request){
        $apiToken=$request->header('api_token');
        $token  = $this->tokenVeryfication($apiToken);
        $router = new Router();

        if($token){
           
            $validation = array(
                'ip'=>'required',
                'hostname'=>'required|unique:routers,hostname',
                'loopback'=>'required|unique:routers,loopback',
                'sapid'=>'required',
                'mack_address'=>'required'
            );
            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                $response['message']=$validator->errors($validator)->first();
                 return Response::json($response,400);
            } else {
                $router->ip = $request->ip;
                $router->sapid =$request->sapid;
                $router->hostname = $request->hostname;
                $router->loopback = $request->loopback;
                $router->mack_address = $request->mack_address;
                if($router->save()) {
                    $routerData=$router->getRouter($router->id);
                    $response["message"]="Router created Sucessfully";
                    $response['result']=[$routerData];
                    return Response::json($response,201);
                } else {
                    $response["message"]='Something wrong';
                    return Response::json($response,400);
                }
            }
        } else{
            $response["message"]='your session has been expired';
            return Response::json($response,401);
        }
    }
    public function getRouterBySapId(Request $request,$sapid){
        $apiToken=$request->header('api_token');
        $token  = $this->tokenVeryfication($apiToken);
        if($token){
            $router = new Router();
            $routers = $router->where('sapid',$sapid)->get();
            if(!empty($routers)){
                $response["message"]="Sucessfull";
                $response['result']=$routers;
                return Response::json($response,200);
            } else {
                $response["message"]="Data not found";
                return Response::json($response,200);
            }
        }else{
            $response["message"]='your session has been expired';
            return Response::json($response,401);
        }
    }

    public function deleteRouterByIp(Request $request){
        $apiToken=$request->header('api_token');
        $token  = $this->tokenVeryfication($apiToken);
        if($token){
            $validation = array(
                'ip'=>'required',
            );
            $validator = Validator::make($request->all(), $validation);
            if ($validator->fails()) {
                $response['message']=$validator->errors($validator)->first();
                 return Response::json($response,400);
            } else {
                $router = new Router();
                $routers = $router->where('ip',$request->ip)->delete();
                if(!empty($routers)){
                    $response["message"]="Sucessfull";
                    return Response::json($response,200);
                } else {
                    $response["message"]="Data not found";
                    return Response::json($response,200);
                }
            }
        }else{
            $response["message"]='your session has been expired';
            return Response::json($response,401);
        }
    }
}
