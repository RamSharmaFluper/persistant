<?php

namespace App\Http\Controllers;

use App\Router;
use Illuminate\Http\Request;

class RouterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $router = new Router();
        $routers = $router->where('deleted_at', NULL)
        ->get();
        return view('router',compact('routers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ip = $request->ip;
        $sapid = $request->sapid;
        $hostname = $request->host;
        $loopback = $request->loop;
        $mack_address = $request->mac;

        $router = new Router();
        $router->ip = $ip;
        $router->sapid = $sapid;
        $router->hostname = $hostname;
        $router->loopback = $loopback;
        $router->mack_address = $mack_address;
        if($router->save()) {

           return $this->getRoterById($router->id);
        } else {
            dd('something Wrong');
        }
    }

    public function getRoterById($router_id)
    {
        $router = new Router();
        return  $router->find($router_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function show(Router $router)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->getRoterById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $routers = new Router();
        $router = $routers->find($id);
        $ip = $request->ip;
        $sapid = $request->sapid;
        $hostname = $request->host;
        $loopback = $request->loop;
        $mack_address = $request->mac;

        $router->ip = $ip;
        $router->sapid = $sapid;
        $router->hostname = $hostname;
        $router->loopback = $loopback;
        $router->mack_address = $mack_address;
        if($router->save()) {
           return $this->getRoterById($router->id);
        } else {
            dd('something Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Router  $router
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $routers = new Router();
        $destroy = $routers->where('id',$id)->delete();
        return 1;
    }
    
    
}
