# ���Ǘ��҃��[���A�h���X
$AdminMail = 'uprweb1@upr-net.co.jp';

# ��CC���[���A�h���X
#$CcMail = 'xxxtetsuo.yoshizawa@upr-net.co.jpxxx';

# ���ݒu�T�C�g�̍ŒZURL
$MyUrl = '';

# ��method�`���`�F�b�N(ON=1/OFF=0)
$MethodChkMode = '1';

# �������̓f�[�^���M(ON=1/OFF=0)
$NullMode = '0';

# ���m�F��ʂ̎��������N(ON=1/OFF=0)
$AutoLinkMode = '0';

# �����������N�̃^�[�Q�b�g
$AutoTarget = '_blank';

# �����M��ɃW�����v����URL
$AfterUrl = 'http://www.upr-net.co.jp/english/contact/ThankYou.htm';

# ���A�N�Z�X���O�L�^(ON=1/OFF=0)
$AccessLogMode = '1';

# ���A�N�Z�X���O�ő匏��(1�t�@�C��)
$MaxAccessLog = '100';

# ���ő�A�N�Z�X���O�t�@�C����
$MaxAccessLogFile = '5';

# �����͂�����ł���K�v�����鍀��
@SameItem = (
['E-mail Address','Confirmation'],
);

# ���t�H�[���̍���
# [�K�{,���s,������,�v���r���[,���M,�L������,��������]
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

# ���m�F���1���ڕ���HTML
sub PreviewItem{
my($item,$data) = @_;
print <<TEXT;
<TR><TD bgcolor="#ffffff" style="font-size : 9pt;">$item</TD>
<TD bgcolor="#ffffff" style="font-size : 9pt;">$data</TD></TR>
TEXT
}

# �����[���A�h���X�Ƃ��ĔF�������鍀�ږ�
$MailItemName = 'E-mail Address';

# ���T�u�W�F�N�g�Ƃ��ĔF�������鍀�ږ�
$SubjectItemName = 'subject';

# �����M�҂ւ̃��[�����M�̗L���Ƃ��ĔF�������鍀�ږ�
$UserMailItemName = 'E-mail Address';

# ���Ǘ��҂ւ̃��[���㕔
$MailAdminAbove = <<'TEXT';

TEXT

# ���Ǘ��҂ւ̃��[������
$MailAdminBelow = <<'TEXT';

TEXT

# �����M�҂ւ̃��[���㕔
$MailUserAbove = <<'TEXT';
Thank you for your interest in UPR.
Your feedback and comments are important to us.

TEXT

# �����M�҂ւ̃��[������
$MailUserBelow = <<'TEXT';


UPR Co., Ltd
http://www.upr-net.co.jp/

TEXT

1;
