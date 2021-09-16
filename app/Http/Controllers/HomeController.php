<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;
use App\Models\Contact;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //we trying to bring the  ContactController controller to this controller so we can use it's methods
    protected $ContactController;


    public function __construct(ContactController $ContactController)
    {
        $this->middleware('auth');
        $this->ContactController = $ContactController;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $contacts = $this->ContactController->contacts();
      
        return view('home',compact('contacts'));
    }
}
