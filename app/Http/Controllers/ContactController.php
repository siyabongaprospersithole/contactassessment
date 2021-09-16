<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\GenderType;
use DB;
use App\Mail\Noreply;
use Mail;


class ContactController extends Controller
{

    //add new contacts page, passess gender types to the blade file
    public function index(){
        $genders = GenderType::all();
        return view('welcome',compact('genders'));
    }


    //method to get all contacts
    public function contacts(){
        return Contact::SELECT(
                    'contacts.id'
                    ,DB::raw("ROW_NUMBER() OVER (ORDER BY contacts.gender_id) as rownum")
                    ,'contacts.name'
                    ,'contacts.email'
                    ,'contacts.content'
                    ,'gender_types.gender_name'
                    ,'contacts.created_at'
                    ,'contacts.gender_id'
                )
                ->leftjoin('gender_types','gender_types.id', '=', 'contacts.gender_id')
                ->orderby('gender_id','DESC')
                ->get(); 
    }


    //method to store new contacts
    public function store(Request $request){
          
        //basic validation 
         $this->validate($request,[
          'name' => 'required|min:3|max:50',
          'email' => 'required:unique:contacts|email|min:3|max:50',
          'gender' => 'required|numeric',
          'content' => 'required|min:3|max:50',
        ]);


        //incase we get an error, we would want to do a transaction so that nothing get's stored
        DB::beginTransaction();
        try {

            //store details to the database
        $create_contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender_id' => $request->gender,
            'content' => $request->content
            ]);
            
            //send email to user
            //please create a mailtrap.io account and insert the laravel's integration details
            //on to this application's .env file located on the root folder
            //the application is using the sync driver so the page might take 3 seconds to return a 
            //succesfull response to the user
            Mail::to($create_contact->email)->send(new Noreply($create_contact->name));

            //if everything is succesfully, then store on the database
            DB::commit();

            return response()->json(['status' => 'success']);
        } 
        catch (\Exception $e) //catch any errors
        { 
            //roll basic if any data was saved before the error
            DB::rollback();
           
            //return error
            return $e;
        }
    }
}
