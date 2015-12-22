# ■管理者メールアドレス
$AdminMail = 'uprweb1@upr-net.co.jp';

# ■CCメールアドレス
#$CcMail = 'xxxtetsuo.yoshizawa@upr-net.co.jpxxx';

# ■設置サイトの最短URL
$MyUrl = '';

# ■method形式チェック(ON=1/OFF=0)
$MethodChkMode = '1';

# ■未入力データ送信(ON=1/OFF=0)
$NullMode = '0';

# ■確認画面の自動リンク(ON=1/OFF=0)
$AutoLinkMode = '0';

# ■自動リンクのターゲット
$AutoTarget = '_blank';

# ■送信後にジャンプするURL
$AfterUrl = 'http://www.upr-net.co.jp/english/contact/ThankYou.htm';

# ■アクセスログ記録(ON=1/OFF=0)
$AccessLogMode = '1';

# ■アクセスログ最大件数(1ファイル)
$MaxAccessLog = '100';

# ■最大アクセスログファイル数
$MaxAccessLogFile = '5';

# ■入力が同一である必要がある項目
@SameItem = (
['E-mail Address','Confirmation'],
);

# ■フォームの項目
# [必須,改行,文字数,プレビュー,送信,有効書式,無効書式]
@FormItem = (
{ 'Postal Code' => [1,0,0,1,3,'',''], },
{ 'Prefecture' => [1,0,0,1,3,'',''], },
{ 'City and Address' => [1,0,0,1,3,'',''], },
{ 'Name of Building' => [0,0,0,1,3,'',''], },
{ 'Company Name' => [0,0,0,1,3,'',''], },
{ 'Field of Business' => [0,0,0,1,3,'',''], },
{ 'Department' => [0,0,0,1,3,'',''], },
{ 'Your Name' => [1,0,0,1,3,'',''], },
{ 'Phone Number' => [0,0,0,1,3,'',''], },
{ 'Fax Number' => [0,0,0,1,3,'',''], },
{ 'E-mail Address' => [0,0,0,1,3,'',''], },
{ 'Confirmation' => [0,0,0,0,0,'',''], },
{ 'contact' => [1,0,0,1,3,'',''], },
{ 'Your Inquiry' => [1,1,0,1,3,'',''], },
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
$MailItemName = 'E-mail Address';

# ■サブジェクトとして認識させる項目名
$SubjectItemName = 'subject';

# ■送信者へのメール送信の有無として認識させる項目名
$UserMailItemName = 'E-mail Address';

# ■管理者へのメール上部
$MailAdminAbove = <<'TEXT';

TEXT

# ■管理者へのメール下部
$MailAdminBelow = <<'TEXT';

TEXT

# ■送信者へのメール上部
$MailUserAbove = <<'TEXT';
Thank you for your interest in UPR.
Your feedback and comments are important to us.

TEXT

# ■送信者へのメール下部
$MailUserBelow = <<'TEXT';


UPR Co., Ltd
http://www.upr-net.co.jp/

TEXT

1;
