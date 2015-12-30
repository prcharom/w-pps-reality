<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/@layout.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5505929571', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbcaa320a39f_head')) { function _lbcaa320a39f_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lbcd312c839a_scripts')) { function _lbcd312c839a_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/knihovny/jquery-1.11.0.min.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/lightbox.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/knihovny/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/knihovny/jQueryRotateCompressed.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.nette.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.functions.js"></script>
        <script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/jquery.datetimepicker.js"></script>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title><?php if (isset($_b->blocks["titulek"])) { ob_start(); Latte\Macros\BlockMacros::callBlock($_b, 'titulek', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>Podnikatelský poradenský servis</title>

    <link rel="shortcut icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/favicon.ico">
    <link rel="stylesheet" media="screen,projection,tv" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/screen.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/jquery.datetimepicker.css">
    <link rel="stylesheet" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/lightbox.css">
    <?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>

<body>
    <script> document.documentElement.className+=' js' </script>

    <div id="banner">
        <span class="search">
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["basicSearchForm"], array()) ?>
            <table>
                <tr>
                    <td><?php echo $_form["search"]->getControl() ?></td>
                    <td><?php echo $_form["send"]->getControl() ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Search:rozsireneVyhledavani"), ENT_COMPAT) ?>
">
                            Přejít k rozšířenému vyhledávání?
                        </a>
                    </td>
                </tr>
            </table>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
        </span>
        <img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/images/logo/logo.png">
        <h2>Prodej a aukce<br> nemovitostí</h2>
    </div>
    
    <div id="cssmenu">
        <ul>
        	<li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:default"), ENT_COMPAT) ?>
"><span>Domů</span></a>
            </li>
            <li class='has-sub'>
                <a href="#"><span>Nemovitosti k prodeji</span></a>
                <ul>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(4)), ENT_COMPAT) ?>
"><span>Nemovitosti, které jsou určeny k prodeji</span></a>
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(5)), ENT_COMPAT) ?>
"><span>Nemovitosti, které již byly prodány</span></a>
                    </li>
                </ul>
            </li>
            <li class='has-sub'>
                <a href="#"><span>Nemovitosti k aukci</span></a>
                <ul>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(1)), ENT_COMPAT) ?>
"><span>Nemovitosti, které čekají na zahájení aukce</span></a>
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(3)), ENT_COMPAT) ?>
"><span>Nemovitosti, u kterých aukce právě probíhá</span></a>
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(2)), ENT_COMPAT) ?>
"><span>Nemovitosti, u kterých aukce již proběhla</span></a>
                    </li>
                </ul>
            </li>
<?php if ($user->isAllowed('adminMenu')) { ?>
            <li class='has-sub'>
                <a href="#"><span>Admin menu</span></a>
                <ul>
		            <li>
		                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:pridatNemovitost"), ENT_COMPAT) ?>
"><span>Vytvořit novou nemovitost</span></a>
		            </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypisNepublikovanych"), ENT_COMPAT) ?>
"><span>Výpis nepublikovaných nemovitostí</span></a>
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:pridatZajemce"), ENT_COMPAT) ?>
"><span>Vytvořit nový účet zájemce</span></a> 
                    </li>
		            <li>
		                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:zajemci"), ENT_COMPAT) ?>
"><span>Výpis a správa účtů zájemců</span></a> 
		            </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:upravitKontakt"), ENT_COMPAT) ?>
"><span>Upravit kontakt</span></a> 
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:upravitPodminky"), ENT_COMPAT) ?>
"><span>Upravit podmínky</span></a> 
                    </li>
                    <li>
                        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:upravitDomu"), ENT_COMPAT) ?>
"><span>Upravit domovskou stránku</span></a> 
                    </li>
		         </ul>
		     </li>
<?php } ?>
            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:podminky"), ENT_COMPAT) ?>
">Podmínky</a>
            </li>
            <li>
            	<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:kontakt"), ENT_COMPAT) ?>
">Kontakt</a>
            </li>
<?php if ($user->loggedIn) { ?>
                <li class="has-sub logged" >
                    <a href="#"><img class="menuimg" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/icons/mix/loggin.png"> <?php echo Latte\Runtime\Filters::escapeHtml($user->identity->nick, ENT_NOQUOTES) ?></a>
                    <ul>
<?php if (isset($user->identity->id_nemovitost)) { ?>                        <li>
                            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($user->identity->id_nemovitost)), ENT_COMPAT) ?>
">
                                <span>Přejít na přidělenou nemovitost k aukci</span>
                            </a>
                        </li>
<?php } ?>
                        <li>
                            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:zmenitHeslo"), ENT_COMPAT) ?>
"><span>Změnit heslo k profilu</span></a>
                        </li>
                        <li>
                            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:upravitProfil"), ENT_COMPAT) ?>
"><span>Upravit informace o profilu</span></a>
                        </li>
                        <li>
                            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:out"), ENT_COMPAT) ?>
"><span>Odhlásit se</span></a>
                        </li>
                    </ul>
                </li>
<?php } else { ?>
                <li>
                    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Homepage:prihlaseni"), ENT_COMPAT) ?>
">Přihlásit se</a>
                </li>    
<?php } ?>
        </ul>
    </div>
        
    
    <div id="content"> 
        <div id="navigace"><?php Latte\Macros\BlockMacros::callBlock($_b, 'navigace', $template->getParameters()) ?></div>
<?php $iterations = 0; foreach ($flashes as $flash) { ?>        <div class="flash <?php echo Latte\Runtime\Filters::escapeHtml($flash->type, ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
        
<?php Latte\Macros\BlockMacros::callBlock($_b, 'content', $template->getParameters()) ?>

        <footer>© <?php echo Latte\Runtime\Filters::escapeHtml(date('Y'), ENT_NOQUOTES) ?> Podnikatelský poradenský servis s.r.o.</footer>
    </div>
    
<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars())  ?>
  
</body>
</html>