<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\PasswordClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Models\Preference;
use App\Models\Category;
use Auth;
use Session;
use Carbon\Carbon;
use App\Services\FileService;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->file_service = new FileService();
    }
    public function index()
    {
        $clients = User::where('role_id','1')->paginate(10);
        return view('internal.admin.client.clients', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function desactive(Request $request)
    {
        $input = $request->all();
        if(isset($input['client_id']))
        {
            $user = User::findOrFail($input['client_id']);
            $user->delete();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Cliente Borrado!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Cliente no encontrado!');
            Session::flash('alert-class','alert-danger');
        }

        return redirect('/admin/client');
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
    public function store(StoreClientRequest $request)
    {

        $users = User::where('email',$request['email'])->get();
        if (count($users)!=0){
            return back()->withErrors(['Ya Registro este email']);
        }

        $input = $request->all();

        $user = new User ;
        $user->name = $input['name'];
        $user->lastName = $input['lastname'];
        $user->password = bcrypt($input['password']);
        $user->di_type = $input['di_type'];
        $user->di = $input['di'];
        $user->address = $input['address'];
        $user->phone = $input['phone'];
        $user->email = $input['email'];
        $user->points = 0;
        $user->birthday = new Carbon($input['birthday']);
        $user->role_id = Role::where('description','client')->get()->first()->id;
        $user->save();


        //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
        Session::flash('message', 'Cliente Creado!');
        Session::flash('alert-class','alert-success');

        return redirect('/');
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
    public function edit()
    {

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $categories = Category::all();
        $preference = Preference::where('idUser',$id)->get();
        $datosUsar = [];
        $contador = 0;

        //return $preference; //idCategories
        //return $preference[0]->idCategories;
        if(!$preference || count($preference)!= 0){
            foreach ($categories as $category) {
                //return $category->id;

                if ($contador != count($preference) && $preference[$contador]->idCategories == $category->id){
                    array_push($datosUsar, array($category->name,$category->id,true));
                    $contador = $contador + 1;
                }
                else
                    array_push($datosUsar, array($category->name,$category->id,false));
            }
        }else{
            $noPreference = $categories;
        }
        //return view('internal.client.edit', ['obj' => $obj]);
        //return $categories;
        return view('internal.client.edit', compact('obj','datosUsar','preference','noPreference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);

        //dd($request->all());
        $input = $request->all();
        //return $input;
        $obj->name = $input['name'];
        $obj->lastname = $input['lastname'];
        $obj->address = $input['address'];
        $obj->phone = $input['phone'];
        $obj->email = $input['email'];
        $obj->save();

        //$prueba = Preference::all();

        //$khe = Preference::withTrashed()->where('idUser', $obj->id)->get();
        //$khe->save();

        Preference::where('idUser','=',$obj->id)->delete(); // rip tabla preferences

        $values = array_values($input);
        $i = 6;
        while (!empty($values[$i])){
           $preference = new Preference;
           $preference->idUser = $obj->id;
           $preference->idCategories = $values[$i];
           $preference->save();
           $i = $i + 1;
        }


        //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
        Session::flash('message', 'Informacion de perfil actualizada!');
        Session::flash('alert-class','alert-success');
        return redirect('client');
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

    /**
     * Client profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        return view('internal.client.profile', ['obj' => $obj]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        return view('internal.client.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(PasswordClientRequest $request)
    {

        $id = Auth::user()->id;
        $obj = User::findOrFail($id);
        $auth = Auth::attempt( array(
            'email' => $obj->email,
            'password' => $request->input('password')
            ));
        if ($auth)
        {
            $newPassword = bcrypt($request->input('new_password'));
            $obj->password = $newPassword;
            $obj->save();
            //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
            Session::flash('message', 'Su contraseña fue actualizada!');
            Session::flash('alert-class','alert-success');
        } else {
            Session::flash('message', 'Contraseña incorrecta!');
            Session::flash('alert-class','alert-danger');
        }
        return redirect('client');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoEdit()
    {
        return view('internal.client.photo');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $obj = User::findOrFail($id);

        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $obj->image = $this->file_service->upload($request->file('image'),'client');
        $obj->save();

        //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
        Session::flash('message', 'Su imagen se actualizo!');
        Session::flash('alert-class','alert-success');

        return redirect('client');
    }
}
