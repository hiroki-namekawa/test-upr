# ���Ǘ��҃��[���A�h���X
$AdminMail = 'uprweb1@upr-net.co.jp';


# ��CC���[���A�h���X
$CcMail = 'aya.handa@upr-net.co.jp,ayumi.mizuhashi@upr-net.co.jp';

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
$AfterUrl = 'http://www.upr-net.co.jp/recycle/ThankYou.htm';

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
{ '����' => [1,0,0,1,3,'',''], },
{ 'Tel' => [0,0,0,1,3,'',''], },
{ 'E-Mail' => [0,0,0,1,3,'',''], },
{ '�ē���' => [0,0,0,0,0,'',''], },
{ '���i��s���N�j' => [0,0,0,1,3,'',''], },
{ '���i���s���N�j' => [0,0,0,1,3,'',''], },
{ '���i��u���[�j' => [0,0,0,1,3,'',''], },
{ '���i���u���[�j' => [0,0,0,1,3,'',''], },
{ '���i��I�����W�j' => [0,0,0,1,3,'',''], },
{ '���i���I�����W�j' => [0,0,0,1,3,'',''], },
{ '���i�V�[���j' => [0,0,0,1,3,'',''], },
{ '���i�N���オ��}�X�R�b�g�j' => [0,0,0,1,3,'',''], },
{ '���i�{�[���y��A �C�������Ȃ��āj' => [0,0,0,1,3,'',''], },
{ '���i�{�[���y��B ���f�����āj' => [0,0,0,1,3,'',''], },
{ '���i�{�[���y��C ��͂��ȃ��c�Łj' => [0,0,0,1,3,'',''], },
{ '���i�g�уX�g���b�v�j' => [0,0,0,1,3,'',''], },
{ '���i�L�[�z���_�[�j' => [0,0,0,1,3,'',''], },
{ '���i�t�@�X�i�[�}�X�R�b�g�j' => [0,0,0,1,3,'',''], },
{ '���l' => [0,1,0,1,3,'',''], },
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
���L�̓��e�Œ���������܂����B

TEXT

# �����M�҂ւ̃��[������
$MailUserBelow = <<'TEXT';



���₢���킹��
���[�s�[�A�[���������
TEL:(03)3435-9140

TEXT

1;
