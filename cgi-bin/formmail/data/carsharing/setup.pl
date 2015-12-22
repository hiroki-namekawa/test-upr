# ■管理者メールアドレス
$AdminMail = 'uprweb1@upr-net.co.jp';

# ■CCメールアドレス
$CcMail = 'naoshi.kimura@upr-net.co.jp,yoshio.akasaka@upr-net.co.jp,yoshihiro.iwamiya@upr-net.co.jp,keiko.yamazoe@upr-net.co.jp';

# ■設置サイトの最短URL
$MyUrl = 'http://www.upr-net.co.jp';

# ■method形式チェック(ON=1/OFF=0)
$MethodChkMode = '1';

# ■未入力データ送信(ON=1/OFF=0)
$NullMode = '0';

# ■確認画面の自動リンク(ON=1/OFF=0)
$AutoLinkMode = '0';

# ■自動リンクのターゲット
$AutoTarget = '_blank';

# ■送信後にジャンプするURL
$AfterUrl = 'http://www.upr-net.co.jp/carsharing/contact/ThankYou.html';

# ■アクセスログ記録(ON=1/OFF=0)
$AccessLogMode = '1';

# ■アクセスログ最大件数(1ファイル)
$MaxAccessLog = '100';

# ■最大アクセスログファイル数
$MaxAccessLogFile = '5';

# ■入力が同一である必要がある項目
@SameItem = (
['E-Mail','再入力'],
);

# ■フォームの項目
# [必須,改行,文字数,プレビュー,送信,有効書式,無効書式]
@FormItem = (
{ '郵便番号' => [1,0,0,1,3,'',''], },
{ '都道府県' => [1,0,0,1,3,'','\s'], },
{ '市町村以下' => [1,0,0,1,3,'',''], },
{ 'ビル・マンション名' => [0,0,0,1,3,'',''], },
{ '会社名' => [0,0,0,1,3,'',''], },
{ '業種' => [0,0,0,1,3,'',''], },
{ '部署名' => [0,0,0,1,3,'',''], },
{ 'ご担当者名' => [1,0,0,1,3,'',''], },
{ 'Tel' => [1,0,0,1,3,'',''], },
{ 'Fax' => [0,0,0,1,3,'',''], },
{ 'E-Mail' => [0,0,0,1,3,'',''], },
{ '再入力' => [0,0,0,0,0,'',''], },
{ 'お問い合わせ内容' => [1,1,0,1,3,'',''], },
{ 'subject' => [0,0,0,0,0,'',''], },
);

# ■確認画面1項目分のHTML
sub PreviewItem{
my($item,$data) = @_;
print <<TEXT;
<TR><TD bgcolor="#ffffff" style="font-size : 9pt;">$item</TD>
<TD bgcolor="#ffffff" style="font-size : 9pt;">$data</TD></TR>
TEXT
}

# ■メールアドレスとして認識させる項目名
$MailItemName = 'E-Mail';

# ■サブジェクトとして認識させる項目名
$SubjectItemName = 'subject';

# ■送信者へのメール送信の有無として認識させる項目名
$UserMailItemName = 'E-Mail';

# ■管理者へのメール上部
$MailAdminAbove = <<'TEXT';

TEXT

# ■管理者へのメール下部
$MailAdminBelow = <<'TEXT';

TEXT

# ■送信者へのメール上部
$MailUserAbove = <<'TEXT';
お問い合わせありがとうございます。
下記の内容で承りました。

TEXT

# ■送信者へのメール下部
$MailUserBelow = <<'TEXT';


uprカーシェアリングシステム
TEL:(03)5405-7455

TEXT

1;
