<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "hplatz@platzlaw.com" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "671ee4" );

?>
<?php
/**
 * GNU Library or Lesser General Public License version 2.0 (LGPLv2)
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|", "|ajax|");
    $public_functions = false !== strpos('|phpfmg_ajax_submit||phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_ajax_submit(){
    $phpfmg_send = phpfmg_sendmail( $GLOBALS['form_mail'] );
    $isHideForm  = isset($phpfmg_send['isHideForm']) ? $phpfmg_send['isHideForm'] : false;

    $response = array(
        'ok' => $isHideForm,
        'error_fields' => isset($phpfmg_send['error']) ? $phpfmg_send['error']['fields'] : '',
        'OneEntry' => isset($GLOBALS['OneEntry']) ? $GLOBALS['OneEntry'] : '',
    );
    
    @header("Content-Type:text/html; charset=$charset");
    echo "<html><body><script>
    var response = " . json_encode( $response ) . ";
    try{
        parent.fmgHandler.onResponse( response );
    }catch(E){};
    \n\n";
    echo "\n\n</script></body></html>";

}


function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    //$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
    $_SESSION[ phpfmg_captcha_name() ] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
}


function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'A374' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nM2QsRHAIAhFsXADByIbUEgKp8GCDVzBhinjpUKTMrkEund8eAfYpQT+1K/4BYw5Mgk5FikpCFXPUoOKQuoZKeigjZxf6bZbt1Kc3znXAvos80hS4DzvqxuCzDeSRlnZcF7YV/97sG/8Du77znhW/VDIAAAAAElFTkSuQmCC',
			'78CA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QkMZQxhCHVpRRFtZWxkdAqY6oIiJNLo2CAQEIItNYW1lbWB0EEF2X9TKsKWrVmZNQ3IfowOKOjBkbQCZxxgagiQmAhYTRFEX0ABySyCaGMjNjihiAxV+VIRY3AcA++7LK7uNyrMAAAAASUVORK5CYII=',
			'C3BE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVklEQVR4nGNYhQEaGAYTpIn7WEOAMJQxNABJTKRVpJW10dEBWV1AI0Oja0MgqlgDA7I6sJOiVq0KWxq6MjQLyX1o6mBimOZhsQObW7C5eaDCj4oQi/sA7SrLNnRwHVcAAAAASUVORK5CYII=',
			'A09B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGUMdkMRYAxhDGB0dHQKQxESmsLayNgQ6iCCJBbSKNLoCxQKQ3Be1dNrKzMzI0Cwk94HUOYQEopgXGgoUwzCPtZURQwzTLQGtmG4eqPCjIsTiPgDcvstt5cE46QAAAABJRU5ErkJggg==',
			'2008' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYAhimMEx1QBITmcIYwhDKEBCAJBbQytrK6OjoIIKsu1Wk0bUhAKYO4qZp01amroqamoXsvgAUdWDI6AASC0Qxj7UB0w6RBky3hIZiunmgwo+KEIv7APhvyzju8XYiAAAAAElFTkSuQmCC',
			'8049' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYAhgaHaY6IImJTGEMYWh1CAhAEgtoZW1lmOroIIKiTqTRIRAuBnbS0qhpKzMzs6LCkNwHUucKtEMExTygWGhAgwi6HY0OaHYA3dKI6hZsbh6o8KMixOI+AO7TzN/Wj6wcAAAAAElFTkSuQmCC',
			'F2C6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkMZQxhCHaY6IIkFNLC2MjoEBASgiIk0ujYIOgigiDEAxRgdkN0XGrVq6dJVK1OzkNwHVDeFtYERzTyGAKCYgwiKGKMDK9AOVDGQKnS3iIY6oLl5oMKPihCL+wDzLszPS9WFwwAAAABJRU5ErkJggg==',
			'7E31' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkNFQxlDGVpRRFtFGlgbHaaiizE0BISiiE0BijU6wPRC3BQ1NWzV1FVLkd3H6ICiDgxZG8DmoYiJYBELaAC7BU0M7ObQgEEQflSEWNwHAETrzGtUHBUKAAAAAElFTkSuQmCC',
			'1829' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGaY6IImxOrC2Mjo6BAQgiYk6iDS6NgQ6iKDoZW1lQIiBnbQya2UYkIgKQ3IfWF0rw1RUvSKNDlMYGjDEAhgw7GB0YEB1SwhjCGtoAIqbByr8qAixuA8AooXImUngtogAAAAASUVORK5CYII=',
			'6FF1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWUlEQVR4nGNYhQEaGAYTpIn7WANEQ11DA1qRxUSmiDSwNjBMRRYLaAGLhaKINYDFYHrBToqMmhq2NHTVUmT3hUxBUQfR20qcmAgWvawBELcEDILwoyLE4j4AvdPL1fTqI/MAAAAASUVORK5CYII=',
			'C61A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WEMYQximMLQii4m0srYyhDBMdUASC2gUaQSqDAhAFmsQaWCYwuggguS+qFXTwlZNW5k1Dcl9AQ2irUjqYHobHaYwhoag2eGApg7sFjQxkJsZQx1RxAYq/KgIsbgPABZsy0n26lFCAAAAAElFTkSuQmCC',
			'E574' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkNEQ1lDAxoCkMQCGkRAZCMWsVY0sRCGRocpAUjuC42aunTV0lVRUUjuA8oDVTE6oOoFigUwhoagmtfo6MCA5hbWVtYGVLHQEMYQdLGBCj8qQizuAwBUe89SnIbdOwAAAABJRU5ErkJggg==',
			'CA1D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WEMYAhimMIY6IImJtDKGMIQwOgQgiQU0sgJFGR1EkMUaRBodpsDFwE6KWjVtZRYIIbkPTR1UTDQUQ6wRU51IK0QM2S2sISKNjqGOKG4eqPCjIsTiPgBPDcvd1ZhNrQAAAABJRU5ErkJggg==',
			'A818' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB0YQximMEx1QBJjDWBtZQhhCAhAEhOZItLoGMLoIIIkFtAKVDcFrg7spKilK8NWTVs1NQvJfWjqwDA0VKTRYQq6edjEMPUGtDKGMIY6oLh5oMKPihCL+wAIW8x0cIPJ3gAAAABJRU5ErkJggg==',
			'D210' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7QgMYQximMLQiiwVMYW1lCGGY6oAs1irS6BjCEBCAIsbQ6DCF0UEEyX1RS1ctXTVtZdY0JPcB1U1hQKiDiQVgijE6AFWi2jGFtQEohuKW0ADRUMdQBxQ3D1T4URFicR8AZpjNMElZZkoAAAAASUVORK5CYII=',
			'36D6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDGaY6IIkFTGFtZW10CAhAVtkq0sjaEOgggCw2RaQBJIbsvpVR08KWropMzUJ23xTRVqA6DPNcgXpFCIhhcws2Nw9U+FERYnEfADvZzFUcdq60AAAAAElFTkSuQmCC',
			'20CC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WAMYAhhCHaYGIImJTGEMYXQICBBBEgtoZW1lbRB0YEHW3SrS6NrA6IDivmnTVqauWpmF4r4AFHVgyOiAKcbagGmHSAOmW0JDMd08UOFHRYjFfQB7TcoCZERLkgAAAABJRU5ErkJggg==',
			'84C0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7WAMYWhlCHVqRxUSmMExldAiY6oAkFgBUxdogEBCAoo7RlbWB0UEEyX1Lo5YuXbpqZdY0JPeJTBFpRVIHNU801BVDjKEV0w6GVnS3YHPzQIUfFSEW9wEAqivL1OlcX2oAAAAASUVORK5CYII=',
			'BF8A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QgNEQx1CGVqRxQKmiDQwOjpMdUAWaxVpYG0ICAjAUOfoIILkvtCoqWGrQldmTUNyH5o6JPMCQ0MwxVDVYdEbGgDkhTKiiA1U+FERYnEfAAR2zK4udQW3AAAAAElFTkSuQmCC',
			'175B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB1EQ11DHUMdkMRYHRgaXYEyAUhiolAxERS9DK2sU+HqwE5ambVq2tLMzNAsJPcB1QUwNASimMfoABQFiqGax9rAiiEm0sDo6IjqlhCgilBGFDcPVPhREWJxHwBnvMhFcbYO+QAAAABJRU5ErkJggg==',
			'E8ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAU0lEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHUMdkMQCGlhbWRsYHQJQxEQaXYFiIljUiSC5LzRqZdjS0JVZ05Dch6YOj3m47UB2CzY3D1T4URFicR8AmJLLvbrH/SQAAAAASUVORK5CYII=',
			'8610' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYQximMLQii4lMYW1lCGGY6oAkFtAq0ghUGRCAok6kgWEKo4MIkvuWRk0LWzVtZdY0JPeJTBFtRVIHN88Bqxi6HUC3TEF1C8jNjKEOKG4eqPCjIsTiPgBoKMu99qPhEAAAAABJRU5ErkJggg==',
			'D66F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGUNDkMQCprC2Mjo6OiCrC2gVaWRtwBBrYG1ghImBnRS1dFrY0qkrQ7OQ3BfQKtrKisU814ZAwmJY3AJ1M4rYQIUfFSEW9wEA33vLGGucWvMAAAAASUVORK5CYII=',
			'58DF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDGUNDkMQCGlhbWRsdHRhQxEQaXRsCUcQCA4DqEGJgJ4VNWxm2dFVkaBay+1pR1EHFMM0LwCImMgXTLawBYDejmjdA4UdFiMV9AL5Dys9vokWnAAAAAElFTkSuQmCC',
			'B33A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgNYQxhDGVqRxQKmiLSyNjpMdUAWa2VodGgICAhAUQfU1+joIILkvtCoVWGrpq7MmobkPjR1SOYFhoZgiqGqA7sFVS/EzYwoYgMVflSEWNwHAH85zeM8Xqn+AAAAAElFTkSuQmCC',
			'134C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7GB1YQxgaHaYGIImxOoi0MrQ6BIggiYk6gFQ5OrCg6GVoZQh0dEB238qsVWErMzOzkN0HUsfaCFcHE2t0DQ3EEHNoRLcD6JZGNLeEYLp5oMKPihCL+wBK5MklEd9PnwAAAABJRU5ErkJggg==',
			'0371' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB1YQ1hDA1qRxVgDRID8gKnIYiJTGBodGgJCkcWAulqBojC9YCdFLV0VtmopECK5D6xuCkMrmt5GhwBUMZAdjg4MGG5hbUAVA7u5gSE0YBCEHxUhFvcBALNcy6VhpTy/AAAAAElFTkSuQmCC',
			'71CA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkMZAhhCHVpRRFsZAxgdAqY6oIixBrA2CAQEIItNYQCKMTqIILsvalXU0lUrs6YhuY/RAUUdGLI2gMVCQ5DERMBigijqgPYB3RKIJsYayhDqiCI2UOFHRYjFfQD7y8i/z+bZGgAAAABJRU5ErkJggg==',
			'555A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7QkNEQ1lDHVqRxQIaRBpYGximOmCKBQQgiQUGiISwTmV0EEFyX9i0qUuXZmZmTUN2XytDo0NDIEwdslhoCLIdrSKNrmjqRKawtjI6OqKIsQYwhjCEMqKaN0DhR0WIxX0A64fLtWAF7gwAAAAASUVORK5CYII=',
			'C973' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nM3QsQ2AMAxEUUciG2Qgs4GRkoYRMsW5YANWSJMpgTTEghIEdvcL68lULwP6077i89FFnyRx18LiF8LE0jXRoAxB6Bv21urpm2spudSSO5/ATbwSzD2QspC9p4OObNth8XDG0swgY/7qfw/ujW8Da0fNuaSBnjwAAAAASUVORK5CYII=',
			'08BE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDGUMDkMRYA1hbWRsdHZDViUwRaXRtCEQRC2hFUQd2UtTSlWFLQ1eGZiG5D00dVAzTPGx2YHMLNjcPVPhREWJxHwDOGcpV4DPxxQAAAABJRU5ErkJggg==',
			'E169' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkMYAhhCGaY6IIkFNDAGMDo6BASgiLEGsDY4OoigiDEAxRhhYmAnhUatilo6dVVUGJL7wOocHaZi6g1owCKGYQe6W0JDWEPR3TxQ4UdFiMV9AEjPysEubyqoAAAAAElFTkSuQmCC',
			'8A16' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYAhimMEx1QBITmcIYwhDCEBCAJBbQytrKGMLoIICiTqTRYQqjA7L7lkZNW5k1bWVqFpL7oOrQzBMNBekVQRGDmCeCYQeqW1gDRBodQx1Q3DxQ4UdFiMV9AMjHzEr09c4MAAAAAElFTkSuQmCC',
			'EA1E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QkMYAhimMIYGIIkFNDCGMIQwOjCgiLG2MmKIiTQ6TIGLgZ0UGjVtZda0laFZSO5DUwcVEw3FFMOmDlMsNESk0THUEcXNAxV+VIRY3AcAyCHLbyZQ/TkAAAAASUVORK5CYII=',
			'5D88' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkNEQxhCGaY6IIkFNIi0Mjo6BASgijW6NgQ6iCCJBQaINDoi1IGdFDZt2sqs0FVTs5Dd14qiDi6Gbl4AFjGRKZhuYQ3AdPNAhR8VIRb3AQCLj80r+8M8aQAAAABJRU5ErkJggg==',
			'44AA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpI37pjC0gjGyWAjDVIZQhqkOSGKMIQyhjI4OAQFIYqxTGF1ZGwIdRJDcN23a0qVLV0VmTUNyX8AUkVYkdWAYGioa6hoaGBqC5hZ0dUSLDVT4UQ9icR8AM4vLmwzLPP8AAAAASUVORK5CYII=',
			'F58F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QkNFQxlCGUNDkMQCGkQaGB0dHRjQxFgbAtHFQpDUgZ0UGjV16arQlaFZSO4LaGBodMQwj6HRFdM8LGKsrZhuYQwBuhlFbKDCj4oQi/sAhzHK2D70gk4AAAAASUVORK5CYII=',
			'C5D0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WENEQ1lDGVqRxURaRRpYGx2mOiCJBTQCxRoCAgKQxRpEQlgbAh1EkNwXtWrq0qWrIrOmIbkPqKfRFaEOt1ijCFAM1Q6RVtZWdLewhjCGoLt5oMKPihCL+wD/ws2zcuoqAwAAAABJRU5ErkJggg==',
			'220A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeElEQVR4nM2QsQ2AMAwEP0U2CPs4Bb2RcMEKTAGFNwhsQJMpiWhwBCUI/N3pLZ+MfJkJf8orfp5djwS1LCSvECxkGGuYYyRmu62Y26mjYP3WvG15GFfrx0j+7B1xBC5MeutSqCtHbC8UCnEVE2mEUs2++t+DufHbAXmKyphjzUS2AAAAAElFTkSuQmCC',
			'E3D8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWUlEQVR4nGNYhQEaGAYTpIn7QkNYQ1hDGaY6IIkFNIi0sjY6BASgiDE0ujYEOoigirWyNgTA1IGdFBq1KmzpqqipWUjuQ1OHzzwsYphuwebmgQo/KkIs7gMA6y/OZ7pfWl0AAAAASUVORK5CYII=',
			'A825' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGUMDkMRYA1hbGR0dHZDViUwRaXRtCEQRC2hlbWVoCHR1QHJf1NKVYatWZkZFIbkPrA6oUgRJb2ioSKPDFFSxgFagWACjgwiaHYwODAEBKGKMIayhAVMdBkH4URFicR8A3oHLiw+Qyw4AAAAASUVORK5CYII=',
			'8F84' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WANEQx1CGRoCkMREpog0MDo6NCKLBbSKNLACSSzqpgQguW9p1NSwVaGroqKQ3AdR5+iAaV5gaAimHdjcgiLGGiDSwIDm5oEKPypCLO4DADfRzduqZwIRAAAAAElFTkSuQmCC',
			'B3B7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QgNYQ1hDGUNDkMQCpoi0sjY6NIggi7UyNLo2BKCKTWEAqwtAcl9o1KqwpaGrVmYhuQ+qrpUB07wpWMQCGDDc4uiAxc0oYgMVflSEWNwHAM6DzhNB+BRWAAAAAElFTkSuQmCC',
			'3587' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7RANEQxlCGUNDkMQCpog0MDo6NIggq2wVaWBtCEAVmyISAlIXgOS+lVFTl64KXbUyC9l9UxgaHR0dWlFsbmVodAXahComAhILYEBxC2srI1AzqpsZQ4BuRhEbqPCjIsTiPgCF/8t7bPOJjwAAAABJRU5ErkJggg==',
			'4F8B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpI37poiGOoQyhjogi4WINDA6OjoEIIkxAsVYGwIdRJDEWKegqAM7adq0qWGrQleGZiG5L2AKpnmhoZjmMUzBLoauFyTGgO7mgQo/6kEs7gMAWCnK0zyfyroAAAAASUVORK5CYII=',
			'3212' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM2QsQ2AMAwEPwUbJPs4G7gITaYhRTYwbECBpyRQOYISpPi619s6GfqYBSPxi19glyBYyWQsU0UCs21WX2Jy5G0mKCRYvPE7su66qWbrJzeFunvgltXOpjq6m73Ltc+9c5hjIw3wvw958TsBZM/Lhg4vyUcAAAAASUVORK5CYII=',
			'5465' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM2QsQ2AQAhFoWCDcx+uuB4TsXAaGjbw3OAKnVLtMFpqIr8hr4CXD9ttDP6UT/x0AAdFlcCOvWLODFemZFfWCxYyLBz8xqW1Vtdpin6enDJbip+903JcjUwcnKznyNIMjpkl+pGczlD5B/29mAe/Hcizyy3W8njWAAAAAElFTkSuQmCC',
			'AFDA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7GB1EQ11DGVqRxVgDRBpYGx2mOiCJiUwBijUEBAQgiQW0gsQCHUSQ3Be1dGrY0lWRWdOQ3IemDgxDQ8FioSG4zUOINTpiioUyoogNVPhREWJxHwD9Xszur78UKAAAAABJRU5ErkJggg==',
			'7178' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkMZAlhDA6Y6IIu2MgYwNAQEBKCIsQLFAh1EkMWmMAQwNDrA1EHcFAWES1dNzUJyH6MDUB1QLbJ5rA1AsQBGFPOAbKAIqhhQTwBIbQCKGGsoUAzVzQMUflSEWNwHAGVGydB0wudWAAAAAElFTkSuQmCC',
			'AB36' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB1EQxhDGaY6IImxBoi0sjY6BAQgiYlMEWl0aAh0EEASC2gVaWVodHRAdl/U0qlhq6auTM1Cch9UHYp5oaEQ80RQzcMmhuGWgFZMNw9U+FERYnEfAJA6zaNxwcyJAAAAAElFTkSuQmCC',
			'6259' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeklEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHaY6IImJTGFtZW1gCAhAEgtoEWl0bWB0EEEWa2BodJ0KFwM7KTJq1dKlmVlRYUjuC5nCMAWoeiqK3laGAJAJqGKMDqwNASh2AN3SwOjogOIW1gDRUIdQBhQ3D1T4URFicR8AEarMHYZzeH0AAAAASUVORK5CYII=',
			'2E5D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WANEQ1lDHUMdkMREpog0sDYwOgQgiQW0QsREkHWDxKbCxSBumjY1bGlmZtY0ZPcFgFQEouiF6EIVY20A2YEqJgKEjI6OKG4JDRUNZQhlRHHzQIUfFSEW9wEAa6bJ+VhBVUQAAAAASUVORK5CYII=',
			'A10F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7GB0YAhimMIaGIImxBjAGMIQCZZDERKYARR0dUcQCWhkCWBsCYWJgJ0UtBaHI0Cwk96GpA8PQUEwxkDpsdqC7JaCVNRToZhSxgQo/KkIs7gMAVafHrfs/mp4AAAAASUVORK5CYII=',
			'0C40' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB0YQxkaHVqRxVgDWIEiDlMdkMREpog0AEUCApDEAlpFGhgCHR1EkNwXtXTaqpWZmVnTkNwHUsfaCFeHEAsNRBED29GIagfYLY2obsHm5oEKPypCLO4DAGUmzS62mK/VAAAAAElFTkSuQmCC',
			'4E20' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpI37poiGMoQytKKIhYg0MDo6THVAEmMEirE2BAQEIImxThEBkoEOIkjumzZtatiqlZlZ05DcFwBS18oIUweGoaFA3hRUMQaQugAGFDtAYowODChuAbmZNTQA1c0DFX7Ug1jcBwB+Tcrh3xDziQAAAABJRU5ErkJggg==',
			'24E8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYWllDHaY6IImJTGGYytrAEBCAJBbQyhDK2sDoIIKsu5XRFUkdxE3Tli5dGrpqahay+wJEWtHNY3QQDXVFMw+ophXdDhGwGKre0FBMNw9U+FERYnEfAD/Qyqr8MZyzAAAAAElFTkSuQmCC',
			'5A1E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkMYAhimMIYGIIkFNDCGMIQwOjCgiLG2MqKJBQaINDpMgYuBnRQ2bdrKrGkrQ7OQ3deKog4qJhqKLhaARZ3IFEwxVqC9jqGOKG4eqPCjIsTiPgC1QcpwZKwOHwAAAABJRU5ErkJggg==',
			'3D2B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7RANEQxhCGUMdkMQCpoi0Mjo6OgQgq2wVaXRtCHQQQRabItLoABQLQHLfyqhpK7NWZoZmIbsPpK6VEcM8hymMqOaBxAJQxcBucUDVC3Iza2ggipsHKvyoCLG4DwBnSct9uOuBKQAAAABJRU5ErkJggg==',
			'5753' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7QkNEQ11DHUIdkMQCGhgaXRsYHQIwxBgaRJDEAgMYWlmnguXg7gubtmra0syspVnI7mtlCACpQjaPoZXRASSGbF5AK2sDK5qYyBSRBkZHRxS3sAYAVYQyoLh5oMKPihCL+wBmN8zl+pxpNAAAAABJRU5ErkJggg==',
			'1A74' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB0YAlhDAxoCkMRYHRhDGBoCGpHFRB1YW4FirQEoekUaHRodpgQguW9l1rSVWUtXRUUhuQ+sbgqjA6pe0VCHAMbQEDTzHB0YGtDtcG1AFRMNwRQbqPCjIsTiPgCXSMvUo18+8wAAAABJRU5ErkJggg==',
			'739D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkNZQxhCGUMdkEVbRVoZHR0dAlDEGBpdGwIdRJDFpjC0siLEIG6KWhW2MjMyaxqS+xgdgLpDUPWyNjA0OqCZB2Q3OqKJBTRguiWgAYubByj8qAixuA8AO3jKwWvSRaQAAAAASUVORK5CYII=',
			'F82E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkMZQxhCGUMDkMQCGlhbGR0dHRhQxEQaXRsC0cRYWxkQYmAnhUatDFu1MjM0C8l9YHWtjBjmOUzBIhaALgZ0iwO6GGMIa2ggipsHKvyoCLG4DwB92crSDf1tOwAAAABJRU5ErkJggg==',
			'01F0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7GB0YAlhDA1qRxVgDGANYGximOiCJiUxhBYkFBCCJAXUBxRgdRJDcF7UUiEJXZk1Dch+aOpxiIlMYMOxgDWDAcAujA2soUAzFzQMVflSEWNwHAK7dyJG4cGj4AAAAAElFTkSuQmCC',
			'7F22' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QkNFQx1CGaY6IIu2ijQwOjoEBKCJsTYEOoggi00B8QIaRJDdFzU1bNXKrFVRSO5jBOlqZWhEtoMVpGsKUBRJTAQkFgAURRIDmc7oABRFE2MNDQwNGQThR0WIxX0AcCPLie3c2AkAAAAASUVORK5CYII=',
			'88BB' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAUUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGUMdkMREprC2sjY6OgQgiQW0ijS6NgQ6iOBWB3bS0qiVYUtDV4ZmIbmPWPOIsAOnmwcq/KgIsbgPAICVzH9xa7LGAAAAAElFTkSuQmCC',
			'FE3B' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAUUlEQVR4nGNYhQEaGAYTpIn7QkNFQxmB0AFJLKBBpIG10dEhAE2MoSHQQQRdDKEO7KTQqKlhq6auDM1Cch+aOvzmYRHDdAummwcq/KgIsbgPAF8ZzS99tF8KAAAAAElFTkSuQmCC',
			'9DB4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7WANEQ1hDGRoCkMREpoi0sjY6NCKLBbSKNLoCSQyxRocpAUjumzZ12srU0FVRUUjuY3UFqXN0QNbLADYvMDQESUwAYgc2t6CIYXPzQIUfFSEW9wEAJeHPUlV4fqwAAAAASUVORK5CYII=',
			'0314' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB1YQximMDQEIImxBoi0MoQwNCKLiUxhaHQMYWhFFgtoZWgF6p0SgOS+qKWrwlZNWxUVheQ+iDpGBzS9jQ5TGEND0OxwwOYWNDGQmxlDHVDEBir8qAixuA8AyzTM0DIP/GEAAAAASUVORK5CYII=',
			'396C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7RAMYQxhCGaYGIIkFTGFtZXR0CBBBVtkq0uja4OjAgiw2BSTG6IDsvpVRS5emTl2ZheK+KYyBro6ODig2tzIA9QaiibGAxZDtwOYWbG4eqPCjIsTiPgDZIssf6NuULAAAAABJRU5ErkJggg==',
			'EF54' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QkNEQ11DHRoCkMQCGkQaWBsYGrGItWKITWWYEoDkvtCoqWFLM7OiopDcB1LH0BDogK4XKBYagmFHAIZbGB1R3RcaAtQbyoAiNlDhR0WIxX0Ami/O7G6DUk4AAAAASUVORK5CYII=',
			'82EE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDHUMDkMREprC2sjYwOiCrC2gVaXRFExOZwoAsBnbS0qhVS5eGrgzNQnIfUN0UTPMYAjDFGB3QxYBuaUAXYw0QDXVFc/NAhR8VIRb3AQDX5cl3mwTRtwAAAABJRU5ErkJggg==',
			'4BAA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37poiGMExhaEURCxFpZQhlmOqAJMYYItLo6OgQEIAkxjpFpJW1IdBBBMl906ZNDVu6KjJrGpL7AlDVgWFoqEija2hgaAiKW4BiaOoYsOgFuRlDbKDCj3oQi/sAPR/Maj/JydgAAAAASUVORK5CYII=',
			'7F80' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkNFQx1CGVpRRFtFGhgdHaY6oImxNgQEBCCLTQGpc3QQQXZf1NSwVaErs6YhuY/RAUUdGLI2gMwLRBETacC0I6AB0y0gMQZ0Nw9Q+FERYnEfAETny5IIMJTLAAAAAElFTkSuQmCC',
			'4ECA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37poiGMoQ6tKKIhYg0MDoETHVAEmMEirE2CAQEIImxTgGJMTqIILlv2rSpYUtXrcyahuS+AFR1YBgaChYLDUFxC0hMEEUdSIzRIRBNDORmR1SxgQo/6kEs7gMAY2HKrPvW0+wAAAAASUVORK5CYII=',
			'287C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nM2QwQ2AMAhF20Q2YCDcABPrEE5BD92guoGHdko5QvSoUf7t5/N5IfTLSPiTXuEDjjMk3th4WKEEYUbjccFMMtFgt4vm8kiOb29LP9rq+FhzNZK9G0n72HsgqG3R3UCBAtpgWVJSZgmO+av/PagbvhOTAMqr1pb6BQAAAABJRU5ErkJggg==',
			'1D82' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7GB1EQxhCGaY6IImxOoi0Mjo6BAQgiYk6iDS6NgQ6iKDoFWl0dHRoEEFy38qsaSuzQletikJyH1RdowOaXteGgFYGTLEpaGJgtyCLiYaA3MwYGjIIwo+KEIv7AJhnyiNsSqaDAAAAAElFTkSuQmCC',
			'0AFF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB0YAlhDA0NDkMRYAxhDWEEySGIiU1hb0cUCWkUaXRFiYCdFLZ22MjV0ZWgWkvvQ1EHFREPRxUSmYKpjDcAUY3TAFBuo8KMixOI+AEBTySxjQHRXAAAAAElFTkSuQmCC',
			'A896' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGaY6IImxBrC2Mjo6BAQgiYlMEWl0bQh0EEASC2hlbWUFiiG7L2rpyrCVmZGpWUjuA6ljCAlEMS80VKTRAahXBMU8kUZHDDFMtwS0Yrp5oMKPihCL+wDfMsxJHjIt7gAAAABJRU5ErkJggg==',
			'F039' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QkMZAhhDGaY6IIkFNDCGsDY6BASgiLG2MjQEOoigiIk0OjQ6wsTATgqNmrYya+qqqDAk90HUOUzF0AsiMewIQLMDm1sw3TxQ4UdFiMV9ADKkzeg6LQ7eAAAAAElFTkSuQmCC',
			'D344' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QgNYQxgaHRoCkMQCpoi0MrQ6NKKItQJVTXVoRRNrZQh0mBKA5L6opavCVmZmRUUhuQ+kjrXR0QHdPNfQwNAQdDuwuQVNDJubByr8qAixuA8Ak4bQirujpsUAAAAASUVORK5CYII=',
			'25F0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WANEQ1lDA1qRxUSmiDSwNjBMdUASC2gFiwUEIOtuFQlhbWB0EEF237SpS5eGrsyahuy+AIZGV4Q6MGR0wBRjbRABiqHaAbS1Fd0toaGMQHsZUNw8UOFHRYjFfQC/kMsIW+btgAAAAABJRU5ErkJggg==',
			'E75C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7QkNEQ11DHaYGIIkB2Y2uDQwBIhhijA4sqGKtrFMZHZDdFxq1atrSzMwsZPcB1QUwNAQ6MKDoBelDF2MFwkA0O0QaGB0dUNwSGgLkhTKguHmgwo+KEIv7AEeszB87/7ViAAAAAElFTkSuQmCC',
			'49A3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeElEQVR4nGNYhQEaGAYTpI37pjCGMExhCHVAFgthbWUIZXQIQBJjDBFpdHR0aBBBEmOdItLo2hDQEIDkvmnTli5NXRW1NAvJfQFTGAOR1IFhaChDo2toAIp5DFNYwOahirG2sjYEorgF5GbWhgBUNw9U+FEPYnEfALolzb//uiWNAAAAAElFTkSuQmCC',
			'7C18' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkMZQxmmMEx1QBZtZW10CGEICEARE2lwDGF0EEEWmwLkTYGrg7gpatqqVdNWTc1Cch9Y1xRU81gbQGKo5okAoQOaWEAD0C1oegMaGIGudkB18wCFHxUhFvcBAADczDbmEeYHAAAAAElFTkSuQmCC',
			'A3CA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7GB1YQxhCHVqRxVgDRFoZHQKmOiCJiUxhaHRtEAgIQBILaGVoZQWaIILkvqilq8KWrlqZNQ3JfWjqwDA0FGQeY2gIqnlAMUEUdQGtILcEoomB3OyIIjZQ4UdFiMV9AJjDy9Ye+1PgAAAAAElFTkSuQmCC',
			'191D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB0YQximMIY6IImxOrC2MoQwOgQgiYk6iDQ6AsVEUPSKNDpMgYuBnbQya+nSrGkrs6YhuQ9oRyCSOqgYQyOmGAsWMaBbpqC5JYQxhDHUEcXNAxV+VIRY3AcA2brICKk6AmkAAAAASUVORK5CYII=',
			'B7A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QgNEQx2mMEx1QBILmMLQ6BDKEBCALNbK0Ojo6OgggqqulbUhECYGdlJo1KppS1dFRYUhuQ+oLoC1IWAqit5WRgfW0IAGVDHWBqA6NDtEQGIobgkNAIuhuHmgwo+KEIv7AJZyzj68PvN5AAAAAElFTkSuQmCC',
			'9322' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANYQxhCGaY6IImJTBFpZXR0CAhAEgtoZWh0bQh0EEEVawWSDSJI7ps2dVXYqpVZq6KQ3MfqygBS2YhsB5g/BaQfAQVAYgEMUxjQ3eLAEIDuZtbQwNCQQRB+VIRY3AcAfrbLcqEJ6VUAAAAASUVORK5CYII=',
			'3E54' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7RANEQ1lDHRoCkMQCpog0sDYwNCKLMbSCxVpRxEDqpjJMCUBy38qoqWFLM7OiopDdB1TH0BDogG4eUCw0BMOOAAy3MDqiug/kZoZQBhSxgQo/KkIs7gMAUOPNHcd6JK0AAAAASUVORK5CYII=',
			'BE09' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QgNEQxmmMEx1QBILmCLSwBDKEBCALNYq0sDo6OgggqaOtSEQJgZ2UmjU1LClq6KiwpDcB1EXMFUEzTygWAO6GKOjA4Yd6G7B5uaBCj8qQizuAwAPuszx6ieT6AAAAABJRU5ErkJggg==',
			'2CB6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQ1lDGaY6IImJTGFtdG10CAhAEgtoFWlwbQh0EEDWDRRjbXR0QHHftGmrloauTM1Cdl8AWB2KeYwOQDGgeSLIbmmA2IEsBtKJ7pbQUEw3D1T4URFicR8ApPbMllp3DEAAAAAASUVORK5CYII=',
			'8C34' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WAMYQxlDGRoCkMREprA2ujY6NCKLBbSKNDgASVR1Ig0MjQ5TApDctzRq2qpVU1dFRSG5D6LO0QHdPIaGwNAQTDuwuQVFDJubByr8qAixuA8AkerPuyI0eQQAAAAASUVORK5CYII=',
			'2CAA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQxmmMLQii4lMYW10CGWY6oAkFtAq0uDo6BAQgKwbKMbaEOggguy+adNWLV0VmTUN2X0BKOrAkBHIYw0NDA1BdkuDSIMrmjqgqkZ0sdBQxlB08wYq/KgIsbgPAD3KzEWw2nXLAAAAAElFTkSuQmCC',
			'AC90' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB0YQxlCGVqRxVgDWBsdHR2mOiCJiUwRaXBtCAgIQBILaBVpYG0IdBBBcl/U0mmrVmZGZk1Dch9IHUMIXB0YhoaCeKhiIHWOGHZguiWgFdPNAxV+VIRY3AcAFODNMnok59YAAAAASUVORK5CYII=',
			'4495' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpI37pjC0MoQyhgYgi4UwTGV0dHRAVscYwhDK2hCIIsY6hdEVKObqgOS+adOWLl2ZGRkVheS+gCkirQwhAQ0iSHpDQ0VDHRpQxUBuYQTagSHm6BAQgCbGEMow1WEwhB/1IBb3AQD/gcrE87xcGwAAAABJRU5ErkJggg==',
			'A9C3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7GB0YQxhCHUIdkMRYA1hbGR0CHQKQxESmiDS6Ngg0iCCJBbSCxIA0kvuili5dmrpq1dIsJPcFtDIGIqkDw9BQBrBeVPNYsNiB6RageRhuHqjwoyLE4j4An9zNmsqobTMAAAAASUVORK5CYII=',
			'2C17' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQxmmMIaGIImJTGFtdAgB0khiAa0iDY5oYgxAMYYpQDlk902bBsSrVmYhuy8ArK4V2V5GB7DYFBS3AE13mMIQgCwm0gB0yxRGB2Sx0FBGIHREERuo8KMixOI+AFN/y1MOvExZAAAAAElFTkSuQmCC',
			'E544' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkNEQxkaHRoCkMQCGkQaGFodGjHEpjq0oomFMAQ6TAlAcl9o1NSlKzOzoqKQ3AeUb3RtdHRA1QsUCw0MDUE1r9EBwy2srejuCw1hDEEXG6jwoyLE4j4AJUfQOs9IfCQAAAAASUVORK5CYII=',
			'59C7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7QkMYQxhCHUNDkMQCGlhbGR0CGkRQxEQaXRsEUMQCA0BiIDmE+8KmLV2aumrVyixk97UyBgLVtaLY3MoA0jsFWSyglQVkRwCymMgUkFsCHZDFWAPAbkYRG6jwoyLE4j4ApH/MJSoPIRQAAAAASUVORK5CYII=',
			'ACC3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7GB0YQxlCHUIdkMRYA1gbHR0CHQKQxESmiDS4Ngg0iCCJBbSKNLCCaCT3RS2dtmrpqlVLs5Dch6YODENDIWLo5mHagemWgFZMNw9U+FERYnEfAAN1zezIamzqAAAAAElFTkSuQmCC'        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: 
            $ctype="application/x-download";
    }
                                            

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>