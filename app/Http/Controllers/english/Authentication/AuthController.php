<?php

namespace App\Http\Controllers\english\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Mail;
use Socialite;
use Illuminate\Support\Str;

//use Laravel\Socialite\Facades\Socialite;

use App\User;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
		$rules= [
                  'sign_up_username' => 'required|unique:users,username',
                  'sign_up_email' => 'required|unique:users,email|email',
                //   'sign_up_phone' => 'required',
                  'sign_up_password' => 'required',
                  'sign_up_password_confirmation' => 'required|same:sign_up_password',
                //   'sign_up_user_type' => 'required',
                  'sign_up_country' => 'required',
                ];

        $messages = [
                        'sign_up_username.required' => 'Please Enter Username',
                        'sign_up_username.unique:users' => 'This Username Is Already Exist',

                        'sign_up_email.required' => 'Please Enter Email',
                        'sign_up_email.unique:users' => 'This Email Is Already Exist',
                        'sign_up_email.email' => 'Please Enter A valid Email',

                        // 'sign_up_phone.required' => 'Please Enter Phone Number',

                        'sign_up_password.required' => 'Please Enter A Password',

                        'sign_up_password_confirmation.required' => 'Please Enter A Confirmation Password',
                        'sign_up_password_confirmation.same' => 'Password And Confirm Password Must Match',
                        // 'sign_up_user_type.required'=>'Please Select',
                        'sign_up_country.required'=>'Please Select A country',
                    ] ;

        $this->validate($request, $rules, $messages);

        $random_code = rand();
    	$new_user = new User();
        $new_user->username = $request->sign_up_username;
        $new_user->username_tag = $this->trimString($request->sign_up_username);
    	$new_user->email = $request->sign_up_email;
    	$new_user->country_id = $request->sign_up_country;
     	//$new_user->user_type = $request->sign_up_user_type;
    	$new_user->password = bcrypt($request->sign_up_password);
    	$new_user->status = 1;
    	$new_user->verified_token = str_random(40);
    	$new_user->remember_token = $request->_token;
    	$new_user->avatar = "tashtebk/images/avatar.png";
        //$new_user->phone = $request->sign_up_phone;
        $new_user->save();

        $user_email = $new_user->email;
        $user_username = $new_user->username;

        $data=array('user'=>$new_user);
        Mail::send('tashtebk.english.emails.auth.register.register_successful',['data' => $data, 'new_user' => $new_user],function($message) use ($data,$new_user){
            $message->to($new_user->email,$new_user->username)
                    ->subject('Success Registration');
            $message->from('contactus@brickker.com','Brickker Team') ;
        });

        return redirect()->route('en.home.index')->with('success', 'You successfully registered please verify your email from link sent to your email.');

    }

    public function verify($token)
    {
        $user=User::where('verified_token',$token)->first();
        if(!empty($user))
        {
        	$user->verified = 1;
        	$user->save();
        	Auth::login($user);
        	return redirect()->route('en.profile.index', ['username_tag'=>$user->username_tag]);

        }

        return redirect()->route('en.home.index')->with('success', 'Wrong Link!');

    }

    public function signIn(Request $request)
    {
		$rules= [
                  'sign_in_email' => 'required|email',
                  'sign_in_password' => 'required',
                ];

        $messages = [
                        'sign_in_email.required' => 'Please Enter E-Mail',
                        'sign_in_email.email' => 'Please Enter Avalid Email',

                        'sign_in_password.required' => 'Please Enter Password'
                    ] ;

        $this->validate($request, $rules, $messages);

        if(Auth::attempt(['email'=>$request->sign_in_email,'password'=>$request->sign_in_password]) || Auth::attempt(['email'=>$request->sign_in_email,'password_secondary'=>$request->sign_in_password]))
        {
            $user=User::where('email',$request->sign_in_email)->first();
            if($user->deactivate)
            {
                Auth::logout();
                return redirect()->back()->withErrors('This account has been deactivated.');
            }
            if(!$user->verified)
            {
                Auth::logout();
                return redirect()->back()->withErrors('This account isnot activated yet.');
            }
            if ($user->getUserType() == 'admin')
            {
                return redirect()->route('admin.home.index');
            }
            else
            {
                // return redirect()->route('en.home.index');
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back()->withErrors('Invalid Username Or Password, Please Re-Enter Your Data!');
        }
    }

    public function logout()
    {
        Auth::logout();
        // return Redirect::to(url()->previous());
        //message for suspend
        return Redirect::to(url('/'));
    }

    public function sendResetLinkEmail(Request $request)
    {
		$rules= [
            'reset_email' => 'required|email',
          ];

        $this->validate($request, $rules);

        $user = User::where('email', $request->reset_email)->first();

        if(!$user) return redirect()->route('en.home.index')->with('success', 'Wrong Email!');

        $user->reset_password_code = Str::random();
        $user->save();

        $data=array('user'=>$user);
        Mail::send('tashtebk.english.emails.auth.forgetpassword',['data' => $data, 'user' => $user],function($message) use ($data,$user){
            $message->to($user->email,$user->username)
                    ->subject('Reset Your Password');
            $message->from('contactus@brickker.com','Brickker Team') ;
        });

        return redirect()->route('en.home.index')->with('success', 'Please Check Your Email we send you a link to reset your password.');


    }

    public function showResetForm($token)
    {
        $user = User::where('reset_password_code', $token)->first();

        if(!$user) return redirect()->route('en.home.index')->with('success', 'Expired Link!');

        return view('tashtebk.english.reset_password.index')
        ->with('token', $token);
    }

    public function reset(Request $request)
    {
        $user = User::where('reset_password_code', $request->reset_token)->first();

        if(!$user) return redirect()->route('en.home.index')->with('success', 'Expired Link!');

        $rules= [
            'new_password' => 'required',
            'new_password_confirm' => 'required|same:new_password',
          ];

        $this->validate($request, $rules);

        $user->password = bcrypt($request->new_password);
        $user->reset_password_code = NULL;
        $user->save();

        return redirect()->route('en.home.index')->with('success', 'Your Password has been reset successfully. Now You can login.');
    }
}
