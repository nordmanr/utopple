<?php
/**
**
**
** @package    ISPmail_Admin
** @author     Ole Jungclaussen
** @version    0.9.0
**/
namespace lib;
/**
**
**
** @retval mixed
** @returns sanitized param
**/
function sanitizeParam($mParam)
{
    $mParam = urldecode($mParam);
    $mParam = htmlentities($mParam);
    if(get_magic_quotes_gpc()) $mParam = stripslashes($mParam);
    return($mParam);
}
/**
** 
** 
** @retval integer
** @returns !=0 on error
**/
function verifyParam(&$bOk, $sIdParam, $sType, $sTest=false)
{
    global $App;
    $iErr    = 0;
    $bOk     = false;

    if(!isset($App->aReqParam[$sIdParam]));
    else switch($sType){
        case 'number':
            if(is_integer($App->aReqParam[$sIdParam]) || is_float($App->aReqParam[$sIdParam])) $bOk = true;
            else if(is_string($App->aReqParam[$sIdParam]) && is_numeric($App->aReqParam[$sIdParam])) $bOk = true;
            break;
        case 'string':
            $App->aReqParam[$sIdParam] = strval($App->aReqParam[$sIdParam]);
            $bOk = true;
            break;
        case 'array':
            if(!is_string($App->aReqParam[$sIdParam]));
            else if(!preg_match('/^a:[0-9]+:\{/', $App->aReqParam[$sIdParam]));
            else if(!is_array(@unserialize($App->aReqParam[$sIdParam])));
            else $bOk = true;
            break;
        default:
            lib\ErrLog::getInstance()->push(__FUNCTION__.": unsupported parameter type[".$sType."]");
            $iErr = 1; // unsupported check parameter type
            break;
            
    }
    
    if($bOk && false!==$sTest){
        $bOk = false;
        if(false===@eval('$bOk = ('.str_replace('$$$', '$App->aReqParam[$sIdParam]', $sTest).');')){
            lib\ErrLog::getInstance()->push(__FUNCTION__.": eval failure");
            $iErr=1; // eval failure
        }
    }

    return($iErr);
}
/**
** @public
**/
class ErrLog {
// ########## PROPS PUBLIC
// ########## PROPS PROTECTED
// ########## PROPS PRIVATE
    /**
    **
    ** @type object $Instance
    **/
    private static $Instance;
    /**
    ** @type string $sLogFile
    **/
    private $sLog = '';
// ########## CONST/DEST
    function __construct()
    {
    }
    /**
    **
    **/
    function __destruct()
    {
    }
// ########## METHOD PUBLIC
    /**
    ** Singleton: returns instance.
    **
    ** @retval object
    ** @returns Instance of this class
    **/
    public static function getInstance()
    {
        if(!self::$Instance) self::$Instance = new self();
        return(self::$Instance);
    }
    /**
    **
    **
    ** @retval integer
    ** @returns !=0 on error
    **/
    public function hasError()
    {
        return(0!=strlen($this->sLog));
    }
    /**
    ** Pushes an error on the error Log.
    ** @param int     $iIdErr    error ID
    ** @param string  $sText     error description
    ** @return int
    ** @returns always 0
    **/
    public function push($sTxt="")
    {
        return($this->writeToLog($sTxt));
    }
    /**
    ** Read the Error Log.
    ** @param string $sLog  Receives Log
    ** @return string
    ** @returns content of errorLog
    **/
    public function getLog(&$sLog)
    {
        $sLog = $this->sLog;
        return(0);
    }
    /**
    ** Read and Clear the Error Log.
    ** @param string $sLog  Receives Log
    ** @return int
    ** @returns always 0
    **/
    public function getAndClearLog(&$sLog)
    {
        $sLog = $this->sLog;
        return($this->deleteLog());
    }
    /**
    ** Clears the error Log.
    ** @return int
    ** @returns always 0
    **/
    public function clearLog()
    {
        return($this->deleteLog());
    }
    /**
    ** Format string indented.
    ** @param string $sTxt
    ** return string
    ** returns $sText with one tab indented
    **/
    public static function indentText($sTxt)
    {
        return("\t".preg_replace("/([\r\n]+)/","\\1\t", $sTxt));
    }
// ########## METHOD PROTECTED
// ########## METHOD PRIVATE
    /**
    ** Pushes an error on the error Log.
    ** @param string $sTxt
    ** @return int
    ** @returns 0 on success !0 on error
    **/
    private function writeToLog($sTxt="")
    {
        $this->sLog .= $sTxt;
        return(0);
    }
    /**
    ** Delete the Log file.
    ** @return int
    ** @returns always 0
    **/
    private function deleteLog()
    {
        $this->sLog = '';
        return(0);
    }
};
?>