<?php
/*
Plugin Name: LLMs.txt Sitemap Manager
Plugin URI: https://sandalia.com.bd/apps/view_project.php?slug=llms-txt-sitemap-manager
Description: Automatically generate and manage LLMs.txt files for AI/LLM consumption, with seamless integration for SEO plugins like Yoast SEO and Rank Math.
Version:1.0.4
Author: Delower
Author URI: https://github.com/delower186
License: GPLv2 or later
Text Domain: llms-txt-sitemap-manager
*/

if (!defined('ABSPATH')) exit;

define("LLMSTXTSM_DIR_PATH", plugin_dir_path(__FILE__));
define("LLMSTXTSM_DIR_URL", plugin_dir_url(__FILE__));

require_once LLMSTXTSM_DIR_PATH .'inc/llmstxtsm_enqueue.php';
require_once LLMSTXTSM_DIR_PATH .'inc/llmstxtsm_config.php';
require_once LLMSTXTSM_DIR_PATH .'inc/llmstxtsm_admin.php';
require_once LLMSTXTSM_DIR_PATH .'inc/llmstxtsm_flush.php';