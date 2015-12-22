#!/usr/local/bin/perl

##======================================================##
##  AmigoFormMail [フォームメール]                      ##
##  Copyright(C)2000 cgi-amigo.com All Rights Reserved  ##
##  http://www.cgi-amigo.com/                           ##
##  mail:webmaster@cgi-amigo.com                        ##
##======================================================##

# このスクリプトは無料でご利用頂けますが著作権は放棄していません。
# 同梱の利用規定ファイルの利用規定を厳守の上ご利用下さい。
# ファイルを紛失した場合はhttp://www.cgi-amigo.com/kitei.htmlよりご確認下さい。
# 最新バージョンもhttp://www.cgi-amigo.com/よりご確認頂けます。

###############################################################################

# ■ライブラリディレクトリ
use lib './pl';

# ■コンフィグディレクトリ
use lib './config';

###############################################################################

$Ver='AmigoFormMail Ver5.20';
require'config.pl';
require'jcode.pl';
require'common.pl';
GetFormData(',');
$OutputDir=$SidDir="$DataDir/$FORM{FormName}";
require"$DataDir/$FORM{FormName}/setup.pl";
%WORK = (Preview=>1,SendMail=>1);
$Work = $FORM{Work};
$Work = 'Preview' unless(defined $Work);
exit unless(exists $WORK{$Work}); &$Work;

###############################################################################

################
#   Location   #
################
sub Location{ my$url=shift;
if(!$LocationType){ print"Location: $url\n\n" }
else{ print"Content-type: text/html\n\n";
    print qq(<HTML><HEAD><META HTTP-EQUIV="REFRESH" CONTENT="0;URL=$url"></HEAD></HTML>);
}exit;}

###############################################################################

###############
#   Preview   #
###############
sub Preview {
SecurityCheck($MyUrl,$MethodChkMode,0,0,$ProxyChkMode,$DomainChkMode,$VipDomainMode);
DataCheck();
foreach(0..$#FormItem){
    foreach$item(keys%{$FormItem[$_]}){
        DataCheck2();
        push(@PreviewItemNums,$_) if($FormItem[$_]{$item}[3]);
    }
}
FileRead("$DataDir/$FORM{FormName}/check.html",*HtmlLines);
($FormName)=($FORM{FormName});
print"Content-type: text/html\n\n";
foreach(@HtmlLines){
    if(/^<!--- {ITEM_HIDDEN} --->/){
        foreach(0..$#FormItem){
            foreach$item(keys%{$FormItem[$_]}){
                $FORM{$item} =~ s/\"/&quot;/g;
                print qq(<INPUT type="hidden" name="$item" value="$FORM{$item}">\n);
            }
        }
    }
    elsif(/^<!--- {ITEM} --->/){
        foreach(@PreviewItemNums){
            foreach$item(keys%{$FormItem[$_]}){
                $FORM{$item} = SpaceEncode($FORM{$item});
                $FORM{$item} = TagEncode($FORM{$item});
                $FORM{$item} =~ s/\n/<BR>/g;
                $FORM{$item} = '-' if($FORM{$item} eq '' && $NullMode);
                $FORM{$item} = AutoLink($FORM{$item}) if($AutoLinkMode);
                PreviewItem($item,$FORM{$item});
            }
        }
    }
    else{ ExpandVariable(*_); print }
}
print $CopyRight; exit;
}

#################
#   DataCheck   #
#################
sub DataCheck {
if($FORM{$MailItemName} && $FORM{$MailItemName} !~ /^[\w\'-\*\,-\.\_]+\@[\w\'-\*\,-\.\_]+\.[\w\'-\*\,-\.\_]+$/){ $item = $MailItemName;  Error(1004) }
foreach(0..$#SameItem){
    ($a,$b)=($SameItem[$_][0],$SameItem[$_][1]);
    Error(1001) if($FORM{$a} ne $FORM{$b});
}
}

##################
#   DataCheck2   #
##################
sub DataCheck2 {
if($FormItem[$_]{$item}[0]){ Error(1002) if($FORM{$item} eq '') }
unless($FormItem[$_]{$item}[1]){ $FORM{$item} =~ s/\n//g }
if($FormItem[$_]{$item}[2]){ ($len,$maxlen)=(length($FORM{$item}),$FormItem[$_]{$item}[2]); Error(1003) if($len > $maxlen); }
if($FormItem[$_]{$item}[5]){ Error(1004) if($FORM{$item} !~ /$FormItem[$_]{$item}[5]/i) }
if($FormItem[$_]{$item}[6]){ Error(1004) if($FORM{$item} =~ /$FormItem[$_]{$item}[6]/i) }
}

################
#   SendMail   #
################
sub SendMail {
SecurityCheck($MyUrl,$MethodChkMode,0,1,$ProxyChkMode,$DomainChkMode,$VipDomainMode);
DataCheck();
foreach(0..$#FormItem){
    foreach$item(keys%{$FormItem[$_]}){
        DataCheck2();
        $FORM{$item} =~ s/&quot;/\"/g;
        $FORM{$item} = SpaceEncode($FORM{$item});
        push(@AdminItemNums,$_) if($FormItem[$_]{$item}[4] == 1 || $FormItem[$_]{$item}[4] == 3);
        push(@UserItemNums,$_) if($FormItem[$_]{$item}[4] >= 2);
    }
}
GetTime($NowTime,'eng');
$Date = sprintf("%04d/%02d/%02d(%s) %02d:%02d:%02d",$year+1900,$mon+1,$mday,$week[$wday],$hour,$min,$sec);
$MailMsg = MailHead($FORM{$MailItemName},$AdminMail,$CcMail,$FORM{$MailItemName},$FORM{$SubjectItemName});
$MailMsg .= "======================================================\n";
$MailMsg .= "送信日時：$Date\n";
$MailMsg .= "IPアドレス：$ENV{REMOTE_ADDR}\n";
$MailMsg .= "ホスト名：$ENV{REMOTE_HOST}\n";
$MailMsg .= "$ENV{HTTP_USER_AGENT}\n";
$MailMsg .= "======================================================\n\n";
$MailMsg .= $MailAdminAbove;
foreach(@AdminItemNums){
    foreach$item(keys%{$FormItem[$_]}){
        if($FORM{$item} eq ''){ if($NullMode){ $FORM{$item} = '-' } else{ next } }
        $MailMsg .= "■$item： $FORM{$item}\n";
    }
}
$MailMsg .= $MailAdminBelow;
# FileWrite("test.dat",*MailMsg,1);# 
jcode::convert(*MailMsg,'jis');
Lock("$FORM{FormName}.loc");
MailWrite(*MailMsg);
if($FORM{$UserMailItemName}){
    $MailMsg = MailHead($AdminMail,$FORM{$MailItemName},0,$AdminMail,$FORM{$SubjectItemName});
    $MailMsg .= $MailUserAbove;
    foreach(@UserItemNums){
        foreach$item(keys%{$FormItem[$_]}){
            if($FORM{$item} eq ''){ if($NullMode){ $FORM{$item} = '-' } else{ next } }
            $MailMsg .= "■$item： $FORM{$item}\n";
        }
    }
    $MailMsg .= $MailUserBelow;
    # FileWrite("test.dat",*MailMsg,1,1);# 
    jcode::convert(*MailMsg,'jis');
    MailWrite(*MailMsg);
}
$SID = $FORM{SID};
FileWrite("$SidDir/submit.sid",*SID,1);
AccessLog("$DataDir/$FORM{FormName}/access","[$Date] - $DomainName - $ENV{REMOTE_ADDR} - $ENV{HTTP_USER_AGENT} - $ENV{HTTP_REFERER} - $ENV{HTTP_X_FORWARDED_FOR} - $FORM{FormName}\n") if($AccessLogMode);
Unlock("$FORM{FormName}.loc");
&Location($AfterUrl);}

###############################################################################
