# ■基本ディレクトリ
$BaseDir='http://www.upr-net.co.jp/cgi-bin/formmail';

# ■ロックディレクトリ
$LockDir='./lock';

# ■データディレクトリ
$DataDir='./data';

# ■画像ディレクトリ
$ImageDir='./image';

# ■sendmailのパス
$SendPass='/usr/sbin/sendmail';

# ■メインスクリプト名
$MainCgi='formmail.cgi';

# ■POST最大送信データサイズ(Bytes)
$MaxPostSize='50000';

# ■Proxy制限(ON=1/OFF=0)
$ProxyChkMode='0';

# ■特定ドメイン制限(ON=1/OFF=0)
$DomainChkMode='0';

# ■特定ドメイン制限解除(ON=1/OFF=0)
$VipDomainMode='0';

# ■時差修正(日本は+9)
$TimeZone=+9;

# ■ジャンプタイプ(0=Location/1=META)
$LocationType=1;

1;
