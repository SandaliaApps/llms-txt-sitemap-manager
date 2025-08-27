<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Flush rewrite rules on plugin activation/deactivation
register_activation_hook(__FILE__, function() {
    add_rewrite_rule('^llms\.txt$', 'index.php?llms_txt=1', 'top');
    flush_rewrite_rules();
});
register_deactivation_hook(__FILE__, function() {
    flush_rewrite_rules();
});