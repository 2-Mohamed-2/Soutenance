<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        return view('layouts.rol');        
    }

    public function fetchrole()
    {
        $rols = Role::latest()->get();
        return response()->json([
            'roles'=>$rols,
        ]);
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
        $validator = Validator::make($request->all(),[
           'libelle' => 'required|max:255',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else {

            $rol = Role::create([
                'libelle' => $request->libelle,
             ]);

             return response()->json([
                'status'=>200,
                'message'=>'Insertion bien effectuée !',
            ]);
        }
         
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
        $role = Role::find($id);
        
        if ($role) {
            return response()->json([
                'status'=>200,
                'role'=>$role,
            ]);
        } 
        else {            
            return response()->json([
                'status'=>404,
                'message'=>'Role non trouvé !',
            ]);
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
        
        $validator = Validator::make($request->all(),[
           'libelle' => 'required|max:255',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);
        }
        else {

            $role = Role::find($id);

            if ($role) {
                $validateData = $this->validate($request,[
                    'libelle' => 'required|max:255',
                ]);
        
                Role::whereId($id)->update($validateData);
                return response()->json([
                    'status'=>200,
                    'message'=>'Modification bien effectuée !',
                ]);
            } 
            else {
                return response()->json([
                    'status'=>404,
                    'message'=>'Role non trouvé !',
                ]);
            }
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
        $rol = Role::findOrFail($id);
        $rol->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Suppression bien effectuée !',
        ]);
    }
}
