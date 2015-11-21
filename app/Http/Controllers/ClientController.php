<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\PasswordClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Preference;
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
        $user->role_id = 1;
        $user->save();

        //Lo siento, no se como hacerlo de una manera mas optima :v

        $preference = new Preference;
        if (!empty($input['rock'])){
            $preference->idUser = $user->id;
            $preference->idCategories = $input['rock'];
            $preference->save();

        }
        
        $preference2 = new Preference;

        if (!empty($input['electronica'])){
            $preference2->idUser = $user->id;
            $preference2->idCategories = $input['electronica'];
            $preference2->save();

        }

        $preference3 = new Preference;
        if (!empty($input['ballet'])){
            $preference3->idUser = $user->id;  
            $preference3->idCategories = $input['ballet'];
            $preference3->save();

        }

        $preference4 = new Preference;
        if (!empty($input['comedia'])){
            $preference4->idUser = $user->id;  
            $preference4->idCategories = $input['comedia'];
            $preference4->save();

        }




        $preference5 = new Preference;
        if (!empty($input['drama'])){
            $preference5->idUser = $user->id;  
            $preference5->idCategories = $input['drama'];
            $preference5->save();

        }

        $preference6 = new Preference;
        if (!empty($input['reggae'])){
            $preference6->idUser = $user->id;  
            $preference6->idCategories = $input['reggae'];
            $preference6->save();

        }    

        $preference7 = new Preference;
        if (!empty($input['pena'])){
            $preference7->idUser = $user->id;  
            $preference7->idCategories = $input['pena'];
            $preference7->save();

        }    

        $preference8 = new Preference;
        if (!empty($input['opera'])){
            $preference8->idUser = $user->id;  
            $preference8->idCategories = $input['opera'];
            $preference8->save();

        }    

        $preference9 = new Preference;
        if (!empty($input['adultos'])){
            $preference9->idUser = $user->id;  
            $preference9->idCategories = $input['adultos'];
            $preference9->save();

        }    

        $preference10 = new Preference;
        if (!empty($input['sociales'])){
            $preference10->idUser = $user->id;  
            $preference10->idCategories = $input['sociales'];
            $preference10->save();

        }    

        $preference11 = new Preference;
        if (!empty($input['fiestas'])){
            $preference11->idUser = $user->id;  
            $preference11->idCategories = $input['fiestas'];
            $preference11->save();

        }    

        $preference12 = new Preference;
        if (!empty($input['tours'])){
            $preference12->idUser = $user->id;  
            $preference12->idCategories = $input['tours'];
            $preference12->save();

        }    

        $preference13 = new Preference;
        if (!empty($input['futbol'])){
            $preference13->idUser = $user->id;  
            $preference13->idCategories = $input['futbol'];
            $preference13->save();

        }    

        $preference14 = new Preference;
        if (!empty($input['automovilismo'])){
            $preference14->idUser = $user->id;  
            $preference14->idCategories = $input['automovilismo'];
            $preference14->save();

        }    

        $preference15 = new Preference;
        if (!empty($input['maraton'])){
            $preference15->idUser = $user->id;  
            $preference15->idCategories = $input['maraton'];
            $preference15->save();

        }    

        $preference16 = new Preference;
        if (!empty($input['musical'])){
            $preference16->idUser = $user->id;  
            $preference16->idCategories = $input['musical'];
            $preference16->save();

        }    



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
        return view('internal.client.edit', ['obj' => $obj]);
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

        $obj->name = $input['name'];
        $obj->lastname = $input['lastname'];
        $obj->address = $input['address'];
        $obj->phone = $input['phone'];
        $obj->email = $input['email'];
        $obj->save();

        //ERROR DE MENSAJES EN INGLES, DEBEN SER EN ESPAÑOL CUANDO SON CUSTOM
        Session::flash('message', 'Informacion de perfil correctamente actualizada!');
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
            Session::flash('message', 'Contraseña!');
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
