<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\Person;
use App\Mail\WelcomeMail;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Socialite;

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

        if ($person == null) {
            DB::rollBack();
            return abort(404);
        }

        Member::create([
            'id_person' => $person->id,
            'name' => $data['name']
        ]);

        DB::commit();

        Mail::to($data['email'])->send(new WelcomeMail());

        return $person;
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }


        // check if they're an existing user
        $existingUser = Person::where('email', $user->email)->first();
        if ($existingUser) {
            // log them in
            Auth::loginUsingId($existingUser->id);
        } else {

            DB::beginTransaction();

            $person = Person::create([
                'username' => $user->id,
                'email' => $user->email,
                'password' => md5(rand(1,10000))
            ]);
    
            if ($person == null) {
                DB::rollBack();
                return abort(404);
            }
    
            Member::create([
                'id_person' => $person->id,
                'name' => $user->name
            ]);
    
            DB::commit();

            Auth::loginUsingId($person->id);
        }

        return redirect()->to('/home');
    }
}
