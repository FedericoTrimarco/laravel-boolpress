<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contact;

class ContactController extends Controller
{   
    public function index(){
        $contact = Contact::all();

        // $posts = Post::orderBy('id', 'desc')->paginate(3);
        return response()->json($contact);
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->all();

        // sabe db
        $contact =  new Contact();
        $contact->fill($data);
        $contact->save();
        return response()->json($data);
    }
}
