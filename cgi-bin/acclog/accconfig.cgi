#####################################################################
# 高機能アクセス解析CGI Standard版（設定ファイル）
# Ver 3.8.1
# Copyright(C) futomi 2001 - 2004
# http://www.futomi.com/
#####################################################################

#--------------------------------------------------------------------
#■イメージディレクトリのURL
#  最後に「/」を入れないでください。CGIファイルを専用のディレクトリ
#  （cgi-bin等）に設置しなければいけないプロバイダーの場合には、ディ
#  レクトリ「images」を設置した場所のURLを「http://」から記載してくだ
#  さい。
#--------------------------------------------------------------------
$IMAGE_URL = './images';


#--------------------------------------------------------------------
#■棒グラフの100%における長さの指定
#  単位はピクセルです。
#--------------------------------------------------------------------
$GRAPHMAXLENGTH = 300;


#--------------------------------------------------------------------
#■アクセス制限機能
#  「acc.cgi」にアクセスしたときに、パスワード認証をさせるかどうかを
#  定義します。パスワード認証をする場合には、「1」、しない場合には
#  「0」を指定して下さい。パスワード認証をする場合には、$PASSWORD に
#  パスワードを設定してください。
#--------------------------------------------------------------------
$AUTHFLAG = 1;

$PASSWORD = 'upr';


#--------------------------------------------------------------------
#■ランキング表示順位設定
#  各レポートの表示するランキング順位を設定してください。
#--------------------------------------------------------------------
$ROW = 20;


#--------------------------------------------------------------------
#■ログのローテーション設定
#  通常は、1 または 2 に設定にして下さい。「しない」にすると、CGIのレ
#  スポンスが非常に悪くなると同時に、プロバイダーでご契約の容量を圧迫
#  してしまいます。非常にアクセスが多いサイトの場合には、「日ごとにロ
#  ーテーション」を選択して下さい。
#    0:ローテーションしない
#    1:ログサイズでローテーション
#    2:日ごとにローテーション
#    3:月ごとにローテーション
#--------------------------------------------------------------------
$LOTATION = 3;


#--------------------------------------------------------------------
#■ログローテーションのログファイルサイズ
#  単位は バイト です。アクセスログが、指定のファイルサイズをこえた時
#  に、現在のログをローテーションします。上の「ログのローテーション指
#  定」で「1:ログサイズでローテーション」を選択した場合にのみ有効です。
#--------------------------------------------------------------------
$LOTATION_SIZE = 307200;


#--------------------------------------------------------------------
#■過去アクセスログの保存設定
#  アクセスログをローテーションする際に、古いログを削除するか、それと
#  も別名で保存するかを設定します。
# 「保存する」設定にした場合、古いログは「access_log.YYYYMMDD」と別名
#  保存されます。（YYYY:西暦, MM:月, DD:日)
#    0:削除する
#    1:保存する
#
#  【注意！】
#    「削除する」と設定すると、過去のログはすべて削除されてしまいます
#    のでご注意ください。
#--------------------------------------------------------------------
$LOTATION_SAVE = 1;


#--------------------------------------------------------------------
#■リンク元解析対象外URL設定
#  リンク元解析において、自サイトからリンクされたデータを除外します。
#  除外する場合には、自サイトのURLを設定してください。
#
#  例：
#    http://www.futomi.com と http://futomi.com を除外する場合
#    @MY_SITE_URLs = ('http://www.futomi.com', 'http://futomi.com');
#    と設定します。もし、設定しない場合には、
#    @MY_SITE_URLs = ();
#    としてください。
#--------------------------------------------------------------------
@MY_SITE_URLs = ('http://www.upr-net.co.jp','http://upr-net.co.jp');


#--------------------------------------------------------------------
#■解析対象から除外するホストの指定
#  ここで指定したホストからのアクセスは、ログに出力されません。
#  もし、ご自分がアクセスする際のホスト名がわかっている場合には、
#  ここに指定しておくと、解析対象から外すことができます。
#  IPアドレスでの指定、ホスト名での指定どちらでも可能です。
#  またホスト名で指定した場合、後方一致ですのでドメインごと対象外にす
#  ることも可能です。IPアドレスでの指定の場合には、逆に前方一致となり
#  ます。
#
#  例：
#  @REJECT_HOSTS = ('hoge.com', '10.1.1.');
#  この場合、ドメインhoge.comからのアクセスはすべて対象外となります。
#  またIPアドレスが 10.1.1.* からのアクセスもすべて対象外となります。
#  何も指定しない場合には、
#  @REJECT_HOSTS = ();
#  としてください。
#--------------------------------------------------------------------
@REJECT_HOSTS = ();


#--------------------------------------------------------------------
#■サイトトップURLとHTMLファイルのマッピング
#  アクセスページのタイトルは、多くのサーバにおいて自動的に取得できま
#  すが、URLに「~（チルダ）」が含まれている場合や、一部のサーバ環境で
#  は自動的に取得できません。その場合には、ここにURLとCGIからのパスと
#  のマッピングを定義して下さい。CGIからの相対パス、サーバルートから
#  の絶対パスどちらでも結構です。
#  ここでマッピングをマニュアル設定する場合には、
#  $URL2PATH_FLAG = 1;
#  としてから、%URL2PATH にマッピングを定義して下さい。
#
#  例：
#   サイトのトップURL : http://www.hoge.com/~foo/
#   acc.cgiからの相対パス : ../
#   の場合、
#
#   $URL2PATH_FLAG = 1;
#   %URL2PATH = ('http://www.hoge.com/~foo/' => '../');
#
#   とします。もしサーバルートからの絶対パスが分かっていれば、
#
#   $URL2PATH_FLAG = 1;
#   %URL2PATH = ('http://www.hoge.com/~foo/' => '/home/foo/');
#
#   のように設定します。/home/ の部分は、サーバによって異なりますので、
#   サービス事業者にお問い合わせください。
#
#  注意：
#   必ず、URLとパスの最後には、「/（スラッシュ）」を入れて下さい。
#--------------------------------------------------------------------
$URL2PATH_FLAG = 0;

%URL2PATH = ('http://www.hoge.com/~foo/' => '/home/foo/');


#--------------------------------------------------------------------
#■解析レポート選択
#  デフォルトでは、すべてのレポートを解析し表示します。しかし、ログ
#  サイズが大きくなると、解析しきれずに途中で処理がとまってしまいます。
#  その場合、普段見ることがない解析レポートを減らし、解析処理を軽く
#  できます。
#  解析しないレポートの部分を「0」にして下さい。
#  解析するレポートは「1」にして下さい。
#--------------------------------------------------------------------

$ANA_REMOTETLD = 1;		#国別ドメイン名レポート
$ANA_REMOTEDOMAIN = 1;		#アクセス元ドメイン名レポート
$ANA_REMOTEHOST = 1;		#アクセス元ホスト名レポート
$ANA_HTTPLANG = 0;		#ブラウザー表示可能言語レポート
$ANA_BROWSER = 1;		#ブラウザーレポート
$ANA_PLATFORM = 1;		#プラットフォーム レポート
$ANA_REQUESTMONTHLY = 1;	#月別アクセス数レポート
$ANA_REQUESTDAILY = 1;		#日別アクセス数レポート(※1）
$ANA_REQUESTHOURLY = 1;		#時間別アクセス数レポート
$ANA_REQUESTWEEKLY = 1;		#曜日別アクセス数レポート
$ANA_REQUESTFILE = 1;		#リクエストレポート
$ANA_REFERERSITE = 1;		#リンク元サイトレポート
$ANA_REFERERURL = 1;		#リンク元URLレポート
$ANA_KEYWORD = 1;		#検索エンジンの検索キーワード レポート
$ANA_RESOLUTION = 1;		#クライアント画面解像度レポート
$ANA_COLORDEPTH = 0;		#クライアント画面色深度 レポート
$ANA_VIDEOMEMORY = 0;		#クライアントビデオメモリーサイズ レポート

#【※1】
#  日別アクセス数レポートは、アクセス解析結果画面の解析モード指定を
#  "月指定"とした場合にのみ、表示されます。"全指定", "日指定"のモード
#  では表示されません。


#####################################################################
#これ以降の設定は、通常変更する必要はありません。もしうまく動作しない
#場合に見直してください。
#####################################################################

#--------------------------------------------------------------------
#■アクセス解析用のイメージファイル
#  このCGIからの相対パスで記述してください。
#--------------------------------------------------------------------
$LOGO = './acclogo.gif';


#--------------------------------------------------------------------
#■アクセス解析用のイメージファイル（J-PHONE専用）
#  このCGIからの相対パスで記述してください。
#--------------------------------------------------------------------
$JLOGO = './acclogo.png';


#--------------------------------------------------------------------
#■アクセスログ
#  このCGIからの相対パスで記述してください。
#--------------------------------------------------------------------
$LOG = './logs/access_log';


#--------------------------------------------------------------------
#■時差の調整
#  海外のサーバを利用されている場合、解析結果の時間が日本時間とはずれ
#  ます。日本時間に調整するために、その時差を設定します。単位は、時間
#  （hour）です。
#   国内のサーバを利用の場合には、「0」のままにして下さい。
#   例：9時間進める場合には、$TIMEDIFF = 9;
#       9時間遅らす場合には、$TIMEDIFF = -9;
#--------------------------------------------------------------------
$TIMEDIFF = 0;


#--------------------------------------------------------------------
#■ディレクトリインデックスファイル名の指定
#  URIにファイル名要素が含まれておらず、ディレクトリに対してのアクセ
#  スであった場合に、代わりに表示さえるファイルの名前を指定します。
#  たとえば、URLが http://www.futomi.com/test/ の場合に、表示される
#  HTMLが、「index.html」である場合には、
#    @DIRECTORYINDEX = ('index.html');
#  と指定します。ほとんどの場合、index.htmlとindex.htmがサーバ側で指定
#  されていますので、
#    @DIRECTORYINDEX = ('index.html', 'index.htm');
#  としてください。
#--------------------------------------------------------------------
@DIRECTORYINDEX = ('index.html', 'index.htm');


#--------------------------------------------------------------------
#■このCGIのURLマニュアル設定
#  「acc.cgi」は、自分のURLを自動認識しますが、一部のサーバ環境におい
#  ては正しく認識しない場合があります。その場合には、マニュアルで、
#  「acc.cgi」のURLを設定して下さい。
#  自動認識で正しく動作する場合には、
#  MANUAL_THIS_URL = '';
#  として下さい。
#  指定する場合には、http:// から正しく設定して下さい。
#  例： $MANUAL_CGIURL = 'http://www.hoge.com/cgi-bin/acc.cgi';
#--------------------------------------------------------------------
$MANUAL_CGIURL = '';


#--------------------------------------------------------------------
#これ以降、絶対に削除しないで下さい。
#--------------------------------------------------------------------
return 1;

