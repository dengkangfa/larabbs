<?php

return array(

    /*
     * 后台的 URI 人口
     *
     * @type string
     */
    'uri' => 'admin',

    /*
     *  后台专属域名，没有的话可以留空
     *
     *  @type string
     */
    'domain' => '',

    /*
     * 应用名称，在页面标题和左上角站点名称处显示
     *
     * @type string
     */
    'title' => env('APP_NAME', 'Laravel'),

    /*
     * 模型配置信息文件存放目录
     *
     * @type string
     */
    'model_config_path' => config_path('administrator'),

    /*
     * 配置信息文件存放目录
     *
     * @type string
     */
    'settings_config_path' => config_path('administrator/settings'),

    /*
     * The menu structure of the site. For models, you should either supply the name of a model config file or an array of names of model config
     * files. The same applies to settings config files, except you must prepend 'settings.' to the settings config file name. You can also add
     * custom pages by prepending a view path with 'page.'. By providing an array of names, you can group certain models or settings pages
     * together. Each name needs to either have a config file in your model config path, settings config path with the same name, or a path to a
     * fully-qualified Laravel view. So 'users' would require a 'users.php' file in your model config path, 'settings.site' would require a
     * 'site.php' file in your settings config path, and 'page.foo.test' would require a 'test.php' or 'test.blade.php' file in a 'foo' directory
     * inside your view directory.
     *
     * @type array
     *
     * 	array(
     *		'E-Commerce' => array('collections', 'products', 'product_images', 'orders'),
     *		'homepage_sliders',
     *		'users',
     *		'roles',
     *		'colors',
     *		'Settings' => array('settings.site', 'settings.ecommerce', 'settings.social'),
     * 		'Analytics' => array('E-Commerce' => 'page.ecommerce.analytics'),
     *	)
     */
    'menu' => [
        '用户与权限' => [
            'users',
            'roles',
            'permissions'
        ],
        '内容管理' => [
            'categories',
            'topics',
            'replies'
        ],
        '站点管理' => [
            'settings.site'
        ]
    ],

    /*
     * The permission option is the highest-level authentication check that lets you define a closure that should return true if the current user
     * is allowed to view the admin section. Any "falsey" response will send the user back to the 'login_path' defined below.
     *
     * @type closure
     */
    'permission' => function () {
        // 只要是能管理内容的用户，就允许访问后台
        return Auth::check() && Auth::user()->can('manage_contents');
    },

    /*
     * 使用布尔值来设定是否使用后台主页面。
     *
     * 如值为 `true`，将使用 `dashboard_view` 定义的视图文件渲染页面；
     * 如值为 `false`，将使用 `home_page` 定义的菜单条目来作为后台主页。
     *
     * @type bool
     */
    'use_dashboard' => false,

    /*
     * 设置后台主页视图文件，由 `use_dashboard` 选项决定
     *
     * @type string
     */
    'dashboard_view' => '',

    /*
     * 用来作为后台主页的菜单条目，由 `use_dashboard` 选项决定，菜单指的是 `menu` 选项
     *
     * @type string
     */
    'home_page' => 'users',

    /*
     * 右上角『返回主站』按钮的链接
     *
     * @type string
     */
    'back_to_site_path' => '/',

    /*
     * 当选项 `permission` 权限检测不通过时，会重定向用户到此处设置的路径
     *
     * @type string
     */
    'login_path' => 'login',

    /*
     * The logout path is the path where Administrator will send the user when they click the logout link
     *
     * @type string
     */
    'logout_path' => false,

    /*
     * 允许在登录成功后使用 Session::get('redirect') 将用户重定向到原本想要访问的后台页面
     *
     * @type string
     */
    'login_redirect_key' => 'redirect',

    /*
     * 控制模型数据列表页默认的显示条目
     *
     * @type int
     */
    'global_rows_per_page' => 20,

    /*
     * 可选的语言，如果不为空，将会在页面顶部显示『选择语言』按钮
     *
     * @type array
     */
    'locales' => [],

    'custom_routes_file' => app_path('Http/routes/administrator.php'),
);
