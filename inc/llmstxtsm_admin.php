<?php
if (!defined('ABSPATH')) exit;

// Settings callback function
function llmstxtsm_admin_page() {
    ?>
    <div class="wrap">
        <h1>LLMs.txt Settings - AI Crawler & Training Control</h1>
        <p>Optimize how AI crawlers and training models interact with your WordPress content. Configure custom rules for better SEO and privacy.</p>

        <form method="post" action="options.php">
            <?php
            settings_fields('llmstxtsm_settings_group');
            do_settings_sections('llmstxtsm_settings');
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

// Create settings page
add_action('admin_menu', function () {
    add_options_page('LLMs.txt', 'LLMs.txt', 'manage_options', 'llms-txt', 'llmstxtsm_admin_page');
});

// Save settings via AJAX
add_action('wp_ajax_llmstxtsm_save_settings', function () {
    check_ajax_referer('llmstxtsm_save_nonce', 'nonce');

    update_option('llmstxtsm_allow_ai', intval(isset($_POST['allow_ai'])));
    update_option('llmstxtsm_allow_training', intval(isset($_POST['allow_training'])));
    update_option('llmstxtsm_custom_rules', sanitize_textarea_field(wp_unslash(isset($_POST['custom_rules']))));

    wp_send_json_success();
});

// Register settings fields
add_action('admin_init', function() {

    // Register settings with sanitization callbacks
    register_setting('llmstxtsm_settings_group', 'llmstxtsm_allow_ai', function($input) {
        return $input ? 1 : 0; // Ensure checkbox is 0 or 1
    });

    register_setting('llmstxtsm_settings_group', 'llmstxtsm_allow_training', function($input) {
        return $input ? 1 : 0; // Ensure checkbox is 0 or 1
    });

    register_setting('llmstxtsm_settings_group', 'llmstxtsm_custom_rules', function($input) {
        return sanitize_textarea_field($input); // Sanitize textarea input
    });

    // Add settings section
    add_settings_section(
        'llmstxtsm_main_section',
        'General Settings',
        function() {
            echo '<p>Control AI crawlers, training access, and include dynamic URLs to improve content privacy and SEO.</p>';
        },
        'llmstxtsm_settings'
    );

    // Add Allow AI Crawlers checkbox field
    add_settings_field(
        'llmstxtsm_allow_ai',
        'Allow AI Crawlers',
        function() {
            $val = get_option('llmstxtsm_allow_ai', 1);
            echo '<input type="checkbox" name="llmstxtsm_allow_ai" value="1" '.checked(1, $val, false).'> Enable AI Crawlers (like ChatGPT, Google Bard)';
        },
        'llmstxtsm_settings',
        'llmstxtsm_main_section'
    );

    // Add Allow AI Training checkbox field
    add_settings_field(
        'llmstxtsm_allow_training',
        'Allow AI Training on Your Content',
        function() {
            $val = get_option('llmstxtsm_allow_training', 1);
            echo '<input type="checkbox" name="llmstxtsm_allow_training" value="1" '.checked(1, $val, false).'> Allow your site to be used for AI model training.';
        },
        'llmstxtsm_settings',
        'llmstxtsm_main_section'
    );

    // Add Custom LLMs.txt Rules textarea field
    add_settings_field(
        'llmstxtsm_custom_rules',
        'Custom LLMs.txt Rules',
        function() {
            $val = get_option('llmstxtsm_custom_rules', '');
            echo '<textarea name="llmstxtsm_custom_rules" rows="5" style="width:100%;">'.esc_textarea($val).'</textarea>';
            echo '<p class="description">Example: User-Agent: OpenAI Disallow: /private/</p>';
        },
        'llmstxtsm_settings',
        'llmstxtsm_main_section'
    );

    add_settings_field(
        'sitemap_view',
        'Sitemap',
        function() {
            $site_root_url = site_url() . '/llms.txt';
            echo '<a target="_blank" href='.esc_url($site_root_url).'>'.esc_url($site_root_url).'</a>';
        },
        'llmstxtsm_settings',
        'llmstxtsm_main_section'
    );
});

