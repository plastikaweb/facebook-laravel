<?php

class FacebookController extends BaseController {

    public function __construct(){

        //init fb connection
        $application = array(
            'appId' => Config::get('facebook.APP_ID'),
            'secret' => Config::get('facebook.APP_SECRET'),
            'cookie' => false
        );

        FacebookConnect::getFacebook($application);

    }

    /**
     * get Facebook User
     */
    protected function getUser() {

        $user_id = $this->checkUser();

        if (!$user_id) {
            try {
                $user = $this->login();
            } catch (Exception $e) {
                die('<script type="text/javascript">window.top.location.href = "' . Request::url() . '";</script>');
            }

        } else {
            // Call Facebook Permission
            $user = $this->login();
        }


        return $user['user_profile'];

    }


    /*
    * return fb user data or return to permissions dialog
    */
    private function login(){
            //if is mobile facebook.APP_URL is updated in routes.php
            $redirect_uri = Config::get('facebook.APP_URL');

        //die($redirect_uri);
        return FacebookConnect::getUser(Config::get('facebook.APP_SCOPE'), $redirect_uri);
    }

    /*
     * return fb user uid - if not return 0
     */
    protected function checkUser(){
        return FacebookConnect::getFacebook()->getUser();
    }

    public function getFriends(){

        return FAcebookConnect::getFacebook()->api('/me/invitable_friends');

    }


}
