<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Auth;
class ImageController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $user = $request->user();
        $this->validate($request, [
            'image' => 'required',
        ]);
        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();
        $destinationPath = public_path('../client/static/avatars');
        $img = Image::make($image->path());
        $img->fit(500, 600, function ($constraint) {
            $constraint->upsize();
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        return tap($user)->update(['photo' => '/avatars/'.$input['imagename']]);
    }

    public function destroy(Request $request) {
      $user = $request->user();
      return tap($user)->update(['photo' => null]);

    }

}
?>
