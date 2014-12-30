<?php

class OutsideController extends BaseController {

    /*
     * MAIN layout
     * String
     */
    protected $layout = 'master_outside';

    /*
     *  privacy policy view
     */
    public function permissionsPolicy(){

        $this->layout->content =  View::make('home.privacy');

    }
}
