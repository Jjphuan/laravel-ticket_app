<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $locale = $request->header('Accept-Language','en');
        App::setLocale($locale);

        $request->validate([
            'name' => ['required','string','min:6'],
            'phone_num' => ['required',Rule::unique('ticket_users','phone_number')],
            'email' => ['required','email',Rule::unique('ticket_users','email')],
            'password' => ['required','string','min:8'],
        ]);

        $user = User::create([
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_num
        ]);
        $token = $user->createToken('api-token')->plainTextToken;

        if($user['id'] != null){
            $result['success'] = true;
            $result['result'] = $user;
            $result['token'] = $token;
        }

        return response()->json($result);
    }

    public function login(Request $request)
    {

        $locale = $request->header('Accept-Language','en');
        App::setLocale($locale);

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => __("email_or_password_err")
            ]);
        }
        // $user->tokens()->delete();

        $token = $user->createToken('api-token')->plainTextToken;

        if($user && $token){
            $result['success'] = true;
            $result['data'] = $user;
            $result['token'] = $token;
        }

        return response()->json($result);
    }

    public function logout(Request $request)
    {
        $logout = $request->user()->tokens()->delete();

        if($logout){
            $result['success'] = true;
            $result['message'] = __('logout_success');
        }else{
            $result['success'] = false;
            $result['message'] = "something went wrong";
        }
        return response()->json($result);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
