# ���Ǘ��҃��[���A�h���X
$AdminMail = 'uprweb1@upr-net.co.jp';

# ��CC���[���A�h���X
$CcMail = 'naoshi.kimura@upr-net.co.jp,yoshio.akasaka@upr-net.co.jp,yoshihiro.iwamiya@upr-net.co.jp,keiko.yamazoe@upr-net.co.jp';

# ���ݒu�T�C�g�̍ŒZURL
$MyUrl = 'http://www.upr-net.co.jp';

# ��method�`���`�F�b�N(ON=1/OFF=0)
$MethodChkMode = '1';

# �������̓f�[�^���M(ON=1/OFF=0)
$NullMode = '0';

# ���m�F��ʂ̎��������N(ON=1/OFF=0)
$AutoLinkMode = '0';

# �����������N�̃^�[�Q�b�g
$AutoTarget = '_blank';

# �����M��ɃW�����v����URL
$AfterUrl = 'http://www.upr-net.co.jp/carsharing/contact/ThankYou.html';

# ���A�N�Z�X���O�L�^(ON=1/OFF=0)
$AccessLogMode = '1';

# ���A�N�Z�X���O�ő匏��(1�t�@�C��)
$MaxAccessLog = '100';

# ���ő�A�N�Z�X���O�t�@�C����
$MaxAccessLogFile = '5';

# �����͂�����ł���K�v�����鍀��
@SameItem = (
['E-Mail','�ē���'],
);

# ���t�H�[���̍���
# [�K�{,���s,������,�v���r���[,���M,�L������,��������]
@FormItem = (
{ '�X�֔ԍ�' => [1,0,0,1,3,'',''], },
{ '�s���{��' => [1,0,0,1,3,'','\s'], },
{ '�s�����ȉ�' => [1,0,0,1,3,'',''], },
{ '�r���E�}���V������' => [0,0,0,1,3,'',''], },
{ '��Ж�' => [0,0,0,1,3,'',''], },
{ '�Ǝ�' => [0,0,0,1,3,'',''], },
{ '������' => [0,0,0,1,3,'',''], },
{ '���S���Җ�' => [1,0,0,1,3,'',''], },
{ 'Tel' => [1,0,0,1,3,'',''], },
{ 'Fax' => [0,0,0,1,3,'',''], },
{ 'E-Mail' => [0,0,0,1,3,'',''], },
{ '�ē���' => [0,0,0,0,0,'',''], },
{ '���₢���킹���e' => [1,1,0,1,3,'',''], },
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
$MailItemName = 'E-Mail';

# ���T�u�W�F�N�g�Ƃ��ĔF�������鍀�ږ�
$SubjectItemName = 'subject';

# �����M�҂ւ̃��[�����M�̗L���Ƃ��ĔF�������鍀�ږ�
$UserMailItemName = 'E-Mail';

# ���Ǘ��҂ւ̃��[���㕔
$MailAdminAbove = <<'TEXT';

TEXT

# ���Ǘ��҂ւ̃��[������
$MailAdminBelow = <<'TEXT';

TEXT

# �����M�҂ւ̃��[���㕔
$MailUserAbove = <<'TEXT';
���₢���킹���肪�Ƃ��������܂��B
���L�̓��e�ŏ���܂����B

TEXT

# �����M�҂ւ̃��[������
$MailUserBelow = <<'TEXT';


upr�J�[�V�F�A�����O�V�X�e��
TEL:(03)5405-7455

TEXT

1;
