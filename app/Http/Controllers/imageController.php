<?php

namespace App\Http\Controllers;
use App\images;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
class imageController extends Controller
{

    public function index(){
        return view('contact');
    }

    public function store(Request $request)

    {
//
//        $image = new images;
//        $image->title = Input::get('name');
//        if(Input::hasFile("image")){
//            $file = Input::file('image');
//            $file = $request->file('image');
//            $file-> move (public_path(). '/images/', $file -> getClientOriginalName());
//
//             $image-> name = $file-> getClientOriginalName();
//            return response()->json(['message' => "Image added !"], 200);
//        }
//
//        $image -> save();
//        return response()->json(['message' => "Error_image: No file provided !"], 200);


//        $image = new images;
//        $image->title = Input::get('name');
//        if($request -> hasFile('image')) {   //  ALWAYS FALSE !!!!
//            $image = $request->file('image');
//
//        $input['image'] = time().'.'.$image->getClientOriginalExtension();
//
//        $destinationPath = public_path('/images');
//
//        $image->move($destinationPath, $input['image']);
//            return response()->json(['message' => "Image added !"], 200);
//        }
//        $image -> save();
//        return response()->json(['message' => "Error_image: No file provided !"], 200);


//        $this->validate($request, [
//
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//
//        ]);


//        $this->validate($request, [
//            'image' => 'imaeg|nullable|max:1999'
//        ]);
//

        if ($request->hasFile('name')) {
            $filnameWithExt = $request->file('name')->getClientOriginalName();

            $filename = pathinfo($filnameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('name')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'. time().'.'. $extension;

            $path = $request->file('name')->storeAs('/public/contact_images', $fileNameToStore);
        } else {
            $fileNameToStore = "noimage.jpg";
       }
        $post = new images;

        $post ->name = $fileNameToStore;
        $post->save();
        return response()->json(['message', 'success'], 200);

    }


}
