<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\FavoriteGenres;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class GenresController extends Controller {

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
      $user = $request->user();
      $this->validate($request, [
          'id' => 'required',
      ]);
      return tap($user)->update(['genres' => $request->id]);
    }
}
