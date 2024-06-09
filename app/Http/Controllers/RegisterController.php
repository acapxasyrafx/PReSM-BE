<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Mail\WelcomeMail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'emailId' => 'required|email',
            'password' => 'required',
            'password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;


        $title = 'Welcome to the PReMS';
        $body = 'Thank you for participating!';
        $email = $request -> emailId;

        Mail::to($email)->send(new WelcomeMail($title, $body));

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['emailId' => $request->emailId, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'emailId' => 'required|email',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $new_password = Str::random(7);
        $input = $request->all();
        $input['password'] = bcrypt($new_password);
        User::where('emailId', $input['emailId'])->update([
            'password' => $input['password'],
            // Add more columns and their corresponding new values as needed
        ]);


        $title = 'PReMS : Did You Forget Your Password ? ';
        $body = sprintf('Your New Password is: %s', $new_password);
        $email = $input['emailId'];

        Mail::to($email)->send(new ForgotPasswordMail($title, $body));

        return $this->sendResponse('Success', 'Password Reset successfully.');
    }
}
