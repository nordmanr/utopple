<?php
/**
**
**
** @package    ISPmail_Admin
** @author     Ole Jungclaussen
** @version    0.9.0
**/
/**
** @public
**/
class EmailOverview {
// ########## PROPS PUBLIC
    /**
    **
    ** @type IspMailAdminApp
    **/
    public $App = false;
// ########## PROPS PROTECTED
// ########## PROPS PRIVATE
// ########## CONST/DEST
    public function __construct(IspMailAdminApp &$App)
    {
        $this->App  = &$App;
    }
    function __destruct()
    {
        
    }
// ########## METHOD PUBLIC
    /**
    **
    **
    ** @retval integer
    ** @returns !=0 on error
    **/
    public function setTitleAndHelp(HtmlPage &$Page)
    {
        $this->App->Page->setTitle('Overview');
        $this->App->Page->setHelp(
            '<div class="Heading">List of all Adresses handled by this mailserver</div>'
            .'<ul>'
              .'<li>TBD</li>'
              // .'<li>Create a domain: Enter Domain name and click "Create"</li>'
              // .'<li>Email accounts of a domain: Click on <img class="icon" src="./img/edit.png" alt="edit icon"/></li>'
              // .'<li>Delete a domain: Click on <img class="icon" src="./img/trash.png" alt="delete icon" /></li>'
              // .'<li><b>Note</b>: If you delete a domain, all email accounts and aliases associated with it <i>should</i> be deleted, too.'
                // .'This depends on wether you\'ve followed Haas\' instructions to the point and created the tables as InnoDB with all the constraints enabled.'
              // .'</li>'
            .'</ul>'
        );
        return(0);
    }
    /**
    **
    **
    ** @retval integer
    ** @returns !=0 on error
    **/
    public function processCmd()
    {
        $iErr = 0;
        
        if(!isset($this->App->aReqParam['cmd']));
        else switch($this->App->aReqParam['cmd']){
            case 'cmd_sort':
                if(!isset($this->App->aReqParam['sort']));
                else switch($this->App->aReqParam['sort']){
                    case 'su': $this->App->sOvrSort = 'sSrcUser ASC, sSrcDomain ASC, sTarUser ASC, sTarDomain ASC'; break;
                    case 'sd': $this->App->sOvrSort = 'sSrcDomain ASC, sSrcUser ASC, sTarUser ASC, sTarDomain ASC'; break;
                    case 'tu': $this->App->sOvrSort = 'sTarUser ASC, sTarDomain ASC, sSrcUser ASC, sSrcDomain ASC'; break;
                    case 'td': $this->App->sOvrSort = 'sTarDomain ASC, sTarUser ASC, sSrcUser ASC, sSrcDomain ASC'; break;
                }
                break;
        }
        return($iErr);
    }
    /**
    **
    **
    ** @retval integer
    ** @returns !=0 on error
    **/
    public function drawCreate(HtmlPage &$Page)
    {
        return(0);
    }
    /**
    **
    **
    ** @retval integer
    ** @returns !=0 on error
    **/
    public function drawList(HtmlPage &$Page)
    {
        $iErr = 0;
        $sHtml = '';
        
        if(0!=($iErr = $this->App->DB->query($rRslt,
            "SELECT"
            ." domain_id AS idSrcDomain"
            .",SUBSTR(email, 1, INSTR(email, '@')-1) AS sSrcUser"
            .",SUBSTR(email, INSTR(email, '@')+1) AS sSrcDomain"
            .",NULL AS sTarUser"
            .",NULL AS sTarDomain"
            .",NULL AS idTarUser"
            ." FROM `virtual_users`"
            ." UNION SELECT"
            ." alias.domain_id AS idTarDomain"
            .",SUBSTR(alias.source, 1, INSTR(alias.source, '@')-1) AS sSrcUser"
            .",SUBSTR(alias.source, INSTR(alias.source, '@')+1) AS sSrcDomain"
            .",SUBSTR(alias.destination, 1, INSTR(alias.destination, '@')-1) AS sTarUser"
            .",SUBSTR(alias.destination, INSTR(alias.destination, '@')+1) AS sTarDomain"
            .",user.id AS idTarUser"
            ." FROM `virtual_aliases` AS alias"
            ." LEFT JOIN `virtual_users` AS user ON(user.email=alias.destination)"
            ." ORDER BY ".$this->App->sOvrSort
        )));
        else if(0!=($iErr = $this->App->DB->getNumRows($nRows, $rRslt)));
        else if(0==$nRows) $sHtml .= '<tr class="" colspan="6"><td class="">No domains created yet.</td></tr>';
        else while(0==($iErr = $this->App->DB->fetchArray($aRow, $rRslt, MYSQLI_ASSOC)) && NULL!==$aRow){
            $bAccount = NULL==$aRow['sTarUser'];
            
            $sHtml .= 
              '<tr>'
                .'<td class="">'.$aRow['sSrcUser'].'</td>'
                .'<td class="">@'.$aRow['sSrcDomain'].'</td>'
            ;
            if($bAccount) $sHtml .= 
                '<td colspan="3"><i>account</i></td>'
                .'<td class="icon">'
                  .'<form action="'.$_SERVER['PHP_SELF'].'" method="POST">'
                    .'<input type="hidden" name="cmd" value="cmd_openPage" />'
                    .'<input type="hidden" name="spage" value="page_accounts" />'
                    .'<input type="hidden" name="iddomain" value="'.strval($aRow['idSrcDomain']).'" />'
                    .'<img class="icon" src="./img/edit.png" onClick="this.parentNode.submit();" alt="icon edit"/>'
                  .'</form>'
                .'</td>'
            ;
            else  $sHtml .= 
                '<td class=""><i>alias of</i></td>'
                .'<td class="">'.$aRow['sTarUser'].'</td>'
                .'<td class="">@'.$aRow['sTarDomain'].'</td>'
                .'<td class="icon">'
                  .'<form action="'.$_SERVER['PHP_SELF'].'" method="POST">'
                    .'<input type="hidden" name="cmd" value="cmd_openPage" />'
                    .'<input type="hidden" name="spage" value="page_aliases" />'
                    .'<input type="hidden" name="idaccount" value="'.strval($aRow['idTarUser']).'" />'
                    .'<img class="icon" src="./img/edit.png" onClick="this.parentNode.submit();" alt="icon edit"/>'
                  .'</form>'
                .'</td>'
              .'</tr>'
            ;
        }
        
        if(0!=$iErr);
        else if(0!=($iErr = $Page->addBody(
            '<h3>Adresses handled by this mailserver</h3>'
            .'<div class="DatabaseList">'
              .'<form action="'.$_SERVER['PHP_SELF'].'" name="Email_Overview_ListSort" method="POST">'
                .'<input type="hidden" name="cmd" value="cmd_sort" />'
                .'<input type="hidden" name="sort" value="su" />'
              .'</form>'
              .'<table class="DatabaseList">'
                .'<tr class="header">'
                  .'<th>User&nbsp;<img class="icon" src="./img/sortup.png"   onClick="document.forms.Email_Overview_ListSort.sort.value=\'su\'; document.forms.Email_Overview_ListSort.submit();" alt="icon sort" /></th>'
                  .'<th>Domain&nbsp;<img class="icon" src="./img/sortup.png" onClick="document.forms.Email_Overview_ListSort.sort.value=\'sd\'; document.forms.Email_Overview_ListSort.submit();" alt="icon sort" /></th>'
                  .'<th></th>'
                  .'<th>User&nbsp;<img class="icon" src="./img/sortup.png"   onClick="document.forms.Email_Overview_ListSort.sort.value=\'tu\'; document.forms.Email_Overview_ListSort.submit();" alt="icon sort" /></th>'
                  .'<th>Domain&nbsp;<img class="icon" src="./img/sortup.png" onClick="document.forms.Email_Overview_ListSort.sort.value=\'td\'; document.forms.Email_Overview_ListSort.submit();" alt="icon sort" /></th>'
                  .'<th></th>'
                .'</tr>'
                .$sHtml
              .'</table>'
            .'</div>'
        )));
        
        return($iErr);
    }
// ########## METHOD PROTECTED
// ########## METHOD PRIVATE
};
?>