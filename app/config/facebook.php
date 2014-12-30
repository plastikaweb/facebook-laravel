<?php
/**
 * User:    Carlos Matheu
 * Date:    10/10/14
 * Time:    13:15
 * Project: fb_laravel
 */

return array(

    /*
	|--------------------------------------------------------------------------
	| Facebook App Id
	|--------------------------------------------------------------------------
	|
	| The App ID of the Facebook Application
    | https://developers.facebook.com/apps/{facebook_app_id/dashboard
	|
	*/
    'APP_ID' => '',

    /*
	|--------------------------------------------------------------------------
	| Facebook App Secret
	|--------------------------------------------------------------------------
	|
	| The Secret Key of the Facebook Application
    | https://developers.facebook.com/apps/{facebook_app_id/dashboard
	|
	*/
    'APP_SECRET' => '',

    /*
	|--------------------------------------------------------------------------
	| Facebook App Scope
	|--------------------------------------------------------------------------
	|
	| The permissions the app needs and the user must accept
    | Separated by comma
    |
    | Examples: "email", "user_likes", "user_birthday"
    |
    | For a full list: https://developers.facebook.com/docs/facebook-login/permissions/v2.2#reference
	|
	*/
    'APP_SCOPE' => '',

	/*
	|--------------------------------------------------------------------------
	| Facebook App Page ID
	|--------------------------------------------------------------------------
	|
	| The Id of a page you want to promote
    | Maybe putting a link, or a button like
    |
    | Important: You cannot force users to like your page in order to access your app
    | Anyway you need a previous revision by Facebook team to access the likes of the user
	| And justify it
	|
	| Like button for The Web : https://developers.facebook.com/docs/plugins/like-button/
	|
	*/
	'APP_PAGE_LIKE' => '', //plastikaweb page ID

	/*
	|--------------------------------------------------------------------------
	| Facebook Canvas Page
	|--------------------------------------------------------------------------
	|
	| The Url of the main app
    | Format: https://apps.facebook.com/{Namespace}
    |
    | Settings: https://developers.facebook.com/apps/{facebook_app_id}/settings/
	|
	*/
	'APP_URL' => 'https://apps.facebook.com/laravel-plastikaweb/',

	/*
	|--------------------------------------------------------------------------
	| Facebook Canvas Url
	|--------------------------------------------------------------------------
	|
	| The remote server url where the application is located
    |
    | Settings: https://developers.facebook.com/apps/{facebook_app_id}/settings/
	|
	*/
	'CANVAS_URL' => 'http://www.plastikaweb.com/fb_laravel',

	/*
	|--------------------------------------------------------------------------
	| Facebook Canvas Url
	|--------------------------------------------------------------------------
	|
	| The remote server url where the mobile application is located
    |
    | Settings: https://developers.facebook.com/apps/{facebook_app_id}/settings/
	|
	*/
	'CANVAS_URL_MOBILE' => 'http://www.plastikaweb.com/fb_laravel/mobile'
	);
