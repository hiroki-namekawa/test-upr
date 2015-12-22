package main;

##======================================================##
##  AmigoFormMail 用処理ライブラリ                      ##
##  Copyright(C)2000 cgi-amigo.com All Rights Reserved  ##
##  http://www.cgi-amigo.com/                           ##
##  mail:webmaster@cgi-amigo.com                        ##
##======================================================##

# このライブラリは無料でご利用頂けますが著作権は放棄していません。
# 同梱の利用規定ファイルの利用規定を厳守の上ご利用下さい。
# ファイルを紛失した場合はhttp://www.cgi-amigo.com/kitei.htmlよりご確認下さい。
# 最新バージョンもhttp://www.cgi-amigo.com/よりご確認頂けます。

###############################################################################

srand(time()^($$+($$<<15)));
$PID=$$ ? $$ : int(rand(10000)+1);
$CopyRight=qq(<CENTER><TABLE height="10"><TBODY><TR><TD></TD></TR></TBODY></TABLE><TABLE border="1" bgcolor="#ffffff"><TBODY><TR><TD align=middle><FONT style="FONT-SIZE: 10pt" face=verdana,arial,serif,tahoma>&nbsp;─ <A href="http://www.cgi-amigo.com/">$Ver</A> ─&nbsp;</FONT></TD></TR></TBODY></TABLE></CENTER>);
$SIG{INT}=$SIG{HUP}=$SIG{QUIT}=$SIG{TERM}=$SIG{__DIE__}=\&SIGExit;
$NowTime=time;
$DomainName=!$ENV{REMOTE_HOST}||$ENV{REMOTE_HOST}eq$ENV{REMOTE_ADDR}?gethostbyaddr(pack('C4',split(/\./,$ENV{REMOTE_ADDR})),2)||$ENV{REMOTE_ADDR}:$ENV{REMOTE_HOST};

###############
#   SIGExit   #
###############
sub SIGExit { Unlock('ALL'); exit 1; }

###################
#   GetFormData   #
###################
sub GetFormData {
my($divided,$buffer,$key,$val,@pairs) = @_;
if($ENV{REQUEST_METHOD} eq "POST"){
    exit if($ENV{CONTENT_LENGTH} > $MaxPostSize);
    read(STDIN,$buffer,$ENV{CONTENT_LENGTH});
}
else{ $buffer = $ENV{QUERY_STRING} }
@pairs = split(/&/,$buffer);
foreach(@pairs){ ($key,$val) = split(/=/);
    $key =~ tr/+/ /; $val =~ tr/+/ /;
    $key =~ s/%([A-Fa-f0-9]{2})/pack("C",hex($1))/eg;
    $val =~ s/%([A-Fa-f0-9]{2})/pack("C", hex($1))/eg;
    $val =~ s/(?:\r\n|\r)/\n/g;
    jcode::convert(*val,'sjis');
    if(defined $FORM{$key}){ if(defined $val){ $FORM{$key} .= $divided } }
    else{ push(@Keys,$key) }
    $FORM{$key} .= $val;
} 1;
}

#####################
#   SecurityCheck   #
#####################
sub SecurityCheck {
my($ref,$method,$admin,$sid,$proxy,$domain,$vip) = @_;
RefererCheck() if($ref);
MethodCheck() if($method);
AdminCheck() if($admin);
SIDCheck() if($sid);
ProxyCheck($proxy,$domain,$vip); 1;
}

####################
#   RefererCheck   #
####################
sub RefererCheck {
$ENV{HTTP_USER_AGENT}=~/^DoCoMo/ and return(1);
my($refurl)=$ENV{HTTP_REFERER};
$refurl =~ s/%([A-Fa-f0-9]{2})/pack("C",hex($1))/eg;
Error(100) if($refurl !~ /^$MyUrl/); 1;
}

###################
#   MethodCheck   #
###################
sub MethodCheck { Error(101) if($ENV{REQUEST_METHOD} !~ /POST/i); 1; }

##################
#   AdminCheck   #
##################
sub AdminCheck { Error(102) if($FORM{AdminPass} ne $AdminPass); 1; }

################
#   SIDCheck   #
################
sub SIDCheck {
local(*id);
FileRead("$SidDir/submit.sid",*id,1);
Error(103) if($id eq $FORM{SID}); 1;
}

##################
#   ProxyCheck   #
##################
sub ProxyCheck {
my($proxy,$domain,$vip,$error,$perror) = @_;
if($proxy){
    if($DomainName =~ /squid|proxy|cache|delegate|keeper|^firewall|^dns|^mail|^www|^ns\d{0,2}\.|us$|uk$|au$|fi$|ca$|de$|kr$|tw$|it$|edu$|com$|org$|net$/i || 
    $ENV{HTTP_USER_AGENT} =~ /squid|via|delegate|httpd|proxy|cache|Turing|ANONYM/i || !$ENV{REMOTE_ADDR} ||
    defined $ENV{HTTP_X_FORWARDED_FOR} || defined $ENV{HTTP_FORWARDED} || defined $ENV{HTTP_PROXY_CONNECTION} || defined $ENV{HTTP_XROXY_CONNECTION} || defined $ENV{HTTP_XONNECTION} || 
    defined $ENV{HTTP_VIA} || defined $ENV{HTTP_CLIENT_IP} || defined $ENV{HTTP_X_LOCKING} || defined $ENV{HTTP_SP_HOST} || defined $ENV{HTTP_CACHE_INFO} || defined $ENV{HTTP_CACHE_CONTROL}
    ){ $error = 1; $perror = 1; }
}
if(!$error && $domain){ unless(DomainCheck('out')){ $error = 1 } }
if($error  && $vip){ unless(DomainCheck('vip')){ $error = 0 } }
if($error){ if($perror){ Error(104) } Error(105) } 1;
}

###################
#   DomainCheck   #
###################
sub DomainCheck {
my($type,@DomainList) = @_;
require'domain.pl';
if($type eq 'out'){ @DomainList = @OutDomain }
else{ @DomainList = @VipDomain }
foreach(@DomainList){
    if(/(\d\.)/){ if($ENV{REMOTE_ADDR} =~ /^$_/){ return 0 } }
    else{ if(index($DomainName,$_) >= 0){ return 0 } }
} 1;
}

#############
#   Error   #
#############
sub Error {
my($code) = @_;
Unlock('ALL');
require'msg.pl';
if(exists $MSG{$code}){ $msg = $MSG{$code} }
else{ $msg = '原因不明 (コードが存在しません)' }
OutputHtml('error.html');
}

##################
#   OutputHtml   #
##################
sub OutputHtml {
my($file) = @_; local(*HtmlLines);
FileRead("$OutputDir/$file",*HtmlLines);
print"Content-type: text/html\n\n";
foreach(@HtmlLines){ ExpandVariable(*_); print }
print $CopyRight; exit;
}

######################
#   ExpandVariable   #
######################
sub ExpandVariable {
local(*_) = @_;
s/\$\{(.+?)\}/${ "${main}::$1" }/eg;
}

###################
#   SpaceEncode   #
###################
sub SpaceEncode {
my($buff) = @_;
$buff =~ s/^(?:\s|　)+//;
$buff =~ s/(?:\s|　)+$//;
$buff =~ s/\n{5,}/\n\n\n\n/g;
$buff;
}

#################
#   TagEncode   #
#################
sub TagEncode {
my($buff) = @_;
$buff =~ s/</&lt;/g;
$buff =~ s/>/&gt;/g;
$buff;
}


#################
#   TagDecode   #
#################
sub TagDecode {
my($buff) = @_;
$buff =~ s/&lt;/</g;
$buff =~ s/&gt;/>/g;
$buff;
}

################
#   AutoLink   #
################
sub AutoLink {
my($buff,$url,$mail) = @_;
$url = '[\w\.\~\-\_\/\?\=\&\+\:\@\%\;\#\%]+';
$mail = '[\w\'-\*\,-\.\_]+';
$buff =~ s/((?:s?https?|ftp):\/\/$url\.$url)/<A href=\"$1\" target=\"$AutoTarget\">$1<\/A>/gio;
$buff =~ s/($mail\@$mail\.$mail)/<A href="mailto:$1">$1<\/A>/gio;
$buff;
}

###############
#   GetTime   #
###############
sub GetTime {
my($time,$type) = @_;
($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = gmtime($time + $TimeZone * 3600);
if($type eq 'jp'){ @week = ('日','月','火','水','木','金','土') }
else { @week = ('Sun','Mon','Tue','Wed','Thu','Fri','Sat') } 1;
}

################
#   MailHead   #
################
sub MailHead {
my($replay,$to,$cc,$from,$subject) = @_;
$msg  = "X-Mailer: $Ver\n";
$msg .= "MIME-Version: 1.0\n";
$msg .= "Replay-To: $replay\n" if($replay);
$msg .= "To: $to\n";
$msg .= "CC: $cc\n" if($cc);
if($from){ $msg .= "From: $from\n" }
else{ $msg .= "From: $Ver\n" }
$msg .= "Subject: $subject\n";
$msg .= "X-User-Agent: $ENV{HTTP_USER_AGENT}\n";
$msg .= "X-Host: $ENV{REMOTE_ADDR}\n";
$msg .= "Content-Transfer-Encoding: 7bit\n";
$msg .= "Content-type: text/plain; charset=ISO-2022-JP\n\n";
$msg;
}

#################
#   MailWrite   #
#################
sub MailWrite {
local(*msg,$type) = @_;
open(MAIL,"| $SendPass -t") || return 0;
if($type){ print MAIL @msg }
else{ print MAIL $msg }
close(MAIL); 1;
}

############
#   Lock   #
############
sub Lock {
my($file) = @_;
foreach(0..10){
    last unless(-e "$LockDir/$file");
    if($_ % 5 == 0){ if(-M "$LockDir/$file" > .0070){ if(unlink("$LockDir/$file")){ last } } }
    Error(106) if($_ == 10); sleep(1);
}
FileWrite("$LockDir/$file",*PID,1);
LockCheck($file);
$LockFile{$file} = 1; 1;
}

#################
#   LockCheck   #
#################
sub LockCheck {
my($file) = @_; local(*lockpid);
if($file eq 'ALL'){
    foreach(keys %LockFile){
        FileRead("$LockDir/$_",*lockpid,1);
        LockError() if($lockpid ne $PID);
    }
}
else{
    FileRead("$LockDir/$file",*lockpid,1);
    LockError() if($lockpid ne $PID);
} 1;
}

##############
#   Unlock   #
##############
sub Unlock {
my($file) = @_;
if($file eq 'ALL'){
    LockCheck('ALL');
    foreach(keys %LockFile){ if(-e "$LockDir/$_"){ if(unlink("$LockDir/$_")){ delete($LockFile{$_}) } } }
}
else{
    LockCheck($file);
    if(-e "$LockDir/$file"){ if(unlink("$LockDir/$file")){ delete($LockFile{$file}) } }
} 1;
}

#################
#   LockError   #
#################
sub LockError {
foreach(keys %LockFile){
    FileRead("$LockDir/$_",*lockpid,1);
    if($lockpid eq $PID){ if(-e "$LockDir/$_"){ unlink"$LockDir/$_" } }
}
require'msg.pl';
if(exists $MSG{107}){ $msg = $MSG{107} }
else{ $msg = '原因不明 (コードが存在しません)' }
OutputHtml('error.html');
}

################
#   FileRead   #
################
sub FileRead {
local($file,*line,$type) = @_;
unless(open(FILE,$file)){ return 0 }
if($type){ $line = <FILE> }
else{ @line = <FILE> }
close(FILE); 1;
}


#################
#   FileWrite   #
#################
sub FileWrite {
local($file,*line,$type,$open) = @_;
if($open){ unless(open(FILE,">>$file")){ return 0 } }
else{ open(FILE,">$file") }
if($type){ print FILE $line }
else{ print FILE @line }
close(FILE); 1;
}

#################
#   AccessLog   #
#################
sub AccessLog {
my($dir,$data) = @_;
local(*AccessLogLines);
FileRead("$dir/access.log",*AccessLogLines);
if(@AccessLogLines >= $MaxAccessLog){
    if($MaxAccessLogFile){ Backup(*AccessLogLines,$MaxAccessLogFile,$dir,'dat') }
    @AccessLogLines = ();
}
unshift(@AccessLogLines,$data);
FileWrite("$dir/access.log",*AccessLogLines); 1;
}

##############
#   Backup   #
##############
sub Backup {
local(*line,$max,$dir,$type) = @_;
my(@Files,$FileSu,$DeleteSu,$NewName);
@Files = glob("$dir\/*.$type");
$FileSu = @Files + 1;
if(@Files >= $max){
    $DeleteSu = $FileSu - $max;
    foreach(1..$DeleteSu){ unlink "$dir\/$_\.$type" }
    $NewName = 0;
    foreach($DeleteSu+1..@Files){ $NewName++; rename("$dir\/$_\.$type","$dir\/$NewName\.$type") }
    $FileSu = $NewName + 1;
}
FileWrite("$dir/$FileSu.$type",*line); 1;
}

1;
################################################################################
