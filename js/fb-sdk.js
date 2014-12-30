/**
 * @fileOverview Loading and initializing facebook js sdk
 * @author info@plastikaweb.com (Carlos Matheu)
 */
(function(){
  'use strict';

    var sdk; //global object FbSdk

    window.fbAsyncInit = function () {

        FB.init({
            appId: fbAppId.toString(),
            xfbml: true,
            version: 'v2.1'
        });

        FB.Canvas.setAutoGrow();//iframe resize
        FB.Canvas.scrollTo(0, 0);//iframe scroll to top

        //CHECk the user status
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                // the user is logged in and has authenticated your
                // app, and response.authResponse supplies
                // the user's ID, a valid access token, a signed
                // request, and the time the access token
                // and signed request each expire
                var uid = response.authResponse.userID,
                    accessToken = response.authResponse.accessToken;
            } else if (response.status === 'not_authorized') {
                // the user is logged in to Facebook,
                // but has not authenticated your app
                console.log("not authenticated or logged user");
            } else {
                // the user isn't logged in to Facebook.
                console.log("not logged user");
            }
        });


        //on user like action, reload page
        FB.Event.subscribe('edge.create', function () {
            location.reload();
        });

        /**
         * FbSdk object assignement
         * @type {FbSdk}
         */
        sdk = new FbSdk(fbAppId, FB);
    };



//FB sdk js
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/es_ES/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));




$(document).on('ready', function () {

    // btn listener - using namespace "fb"
    $('.row').on('click.fb', 'button', function (event) {

        var btn = $(this), id = btn.attr('id');
        switch (id) {
            case 'post_to_wall':
                sdk.postToWall(dataUser); //post to current user wall
                break;
            case 'hello_user':
                sdk.getUser(); //get data from current user
                break;
            case 'invite_friends':
                sdk.inviteFriends(5, btn); //invite friends to use app
                break;

        }

    });

});


    /**
     * Class FbSdk that controls
     * some facebook plugins and api behaviors
     *
     * @param {String} [app_id] facebook app id
     * @param {Object} [fb] facebook object
     * @constructor
     */
    function FbSdk(appId, fb) {

        this.appId = appId.toString();
        this.fb = fb;

        /*
         * Nice scrolling of facebook iframe passing an  Y parameter
         *
         * @param {Number} [y] The distance in pixels
         */
        this.scroll = function (y) {

            this.fb.Canvas.getPageInfo(function (pageInfo) {
                $({
                    y: pageInfo.scrollTop
                }).animate({
                    y: y
                }, {
                    duration: 1000,
                    step: function (offset) {
                        FB.Canvas.scrollTo(0, offset);
                    }
                });
            });
        };


        /*
         * get fb user data
         */
        this.getUser = function () {
            this.fb.api('/me', function (response) {
                alert('Good to see you, ' + response.name + '.');
                console.log(response);
            });
        };


        /*
         * invite friends to use app
         *
         * @param minFriends
         * @param btn
         * @param maxFriends
         *
         */
        this.inviteFriends = function (minFriends, btn, maxFriends) {

            var message = 'invite your friends!', num = minFriends ? minFriends : 0;
            if (minFriends > 0) {
                message = 'choose ' + minFriends + ' or more friends';
            }
            var data = {
                method: 'apprequests',
                message: message,
                filters: ['app_non_users'],
                max_recipients: maxFriends
            };

            this.fb.ui(data,
                function (response) {

                    //check if user has checked at least one friend
                    //this generates an object with properties
                    if (!$.isEmptyObject(response)) {

                        var friendsIds = response.to;//check number of friends
                        console.log(friendsIds);

                        if ((typeof friendsIds !== typeof undefined) && friendsIds.length < minFriends) {

                            var warning = 'Has invitado a sólo ' +
                                    friendsIds.length + ' amistades.' + " \n" +
                                    'Recuerda que para poder participar ' + " \n" +
                                    'tienes que invitar a cinco amistades o más!',
                                r = confirm(warning);

                            if (r === true) {
                                btn.trigger('click');//trigger click again on btn if user accepts
                            }

                        } else if ((typeof friendsIds !== typeof undefined)) {
                            console.log(friendsIds); // array with friends ids
                            alert("friends invited!");
                        }

                    }

                }
            );

        };


        /*
         * Post a comment to the current user profile
         *
         * @param {Object} [params] post data
         * @param {String} [params.method]
         * @param {String} [params.name]
         * @param {String} [params.description]
         * @param {String} [params.link]
         * @param {String} [params.picture]
         */
        this.postToWall = function (params) {
            this.fb.ui(params);
        };

    }

})();