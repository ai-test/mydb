<?php
return array(

    // controller + action = view template
    'TMPL_FILE_DEPR' => '_',

    // allow module list
    'MODULE_ALLOW_LIST' => array('Admin', 'Home'),
    'DEFAULT_MODULE' => 'Home',

    // check language
    'LANG_SWITCH_ON' => true,
    'LANG_AUTO_DETECT' => true,
    'LANG_LIST' => 'zh-cn,en-us',
    'VAR_LANGUAGE' => 1,

    // url model
    /**
     * 0: normal,
     * 1: Path info
     * 2: Rewrite
     * 3: Path or Rewrite
     * default: 1
     */
    'URL_MODEL' => 2,

    // Cookie settings
    'COOKIE_PREFIX' => 'ai_',

    // Database settings
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'tp_db',
    'DB_USER' => 'root',
    'DB_PWD' => '',
    'DB_PORT' => '3306',
    'DB_PREFIX' => '',

    // auth permission configuration
    'AUTH_CONFIG' => array(
        // enable
        'AUTH_ON' => true,
        /**
         * 1: anytime
         * 2: login time
         */
        'AUTH_TYPE' => 1,
        // prefix + table name
        'AUTH_GROUP' => 'auth_group',
        'AUTH_GROUP_ACCESS' => 'auth_group_access',
        'AUTH_RULE' => 'auth_rule',
        'AUTH_USER' => 'be_user',
    ),

    // Auth key
    'DATA_AUTH_KEY' => 'A(zooEX=HP_*^ZF,cools>)==-',
    // frontend auth key
    'USER_AUTH_KEY' => 'auth_id',
    // backend auth key
    'ADMIN_AUTH_KEY' => 'admin'

);