<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\Person;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:person',
            'password' => 'required|string|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Member
     */
    protected function create(array $data)
    {

        DB::beginTransaction();

        $person = Person::create([
            'username' => $data['email'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if($person == null){
            DB::rollBack();
            return abort(404);
        }

        Member::create([
            'id_person' => $person->id,
            'name' => $data['name']
        ]);

        DB::commit();

        return $person;
    }
}
