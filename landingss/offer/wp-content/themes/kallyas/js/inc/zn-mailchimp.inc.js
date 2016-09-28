/* Prepare the newsletter and send data to MailChimp */
var wpkznSelector = jQuery('.nl-submit');
if(wpkznSelector && wpkznSelector.length > 0){
    wpkznSelector.on('click', function(event) {
        var ajax_url = jQuery(this).parent().attr('data-url'),
        result_placeholder = jQuery(this).parent().next('span.zn_mailchimp_result');
        jQuery.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                zn_mc_email: jQuery(this).prevAll('.nl-email').val(),
                zn_mailchimp_list: jQuery(this).prev('.nl-lid').val(),
                zn_ajax: '' /* Change here with something different */
            },
            success: function(data){
                if(result_placeholder && result_placeholder.length > 0) {
                    result_placeholder.html(data);
                }
            },
            error: function() {
                if(result_placeholder && result_placeholder.length > 0) {
                    result_placeholder.html('ERROR.').css('color', 'red');
                }
            }
        });
        event.preventDefault();
        return false;
    });
}
