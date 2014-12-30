/**
 * @fileOverview sharing some data with a message via email
 * including validation (depends on jquery.validate.js
 * @author info@plastikaweb.com (Carlos Matheu)
 */
/**
 * Class ShareViaEmail that sends
 * message via email to friends
 *
 * @param el
 * @param form
 * @constructor
 */


function ShareViaEmail(el, form) {

    this.el = el;
    this.form = form;
    var ob = this;

    //init conf
    this.init = function(){
        this.validateConf();
        this.ajaxConf();
        this.el.on('click', this.shareEmail);
    };

    /**
     * send invitations to friends via email
     * @param {Object} [e] event object
     */

    this.shareEmail = function(e) {
        e.preventDefault();
        ob.form.submit();
    };

    /**
     * validate required fields
     */
    this.validateConf = function() {

        //validation object with parameters
        var obj = {
            ignore: [],
            showErrors: function(errorMap, errorList) {
                if (this.numberOfInvalids() > 0) {
                    console.log("You have " + this.numberOfInvalids() +
                    " you have an error in your form");

                } else {
                    $('.error').removeClass('error');
                }

                this.defaultShowErrors();
            },
            errorPlacement: function(error, element) {
                console.log(error);
                //prevent to show error message label next to every input
            }

        };
        // validate the form when it is submitted and on focus
        ob.form.validate(obj);
    };

    /**
     * send form via ajax call
     */
    this.ajaxConf = function() {

        this.form.ajaxForm({

            beforeSend: function() {
                ob.form.attr('disabled', true).addClass('fake_disable');
            },
            complete: function(xhr) {
                ob.form.removeAttr('disabled').removeClass('fake_disable');
                var decodejson = (jQuery.parseJSON(xhr.responseText)),
                    response = decodejson['results'];
                $('input[name="emails"]').val("");
                console.log(response.message);
            }

        });

    };

}

$(document).on('ready', function() {

    //init behavior of form sending via ajax / with validation
    /**
     * @type {ShareViaEmail}
     */
    var shareEmail = new ShareViaEmail($('#invite_email'), $('#form_email'));
    shareEmail.init();

});

