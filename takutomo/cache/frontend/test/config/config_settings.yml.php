<?php
// auto-generated by sfDefineEnvironmentConfigHandler
// date: 2010/11/05 14:15:50
sfConfig::add(array(
  'sf_error_404_module' => 'default',
  'sf_error_404_action' => 'error404',
  'sf_login_module' => 'index',
  'sf_login_action' => 'index',
  'sf_secure_module' => 'default',
  'sf_secure_action' => 'secure',
  'sf_module_disabled_module' => 'default',
  'sf_module_disabled_action' => 'disabled',
  'sf_use_database' => true,
  'sf_i18n' => false,
  'sf_compressed' => false,
  'sf_check_lock' => false,
  'sf_csrf_secret' => false,
  'sf_escaping_strategy' => true,
  'sf_escaping_method' => 'ESC_SPECIALCHARS',
  'sf_no_script_name' => false,
  'sf_cache' => false,
  'sf_etag' => false,
  'sf_web_debug' => false,
  'sf_error_reporting' => 32759,
  'sf_file_link_format' => NULL,
  'sf_admin_web_dir' => '/sf/sf_admin',
  'sf_web_debug_web_dir' => '/sf/sf_web_debug',
  'sf_standard_helpers' => array (
  0 => 'Partial',
  1 => 'Cache',
),
  'sf_enabled_modules' => array (
  0 => 'default',
),
  'sf_charset' => 'utf-8',
  'sf_logging_enabled' => true,
  'sf_default_culture' => 'en',
  'sf_takutomo_url' => 'http://api.takutomo.com/v3/member/',
  'sf_takutomo_member' => 'http://api.takutomo.com/v3/member/',
  'sf_takutomo_register_by_guid_url' => 'http://api.takutomo.com/v3/member/register_by_guid.php?api_key=pontuyo',
  'sf_takutomo_register_by_email_url' => 'http://api.takutomo.com/v3/member/register_by_email.php?api_key=pontuyo',
  'sf_takutomo_get_profile_myself_url' => 'http://api.takutomo.com/v3/member/get_profile_myself.php?api_key=pontuyo',
  'sf_takutomo_search_driver_url' => 'http://api.takutomo.com/v3/member/search_driver.php?api_key=pontuyo',
  'sf_takutomo_search_event_url' => 'http://api.takutomo.com/v3/member/search_event.php?api_key=pontuyo',
  'sf_takutomo_get_event_detail_url' => 'http://api.takutomo.com/v3/member/get_event_detail.php?api_key=pontuyo',
  'sf_takutomo_get_profile_url' => 'http://api.takutomo.com/v3/member/get_profile.php?api_key=pontuyo',
  'sf_takutomo_get_eval_comments_url' => 'http://api.takutomo.com/v3/member/get_eval_comments.php?api_key=pontuyo',
  'sf_takutomo_add_event_comment_url' => 'http://api.takutomo.com/v3/member/add_event_comment.php?api_key=pontuyo',
  'sf_takutomo_add_event_url' => 'http://api.takutomo.com/v3/member/add_event.php?api_key=pontuyo',
  'sf_takutomo_get_attend_event_url' => 'http://api.takutomo.com/v3/member/get_attend_event.php?api_key=pontuyo',
  'sf_takutomo_forgot_password_url' => 'http://api.takutomo.com/v3/member/forgot_password.php?api_key=pontuyo',
  'sf_takutomo_reserve_driver_url' => 'http://api.takutomo.com/v3/member/reserve_driver.php?api_key=pontuyo',
  'sf_takutomo_edit_email_url' => 'http://api.takutomo.com/v3/member/edit_email.php?api_key=pontuyo',
  'sf_takutomo_edit_profile_url' => 'http://api.takutomo.com/v3/member/edit_profile.php?api_key=pontuyo',
  'sf_takutomo_delete_user_url' => 'http://api.takutomo.com/v3/member/delete_user.php?api_key=pontuyo',
  'sf_takutomo_eval_user_url' => 'http://api.takutomo.com/v3/member/eval_user.php?api_key=pontuyo',
  'sf_takutomo_get_reserved_driver_url' => 'http://api.takutomo.com/v3/member/get_reserved_driver.php?api_key=pontuyo',
  'sf_mixi_index_url' => 'http://mixi.takutomo.com/takutomo/web/',
  'sf_mixi_member_url' => 'http://mixi.takutomo.com/takutomo/web/member',
  'sf_mixi_member_register_url' => 'http://mixi.takutomo.com/takutomo/web/member_register',
  'sf_mixi_search_driver_url' => 'http://mixi.takutomo.com/takutomo/web/search_driver',
  'sf_mixi_reserve_driver_url' => 'http://mixi.takutomo.com/takutomo/web/reserve_driver',
  'sf_mixi_search_event_url' => 'http://mixi.takutomo.com/takutomo/web/search_event',
  'sf_mixi_add_event_url' => 'http://mixi.takutomo.com/takutomo/web/add_event',
  'sf_mixi_add_event_comment_url' => 'http://mixi.takutomo.com/takutomo/web/add_event_comment',
  'sf_mixi_get_attend_event_url' => 'http://mixi.takutomo.com/takutomo/web/get_attend_event',
  'sf_mixi_get_event_detail_url' => 'http://mixi.takutomo.com/takutomo/web/get_event_detail',
  'sf_mixi_get_eval_comments_url' => 'http://mixi.takutomo.com/takutomo/web/get_eval_comments',
  'sf_mixi_get_profile_url' => 'http://mixi.takutomo.com/takutomo/web/get_profile',
  'sf_mixi_delete_user_url' => 'http://mixi.takutomo.com/takutomo/web/delete_user',
  'sf_mixi_edit_email_url' => 'http://mixi.takutomo.com/takutomo/web/edit_email',
  'sf_mixi_edit_profile_url' => 'http://mixi.takutomo.com/takutomo/web/edit_profile',
  'sf_mixi_forgot_password_url' => 'http://mixi.takutomo.com/takutomo/web/edit_forgot_password',
  'sf_mixi_eval_member_url' => 'http://mixi.takutomo.com/takutomo/web/eval_member',
  'sf_mixi_eval_driver_url' => 'http://mixi.takutomo.com/takutomo/web/eval_driver',
  'sf_mixi_eval_user_url' => 'http://mixi.takutomo.com/takutomo/web/eval_user',
  'sf_mixi_get_reserved_driver_url' => 'http://mixi.takutomo.com/takutomo/web/get_reserved_driver',
  'sf_opensocial_person_api' => 'http://api.mixi-platform.com/os/0.8/people/@me/@self',
  'sf_opensocial_person_guid_api' => 'http://api.mixi-platform.com/os/0.8/people/',
  'sf_opensocial_persistence_api' => 'http://api.mixi-platform.com/os/0.8/appdata/@me/@self/@app',
  'sf_geocoding_url' => 'http://www.geocoding.jp/api/',
  'sf_google_geo_url' => 'http://maps.google.com/maps/geo',
  'sf_google_static_map_url' => 'http://maps.google.com/maps/api/staticmap',
  'sf_google_key' => 'ABQIAAAAo2gOntJdJP0vWOkOQiA33RSifarTDGdmkI_keUZoPQKhvsp4IhSo2uheTjqvLBPKuLvrIgRWj4izig',
  'sf_date_week' => array (
  0 => '日',
  1 => '月',
  2 => '火',
  3 => '水',
  4 => '木',
  5 => '金',
  6 => '土',
),
  'sf_evaluate_max_number' => 5,
));
