<?php

return array (
  'utf_mode' =>
  array (
    'value' => true,
    'readonly' => true,
  ),
  'cache_flags' =>
  array (
    'value' =>
    array (
      'config_options' => 3600.0,
      'site_domain' => 3600.0,
    ),
    'readonly' => false,
  ),
  'cookies' =>
  array (
    'value' =>
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
  'exception_handling' =>
  array (
    'value' =>
    array (
      'debug' => false,
      'handled_errors_types' => 4437,
      'exception_errors_types' => 4437,
      'ignore_silence' => false,
      'assertion_throws_exception' => true,
      'assertion_error_type' => 256,
      'log' => NULL,
    ),
    'readonly' => false,
  ),
  'connections' =>
  array (
    'value' =>
    array (
      'default' =>
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
        'host' => 'localhost',
        'database' => '',
        'login' => '',
        'password' => '',
        'options' => 2.0,
      ),
    ),
    'readonly' => true,
  ),
  'crypto' =>
  array (
    'value' =>
    array (
      'crypto_key' => '',
    ),
    'readonly' => true,
  ),

  // site config
  'site' => array(
      'value' => array(
          // main
          'name' => '',
          'name_short' => '',
          'description' => '',
          'slogan' => '',
          'since' => 2020,
          // contacts
          'phone' => '',
          'email' => '',
          // address
          'address' => '',
          'address_full' => '',
          'gps' => array(
              'lat' => 0,
              'lon' => 0
          ),
          // emails
          'email_restaurant' => '',
          'email_manager' => '',
          'send_to' => array(
              '',
          ),
          // developer
          'developer' => '',
          'developer_url' => '',
          // socials
          'socials' => array(
              'vk' => 'https://vk.com/',
          ),
      ),
      'readonly' => true,
  ),
);
