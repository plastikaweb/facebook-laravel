<?php

class HomeController extends FacebookController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    /*
     * MAIN layout
     * String
     */
    protected $layout = 'master';

    /*
     * fb user data
     * Array
     */
    protected $user;

    public function __construct(){

        parent::__construct();

        Config::set('facebook.USER_ID', $this->checkUser());
        //check if user is present and get data or log or ask for app permissions
        $this->user = $this->getUser();

    }

    /*
     * initial loading of the app
     */
	public function showWelcome(){

        $this->layout->content =  View::make('home.hello', array('facebookUser' => $this->user));


	}

    /*
     * redirects to the app page
     */
    public function showTab(){

        return View::make('home.tab_redirect');

    }

    /*
     *  privacy policy view
     */
    public function showLegal(){

        $this->layout->content =  View::make('home.privacy');

    }

    public function ajaxresponse(){

        //check if its our form
        if ( Session::token() !== Input::get( '_token' ) ) {
             return json_encode(array( 'results' => array( 'status' => 'error', 'message' => 'acción ilegal' ) ) );
        }

        $rec = str_replace(' ', '', Input::get( 'emails' ));



        if(empty($rec)){//missatge buit
            return json_encode(array( 'results' => array( 'status' => 'error', 'message' => 'debes introducir al menos una dirección de correo' ) ) );
        }

        $receivers = (explode( ",", $rec ));

        foreach($receivers as $receiver){
            if(!filter_var($receiver, FILTER_VALIDATE_EMAIL)){
                return json_encode(array( 'results' => array( 'status' => 'error', 'message' => 'revisa el formato de las direcciones de correo' ) ) );
            }
        }

        //send mail
        Mail::send('emails.send', array('name' => 'Plastikaweb'), function($message) use ($receivers){
            $message->bcc($receivers)->subject('message subject');
        });

        //exit total
        return json_encode(array( 'results' => array( 'status' => 'success', 'message' => 'el mensaje se ha enviado correctamente' ) ) );

    }

}
