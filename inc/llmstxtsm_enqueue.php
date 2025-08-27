<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// admin enqueue scripts
function llmstxtsm_enqueue_scripts($hook) {
    if ($hook !== 'settings_page_llms-txt') return;

    wp_enqueue_script('llmstxtsm_admin_js', LLMSTXTSM_DIR_URL . 'assets/llmstxtsm_admin.js', ['jquery'], '1.0', true);
    wp_localize_script('llmstxtsm_admin_js', 'llmsTxtData', [
        'allow_ai' => get_option('llmstxtsm_allow_ai', false),
        'allow_training' => get_option('llmstxtsm_allow_training', false),
        'custom_rules' => get_option('llmstxtsm_custom_rules', ''),
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('llmstxtsm_save_nonce')
    ]);
}
add_action('admin_enqueue_scripts', 'llmstxtsm_enqueue_scripts');