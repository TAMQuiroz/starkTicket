<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\Assistance;
use Auth;
use Carbon\Carbon;




class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectAfterLogout = 'auth/login'; 

    protected $loginPath = '/auth/login';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:32',
            'email' => 'required|email|max:64|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $role = 1;
        if (isset($data['role_id']))
            $role = $data['role_id'];
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $role
        ]);
    }


    public function worker()
    {
        return view('external.workerLogin');
    }
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */

   public function getLogoutpost()
    {

// grabo mi fecha de deslogueo !! 

 
        $assitance               =   new Assistance ;

        $assitance->tipo         =  2 ;
     
        $assitance->datetime  =        new Carbon() ;

  $assitance->datetime  = $assitance->datetime->subHour(5) ;

        $id = Auth::user()->id;
        $assitance->salesman_id  =  $id  ;

if(Auth::user()->role_id ==  2    ){   
         $assitance->save(); 

          }

        return redirect('/'); // porlas no llega aqui
    }


    public function redirectPath()
    {
        switch (\Auth::user()->role_id) {
            case '4':
                return '/admin';
                break;
            case '3':
                return '/promoter';
                break;
            case '2':
                return '/salesman';
                break;
            case '1':
                return '/client/home';
                break;
            default:
                return '/';
                break;
        }
    }
}
