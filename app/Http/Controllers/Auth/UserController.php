<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller {

    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request) {
        return response()->json($request->user());
    }

    public function show($id) {
        $user = User::find($id);
        if($user) {
          return response()->json($user, 200);
        }
        return response()->json(['status'=> false], 404);
    }
}
