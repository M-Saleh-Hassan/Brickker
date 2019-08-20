<?php

namespace App\Http\Controllers\arabic\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Mail;
use Socialite;

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
    // 	$new_user->user_type = $request->sign_up_user_type;
    	$new_user->password = bcrypt($request->sign_up_password);
    	$new_user->status = 1;
    	$new_user->remember_token = $request->_token;
    	$new_user->avatar = "tashtebk/images/avatar.png";
    // 	$new_user->phone = $request->sign_up_phone;
        $new_user->save();
        
        $user_email = $new_user->email;
        $user_username = $new_user->username;

        // $data=array('name'=>$new_user->username);
        // Mail::send('tashtebk.emails.auth.register.register_successful',$data,function($message){
        //     $message->to($user_email,$user_username)
        //             ->subject('Success Registration');
        //     $message->from('tashtebk@gmail.com','Tashtebk Team') ;       
        // });

        Auth::login($new_user);
        return redirect()->route('ar.profile.index', ['username_tag'=>$new_user->username_tag]);

        // $data=array(
        //             'name'=>$new_user->username,
        //             'email'=>$new_user->email,
        //             'rand_url'=>$new_user->username.rand().'confirmation_code',
        //             'confirmation_code'=>$new_user->confirmation_code ,
        //             'user_id'=>$new_user->id
        //             );

        // Mail::send('myacademy.english.emails.auth.register.confirmation',$data,function($message)use ($new_user){
        //     $message->to($new_user->email,$new_user->username)
        //             ->subject('Confirmation Code');
        //     $message->from('myacademyteam60@gmail.com','My Academy Team') ;       
        // });
        // return Redirect::route('en.auth.confirm',[
        //                            'name'=>$data['name'],
        //                            'rand_url'=>$data['rand_url'],
        //                            'email'=>$data['email'],
        //                            'user_id'=>$data['user_id'],
        //                            ])->with(['user_id' => $new_user->id]);

        // if(Auth::attempt(['email'=>$request->sign_up_email,'password'=>$request->sign_up_password]))
        // {
        //     return redirect()->back();
        // }
        // else
        // {
        // 	return redirect()->back()->with('signup_error_message','Please Re-Enter Your Data'); 
        // } 
              	
    }

    // public function getConfirm()
    // {
    //     return view('myacademy.english.auth.confirm');
    // }

    // public function postConfirm(Request $request)
    // {
        
    //     $user=User::find($request->user_id);
        
    //     if($user->confirmation_code == $request->confirmation_code)
    //     {
    //         $user->confirmed = 1;
    //         $user->save();
    //          Auth::login($user);
    //          return redirect('/');
    //     }
    //     else
    //     {
    //         return redirect()->back()->with('signup_error_message','Please Re-Enter Your Data'); 
    //     }
    // }

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
        
        if(Auth::attempt(['email'=>$request->sign_in_email,'password'=>$request->sign_in_password]))
        {   
            $user=User::where('email',$request->sign_in_email)->first();
            if($user->deactivate)
            {
                Auth::logout();
                return redirect()->back()->withErrors('تم ايقاف تفعيل هذا الأكونت'); 
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

    // public function forgetPassword()
    // {
    //     return view('myacademy.english.auth.forgetpassword');
    // }

    // public function savePassword(Request $request)
    // {
    //     $user = User::where('email',$request->email)->first();
    //     // $user->password = bcrypt($request->password);
    //     // $user->save();
    //     if(!empty($user)){
    //         $data=array(
    //                     'change_message'=> url('/reset-password/en/') .'/'. $user->remember_token
    //                     );
    
    //         Mail::send('myacademy.english.emails.auth.forgetpassword',$data,function($message)use ($user){
    //             $message->to($user->email,$user->email)
    //                     ->subject('Change Password');
    //             $message->from('myacademyteam60@gmail.com','My Academy Team') ;       
    //         }); 
            
    //         // if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    //         // {   
    //         //     $user = User::where('email',$request->email)->first();
    //         //     $user->remember_token = $request->_token;
    //         //     $user->save();
    //         //     return redirect('/');
    //         // }
    //         // else
    //         // {
    //         //     return redirect()->back()->with('signin_error_message','Please Re-Enter Your Data'); 
    //         // }        
    //         return view('myacademy.english.auth.forgetpassword')->with('send_reset_password','Reset Mail sent Successfully.');       
    //     }
    //     else{
    //         return view('myacademy.english.auth.forgetpassword')->with('send_reset_password_error','Your Email not found.');
    //     }
    // }

    // public function resetPassword(Request $request)
    // {
    //     $remember_token = $request->remember_token;
    //     $user = User::where('remember_token',$remember_token)->first();
    //     if(!empty($user)){
    //         return view('myacademy.english.auth.resetpassword')->with('user_id',$user->id);
    //     }
    //     else{
    //         return redirect('/');
    //     }
    // }

    // public function saveresetPassword(Request $request)
    // {
    //     $new_password = $request->new_password;
    //     $user_id = $request->user_id;
    //     $user = User::where('id',$user_id)->first();
    //     $user->password = bcrypt($new_password);
    //     if($user->save()){
    //          Auth::login($user);
    //          return redirect('/');
    //     }
    //     else{
    //         return redirect('/');
    //     }
    // }
    public function logout()
    {
        Auth::logout();
        // return Redirect::to(url()->previous());
        //message for suspend
        return Redirect::to(url('/'));
    } 

    // public function redirectToProvider()
    // {  
    //     return Socialite::driver('facebook')->redirect();
    // }

    // public function handelProviderCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();
    //     // var_dump($user);
    //     // return $user->name;
    //     // $data = ['username'=>$user->name,'email'=>$user->email,'password'=>$user->password];
    //     // $get_user = User::where('email',$user->email)->first();
    //     // if(!is_null($get_user))
    //     // {
    //     //     Auth::login($user);
    //     // }
    //     // else
    //     // {
    //     //     $new_user = new User();
    //     //     $new_user->username = $user->name;
    //     //     $new_user->email = $user->email;
    //     //     $new_user->password = $user->password;
    //     //     $new_user->status = 1;
    //     // 	$new_user->remember_token = $user->token;
    //     // 	//$new_user->bio = "";
    //     // 	$new_user->avatar = $user->getAvatar(); //env('GLOBAL_PATH')."my_academy/img/avatar/avatar.png";
    //     // 	$new_user->facebook = "";
    //     // 	$new_user->fid = $user->getId();
    //     // 	//$new_user->googleid = "";
    //     // 	//$new_user->phone = $request->sign_up_phone;
    //     //     $new_user->save();
            
    //     //     $new_user_role = new role_user();
    //     //     $new_user_role->user_id =  $new_user->id;
    //     //     $new_user_role->role_id = 3;
    //     //     $new_user_role->save();
    //     // }
    //     // return redirect('/');

    // }
    // public function redirectToProvider1()
    // {  
    //     return Socialite::driver('google')->redirect();
    // }

    // public function handelProviderCallback1()
    // {
    //     $user = Socialite::driver('google')->user();
    //     $get_user = User::where('email',$user->email)->orWhere('googleid',$user->id)->first();
    //     if(!empty($get_user))
    //     {
    //         Auth::login($get_user);
    //         return redirect('/');
    //     }
    //     else
    //     {
    //         $new_user = new User();
    //         $new_user->username = $user->name;
    //         $new_user->email = $user->email;
    //         $new_user->status = 1;
    //         $new_user->confirmed = 1;
    //         $new_user->confirmation_code = mt_rand(100000, 999999);
    //     	$new_user->googleid = $user->id;
    //     	$new_user->avatar = $user->avatar_original;
    //     	$new_user->remember_token = md5(uniqid(mt_rand(), true));
    //         $new_user->save();
            
    //         $new_user_role = new role_user();
    //         $new_user_role->user_id =  $new_user->id;
    //         $new_user_role->role_id = 3;
    //         $new_user_role->save();
    //         Auth::login($new_user);
    //         return redirect('/');
    //     }

    // }
    
    // public function view_mail(){
    //     return view('view_mail');
    // }
}
