<?php 
// admin enqueue scripts
function llms_txt_enqueue_scripts($hook) {
    if ($hook !== 'settings_page_llms-txt') return;

    wp_enqueue_script('llms-txt-admin-js', LLMS_TXT_PLUGIN_DIR_URL . 'assets/llms-txt-manager-admin.js', ['jquery'], '1.0', true);
    wp_localize_script('llms-txt-admin-js', 'llmsTxtData', [
        'allow_ai' => get_option('llms_txt_allow_ai', false),
        'allow_training' => get_option('llms_txt_allow_training', false),
        'custom_rules' => get_option('llms_txt_custom_rules', ''),
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('llms_txt_save_nonce')
    ]);
}
add_action('admin_enqueue_scripts', 'llms_txt_enqueue_scripts');