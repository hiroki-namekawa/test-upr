<?php
/**
 *  Esform_Controller.php
 *
 *  @author     {$author}
 *  @package    Esform
 *  @version    $Id: app.controller.php 470 2007-07-08 17:48:26Z ichii386 $
 */

/** アプリケーションベースディレクトリ */
define('BASE', dirname(dirname(__FILE__)));

/** include_pathの設定(アプリケーションディレクトリを追加) */
$cnf = 'app/data/config.cgi';
$app = BASE . "/app";
$lib = BASE . "/lib";
$tmp = BASE . '/tmp';
ini_set('include_path', implode(PATH_SEPARATOR, array($app, $lib, ini_get('include_path'))));
if (!is_writable($tmp)) {
	print 'tmpディレクトリに書き込み権限がありません。';
	exit;
}
GlobalSettings::setup();

/** アプリケーションライブラリのインクルード */
require_once 'Ethna/Ethna.php';
require_once 'Esform_Error.php';
require_once 'Esform_ActionClass.php';
require_once 'Esform_ActionForm.php';
require_once 'Esform_ViewClass.php';

// Xserverなどで基底クラスがundefinedになる対策
require_once 'action/Project.php';

/**
 *  Esformアプリケーションのコントローラ定義
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Esform
 */
class Esform_Controller extends Ethna_Controller
{
    /**#@+
     *  @access private
     */

    /**
     *  @var    string  アプリケーションID
     */
    var $appid = 'ESFORM';

    /**
     *  @var    array   forward定義
     */
    var $forward = array(
        /*
         *  TODO: ここにforward先を記述してください
         *
         *  記述例：
         *
         *  'index'         => array(
         *      'view_name' => 'Esform_View_Index',
         *  ),
         */
		'login' => array(
			'class_name'   => 'Esform_View_Login',
			'forward_path' => 'login.tpl',
		)
    );

    /**
     *  @var    array   action定義
     */
    var $action = array(
        /*
         *  TODO: ここにaction定義を記述してください
         *
         *  記述例：
         *
         *  'index'     => array(),
         */
		'login' => array(
			'class_name' => 'Esform_Action_Login',
		)
	);
    /**
     *  @var    array   soap action定義
     */
    var $soap_action = array(
        /*
         *  TODO: ここにSOAPアプリケーション用のaction定義を
         *  記述してください
         *  記述例：
         *
         *  'sample'            => array(),
         */
    );

    /**
     *  @var    array       アプリケーションディレクトリ
     */
    var $directory = array(
        'action'        => 'app/action',
        'action_cli'    => 'app/action_cli',
        'action_xmlrpc' => 'app/action_xmlrpc',
        'app'           => 'app',
        'plugin'        => 'app/plugin',
        'bin'           => 'bin',
        'etc'           => 'etc',
        'filter'        => 'app/filter',
        'locale'        => 'locale',
        'log'           => 'log',
        'plugins'       => array('app/plugin/Smarty'),
        'template'      => 'template',
        'template_c'    => 'tmp',
        'tmp'           => 'tmp',
        'view'          => 'app/view',
        'www'           => 'www',
    );

    /**
     *  @var    array       DBアクセス定義
     */
    var $db = array(
        ''              => DB_TYPE_RW,
    );

    /**
     *  @var    array       拡張子設定
     */
    var $ext = array(
        'php'           => 'php',
        'tpl'           => 'tpl',
    );

    /**
     *  @var    array   クラス定義
     */
    var $class = array(
        /*
         *  TODO: 設定クラス、ログクラス、SQLクラスをオーバーライド
         *  した場合は下記のクラス名を忘れずに変更してください
         */
        'class'         => 'Ethna_ClassFactory',
        'backend'       => 'Ethna_Backend',
        'config'        => 'Ethna_Config',
        'db'            => 'Ethna_DB_PEAR',
        'error'         => 'Ethna_ActionError',
        'form'          => 'Esform_ActionForm',
        'i18n'          => 'Ethna_I18N',
        'logger'        => 'Ethna_Logger',
        'plugin'        => 'Ethna_Plugin',
        'session'       => 'Ethna_Session',
        'sql'           => 'Ethna_AppSQL',
        'view'          => 'Esform_ViewClass',
        'renderer'      => 'Ethna_Renderer_Smarty',
        'url_handler'   => 'Esform_UrlHandler',
    );

    /**
     *  @var    array       検索対象となるプラグインのアプリケーションIDのリスト
     */
    var $plugin_search_appids = array(
        /*
         *  プラグイン検索時に検索対象となるアプリケーションIDのリストを記述します。
         *
         *  記述例：
         *  Common_Plugin_Foo_Bar のような命名のプラグインがアプリケーションの
         *  プラグインディレクトリに存在する場合、以下のように指定すると
         *  Common_Plugin_Foo_Bar, Esform_Plugin_Foo_Bar, Ethna_Plugin_Foo_Bar
         *  の順にプラグインが検索されます。 
         *
         *  'Common', 'Esform', 'Ethna',
         */
        'Esform', 'Ethna',
    );

    /**
     *  @var    array       フィルタ設定
     */
    var $filter = array(
        /*
         *  TODO: フィルタを利用する場合はここにそのプラグイン名を
         *  記述してください
         *  (クラス名を指定するとfilterディレクトリからフィルタクラス
         *  を読み込みます)
         *
         *  記述例：
         *
         *  'ExecutionTime',
         */
    );

    /**
     *  @var    array   smarty modifier定義
     */
    var $smarty_modifier_plugin = array(
        /*
         *  TODO: ここにユーザ定義のsmarty modifier一覧を記述してください
         *
         *  記述例：
         *
         *  'smarty_modifier_foo_bar',
         */
    );

    /**
     *  @var    array   smarty function定義
     */
    var $smarty_function_plugin = array(
        /*
         *  TODO: ここにユーザ定義のsmarty function一覧を記述してください
         *
         *  記述例：
         *
         *  'smarty_function_foo_bar',
         */
    );

    /**
     *  @var    array   smarty block定義
     */
    var $smarty_block_plugin = array(
        /*
         *  TODO: ここにユーザ定義のsmarty block一覧を記述してください
         *
         *  記述例：
         *
         *  'smarty_block_foo_bar',
         */
    );

    /**
     *  @var    array   smarty prefilter定義
     */
    var $smarty_prefilter_plugin = array(
        /*
         *  TODO: ここにユーザ定義のsmarty prefilter一覧を記述してください
         *
         *  記述例：
         *
         *  'smarty_prefilter_foo_bar',
         */
    );

    /**
     *  @var    array   smarty postfilter定義
     */
    var $smarty_postfilter_plugin = array(
        /*
         *  TODO: ここにユーザ定義のsmarty postfilter一覧を記述してください
         *
         *  記述例：
         *
         *  'smarty_postfilter_foo_bar',
         */
    );

    /**
     *  @var    array   smarty outputfilter定義
     */
    var $smarty_outputfilter_plugin = array(
        /*
         *  TODO: ここにユーザ定義のsmarty outputfilter一覧を記述してください
         *
         *  記述例：
         *
         *  'smarty_outputfilter_foo_bar',
         */
    );

    /**#@-*/

	function _getActionName_Form()
	{
		if (isset($_REQUEST['mode']) && is_string($_REQUEST['mode'])) {
			return $_REQUEST['mode'];
		}
	}
}
class GlobalSettings
{
	static function setup()
	{
		self::phpini();
		self::validate();
		self::server();
	}
	private static function phpini()
	{
		if (strcasecmp(mb_internal_encoding(), 'UTF-8') == 0) return false;

		ini_set('magic_quotes_gpc', 'Off');
		ini_set('display_startup_errors', 'Off');
		ini_set('display_errors', 'Off');
		ini_set('error_reporting', 0);
		ini_set('log_errors', 'On');
		ini_set('error_log', 'error.cgi');

		ini_set('date.timezone', 'Asia/Tokyo');
		ini_set('default_charset', 'UTF-8');
		ini_set('mbstring.http_input', 'pass');
		ini_set('mbstring.http_output', 'pass');
		ini_set('mbstring.internal_encoding', 'UTF-8');
		ini_set('mbstring.encoding_translation', 'Off');
		ini_set('mbstring.substitute_character', 'none');
		ini_set('mbstring.detect_order', 'UTF-8,SJIS,JIS,EUC-JP,ASCII');

		ini_set('session.auto_start', 'Off');
		ini_set('session.use_trans_sid', 'Off');
		ini_set('session.use_only_cookies', 'On');
		return true;
	}
	private static function validate()
	{
		$vars = array($_GET, $_POST, $_COOKIE, $_SERVER);
		array_walk_recursive($vars, array('self', '_validate'));
	}
	private static function _validate($val, $key)
	{
		if (strpos($val, "\x00") !== false || mb_check_encoding($val) === false) {
			exit('Invalid charactor encoding detected.');
		}
	}
	private static function server()
	{
		$host = getEnv('HTTP_HOST');
		$port = getEnv('SERVER_PORT');
		$ssl = getEnv('HTTPS');
		$ssl = strToLower($ssl);
		$is_ssl = $ssl == 'on';
		$scheme = $is_ssl ? 'https://' : 'http://';
		if ($port != null) {
			if ((!$is_ssl && $port !== '80') || ($is_ssl && $port !== '443')) {
				$port = ':' . $port;
			} else {
				$port = '';
			}
		}

		$path = $_SERVER['PHP_SELF'];
		$path = htmlSpecialChars($path, ENT_QUOTES);
		$dir = rtrim(dirname($path), '/\\');
		$url = $scheme . $host . $port;
		$path = $_SERVER['SCRIPT_FILENAME'];
		$file = basename($path);

		$_SERVER['HTTPS'] = $ssl;
		$_SERVER['HOME_URL'] = $url . '/';
		$_SERVER['BASE_URL'] = $url = $url . $dir . '/';
		$_SERVER['SCRIPT_URL'] = $url . $file;
		$_SERVER['SCRIPT'] = $file;
		$_SERVER['REMOTE_HOST'] = getHostByAddr($_SERVER['REMOTE_ADDR']);
		$_SERVER['REQUEST_TIME'] = time();
	}
}

?>
