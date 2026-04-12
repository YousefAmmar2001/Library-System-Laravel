<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{

    /****************************** Login (Personal Access Client)  *********************************/
    /// Login (Multi Token (Default))
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|string|email',
    //         'password' => 'required|string'
    //     ]);
    //     if (! $validator->fails()) {
    //         $user = User::where('email', $request->get('email'))->first();
    //         if ($user && Hash::check($request->get('password'), $user->password)) {
    //             $token = $user->createToken('User-Token');
    //             $user->setAttribute('token', $token->accessToken);
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Logged in Successfully',
    //                 'data' => $user
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'message' => 'Login failed, wrong credenials'
    //             ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => $validator->getMessageBag()->first()
    //         ], Response::HTTP_BAD_REQUEST);
    //     }
    // }

    /// Login (Single Active Session / Restrict Multiple Login)
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|string|email',
    //         'password' => 'required|string'
    //     ]);
    //     if (! $validator->fails()) {
    //         $user = User::where('email', $request->get('email'))->first();
    //         if ($user && Hash::check($request->get('password'), $user->password)) {
    //             if (!$this->activeTokens($user->id)) {
    //                 $token = $user->createToken('User-Token');
    //                 $user->setAttribute('token', $token->accessToken);
    //                 return response()->json([
    //                     'status' => true,
    //                     'message' => 'Logged in Successfully',
    //                     'data' => $user
    //                 ]);
    //             } else {
    //                 return response()->json([
    //                     'status' => false,
    //                     'message' => 'Unable to login from two devices at the same time.',
    //                 ], Response::HTTP_UNAUTHORIZED);
    //             }
    //         } else {
    //             return response()->json([
    //                 'message' => 'Login failed, wrong credenials'
    //             ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => $validator->getMessageBag()->first()
    //         ], Response::HTTP_BAD_REQUEST);
    //     }
    // }

    // private function activeTokens($userId)
    // {
    //     return DB::table('oauth_access_tokens')
    //         ->where('user_id', $userId)
    //         ->where('name', 'User-Token')
    //         ->where('revoked', 0)
    //         ->where('expires_at', '>', now())
    //         ->count() > 0;
    // }

    /// Login (Force Login / Overwrite Session)
    // public function login(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'email' => 'required|string|email',
    //         'password' => 'required|string'
    //     ]);
    //     if (! $validator->fails()) {
    //         $user = User::where('email', $request->get('email'))->first();
    //         if ($user && Hash::check($request->get('password'), $user->password)) {
    //             $this->revokeActiveTokens($user->id);
    //             $token = $user->createToken('User-Token');
    //             $user->setAttribute('token', $token->accessToken);
    //             return response()->json([
    //                 'status' => true,
    //                 'message' => 'Logged in Successfully',
    //                 'data' => $user
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'message' => 'Login failed, wrong credenials'
    //             ], Response::HTTP_BAD_REQUEST);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => $validator->getMessageBag()->first()
    //         ], Response::HTTP_BAD_REQUEST);
    //     }
    // }

    // private function revokeActiveTokens($userId)
    // {
    //     DB::table('oauth_access_tokens')
    //         ->where('user_id', $userId)
    //         ->where('name', 'User-Token')
    //         ->where('revoked', 0)
    //         ->update(['revoked' => true]);
    // }

    /****************************** Login (Password Grant Client)  *********************************/
    /// Login (Supports Multi Auth - Use Provider)
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ], [
            'email.exists' => 'Login failed, wrong credentials'
        ]);
        if (! $validator->fails()) {
            // Create PGT
            return $this->generatePasswordGrantClientToken($request);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    private function generatePasswordGrantClientToken(Request $request)
    {
        try {
            $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'cwyxptIpq1VW7pvYeY1SsUWQ8F8OEbsQEiQxG3DJ',
                'username' => $request->get('email'),
                'password' => $request->get('password'),
                'scope' => '*',
            ]);

            $user = User::where('email', $request->get('email'))->first();
            $user->setAttribute('token', $response->json()['access_token']);
            $user->setAttribute('token_type', $response->json()['token_type']);

            return response()->json([
                'status' => true,
                'message' => 'Logged in Successfully',
                'data' => $user
            ]);
        } catch (\Exception $exception) {
            // return $response;
            $message = '';
            if ($response['error'] == 'invalid_grant') {
                $message = 'Login failed, wrong credentials';
            } else {
                $message = 'Something went wrong, please try again!';
            }
            return response()->json([
                'status' => false,
                'message' => $message
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout()
    {
        $token = auth('api')->user()->token();
        $revoked = $token->revoke();
        return response()->json([
            'status' => $revoked,
            'message' => $revoked ? 'Logged out successfully' : 'Failed to logout',
        ], $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
