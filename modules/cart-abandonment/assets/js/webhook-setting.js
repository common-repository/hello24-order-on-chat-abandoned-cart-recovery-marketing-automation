(function ($) {
    var webhookSetting = {

        init: function () {

            function onChangeAPIKey() {
                if ($("#setting_api_key").val() == "") {
                    $("#h24_save_settings").css("display", "none");
                } else {
                    $("#h24_save_settings").css("display", "inline-block");
                }

                if ($("#setting_h24_domain").val() == "") {
                    $("#h24_goto_settings").css("display", "none");
                    $("#h24_enable_integration_note").css("display", "inline-block");
                } else {
                    $("#h24_goto_settings").css("display", "inline-block");
                    $("#h24_enable_integration_note").css("display", "none");
                }

                if ($("#setting_api_key").val() == "" && $("#setting_h24_domain").val() == "") {
                    $("#h24_save_settings").css("display", "none");
                }

                if ($("#setting_api_key").val() == "" && $("#setting_h24_domain").val() != "") {
                    $("#h24_save_settings").css("display", "inline-block");
                }
            }

            onChangeAPIKey();

            $("#wp_h24_setting_form").submit(function () {
                return false;
            })

            $("#wp_h24_chat_button_form").submit(function () {
                return false;
            })

            $("#setting_api_key").on("change", function () {
                onChangeAPIKey();
            })

            $("#setting_api_key").on("keydown", function () {
                $("#api_key_invalid").css("display", "none");
                onChangeAPIKey();
            })

            $("body").on("click", "#h24_open_hello24_dashboard", function () {
                var data = {
                    action: "h24_open_hello24_dashboard",
                    security: WPVars._nonce,
                };
                jQuery("#h24_loding").css("display", "flex");
                jQuery.post(
                    WPVars.ajaxurl, data, //Ajaxurl coming from localized script and contains the link to wp-admin/admin-ajax.php file that handles AJAX requests on Wordpress
                    function (response) {
                        jQuery("#h24_loding").css("display", "none");
                        if (response.data) {
                            var login_url = response.data;
                            location.href = login_url;
                        } else {
                            console.log('Authentication failed. Please contact support team.');
                            alert('Authentication failed. Please contact support team.');
                        }
                    }
                );
            })

            $("body").on("click", "#h24_save_settings", function () {
                if ($("#setting_shop_name").val() == "" || $("#setting_email").val() == "" || $("#setting_phone_number").val() == "") {
                    return;
                }
                var data = {
                    action: "h24_activate_integration_service",
                    security: WPVars._nonce,
                    api_key: $("#setting_api_key").val(),
                    shop_name: $("#setting_shop_name").val(),
                    email: $("#setting_email").val(),
                    phone_number: $("#setting_phone_number").val(),
                    environment: $("input[name='setting_environment']:checked").val(),
                };
                jQuery("#h24_loding").css("display", "flex");
                jQuery.post(
                    WPVars.ajaxurl, data, //Ajaxurl coming from localized script and contains the link to wp-admin/admin-ajax.php file that handles AJAX requests on Wordpress
                    function (response) {
                        jQuery("#h24_loding").css("display", "none");
                        if (response.data && response.data.result) {
                            location.href = "";
                        } else {
                            $("#api_key_invalid").css("display", "inline-block");
                        }
                    }
                );
            });

            $("body").on("click", "#h24_save_chat_button", function () {

                var chat_button_enabled = "disabled";
                if ($("#chat_button_enabled").is(':checked')) {
                    chat_button_enabled = "enabled";
                }

                var data = {
                    action: "h24_save_chat_button",
                    chat_button_enabled: chat_button_enabled,
                    chat_button_theme_color: $("#chat_button_theme_color").val(),
                    chat_button_theme_color_gradient: $("#chat_button_theme_color_gradient").val(),
                    chat_button_title: $("#chat_button_title").val(),
                    chat_button_sub_title: $("#chat_button_sub_title").val(),
                    chat_button_greeting_text1: $("#chat_button_greeting_text1").val(),
                    chat_button_greeting_text2: $("#chat_button_greeting_text2").val(),
                    chat_button_agent_name: $("#chat_button_agent_name").val(),
                    chat_button_message: $("#chat_button_message").val(),
                    chat_button_position: $("#chat_button_position").val(),
                    chat_button_bottom: $("#chat_button_bottom").val(),
                };

                jQuery("#h24_loding").css("display", "flex");
                jQuery.post(
                    WPVars.ajaxurl, data, //Ajaxurl coming from localized script and contains the link to wp-admin/admin-ajax.php file that handles AJAX requests on Wordpress
                    function (response) {
                        jQuery("#h24_loding").css("display", "none");
                        if (response.data && response.data.result) {
                            location.href = "";
                        } else {

                        }
                    }
                );
            });
        },
    }

    webhookSetting.init();

    jQuery(document).ready(function () {

        jQuery('#chat_button_theme_color').wpColorPicker();
        jQuery('#chat_button_theme_color_gradient').wpColorPicker();

    });

})(jQuery);