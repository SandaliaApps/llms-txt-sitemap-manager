jQuery(document).ready(function ($) {
    // Set initial values
    $('#llms_allow_ai').prop('checked', llmsTxtData.allow_ai == 1);
    $('#llms_allow_training').prop('checked', llmsTxtData.allow_training == 1);
    $('#llms_custom_rules').val(llmsTxtData.custom_rules);

    // Save Settings
    $('#llms_save').on('click', function () {
        $('#llms_status').html('<span style="color:blue;">Saving...</span>');

        $.post(llmsTxtData.ajax_url, {
            action: 'llms_txt_save_settings',
            nonce: llmsTxtData.nonce,
            allow_ai: $('#llms_allow_ai').is(':checked') ? 1 : 0,
            allow_training: $('#llms_allow_training').is(':checked') ? 1 : 0,
            custom_rules: $('#llms_custom_rules').val()
        }, function (response) {
            if (response.success) {
                $('#llms_status').html('<span style="color:green;">Settings Saved!</span>');
                setTimeout(() => $('#llms_status').html(''), 3000);
            } else {
                $('#llms_status').html('<span style="color:red;">Failed to save.</span>');
            }
        });
    });
});
