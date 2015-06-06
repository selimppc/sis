<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

    //Send Email(s)::

    public function email_index(){

        if($_POST){
            $data = [
                'email_address' => Input::get('email_address'),
                'subject' => Input::get('subject'),
                'body' => Input::get('body'),
            ];
            try{
                Mail::queue('email.message_template', $data, function ($message) use ($data) {
                    $message->from('selimppc@gmail.com', 'Selim Reza');
                    $message->to($data['email_address']); //->cc('bar@example.com');
                    $message->subject($data['subject']);

                    #$message->attach($pathToFile);
                });
            }catch(Exception $e){
                print_r($e->getMessage());
            }
            Session::flash('key', 'Email Sent Successfully !');
            return redirect()->back();
        }else{
            $data = "Send Email(s) ";
            return view('email.index', compact('data'));
        }

    }

}
