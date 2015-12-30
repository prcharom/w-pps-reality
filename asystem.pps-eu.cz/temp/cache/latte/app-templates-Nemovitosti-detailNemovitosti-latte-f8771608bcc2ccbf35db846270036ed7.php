<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Nemovitosti/detailNemovitosti.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4989582007', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbb8f4f388d4_titulek')) { function _lbb8f4f388d4_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Detail nemovitosti
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb499abc2133_navigace')) { function _lb499abc2133_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> » <?php } ?>

<?php if ($nemovitost->mod == 2) { ?>
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(4)), ENT_COMPAT) ?>
">Nemovitosti, které jsou určeny k prodeji</a>
<?php } elseif ($nemovitost->mod == 3) { ?>
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(5)), ENT_COMPAT) ?>
">Nemovitosti, které již byly prodány</a>
<?php } else { if ($status == 1) { ?>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(1)), ENT_COMPAT) ?>
">Nemovitosti, které čekají na zahájení aukce</a>
<?php } elseif ($status == 2) { ?>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(2)), ENT_COMPAT) ?>
">Nemovitosti, u kterých aukce již proběhla</a>
<?php } else { ?>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(3)), ENT_COMPAT) ?>
">Nemovitosti, u kterých aukce právě probíhá</a>
<?php } ?>
    <?php } ?> » <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->typ->typ, ENT_NOQUOTES) ?>
 <?php if ($nemovitost->is_public == 0) { ?> <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypisNepublikovanych"), ENT_COMPAT) ?>
">(nepublikováno)</a><?php } ?>

<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb252a8ca011_content')) { function _lb252a8ca011_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($user->isAllowed('adminMenu')) { ?><div class="box-admin-menu">
    <div class="adminmenu">
        <ul>
            <li>
                <a href="#">Akce s fotogalerií</a>
                <ul>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Foto:upload", array($nemovitost->id)), ENT_COMPAT) ?>
">Nahrát fotografie</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Foto:nastavHlavniFoto", array($nemovitost->id)), ENT_COMPAT) ?>
">Nastavit hlavní foto</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Foto:smazat", array($nemovitost->id)), ENT_COMPAT) ?>
">Mazat fotografie</a></li>
                </ul>
            </li>
             <li>
                <a href="#">Akce s PDF soubory</a>
                <ul>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("File:upload", array($nemovitost->id)), ENT_COMPAT) ?>
">Nahrát nové</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("File:vypis", array($nemovitost->id)), ENT_COMPAT) ?>
">Výpis a správa nahraných souborů</a></li>
                </ul>
            </li>
<?php if ($nemovitost->mod == 1) { ?>            <li>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Aukce:vypisHistorieAukce", array($nemovitost->id)), ENT_COMPAT) ?>
">Výpis historie aukce</a>
            </li>
<?php } ?>
            <li>
                <a href="#">Akce s nemovitostmi</a>
                <ul>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("upravitNemovitost", array($nemovitost->id)), ENT_COMPAT) ?>
">Upravit nemovitost</a></li>
                    <li><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("smazatNemovitost", array($nemovitost->id)), ENT_COMPAT) ?>
">Smazat nemovitost</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<?php } if ($user->isAllowed('adminMenu')&&$nemovitost->admin_description!='') { ?><div class="info">
<b>Poznámka administrátora.</b> <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->admin_description, ENT_NOQUOTES) ?>

</div>
<?php } Tracy\Debugger::barDump(array('$nemovitost->typ->typ' => $nemovitost->typ->typ), "Template " . str_replace(dirname(dirname($template->getName())), "\xE2\x80\xA6", $template->getName())) ?>
<div class="box-left">
    <h2>
        <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_NOQUOTES) ?>

    </h2>
    <div>
        <h3>ID nemovitosti:</h3>
        <p><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->idn, ENT_NOQUOTES) ?></p>
    </div>
    <div>
        <h3>Stav:</h3>
        <p><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->status, ENT_NOQUOTES) ?></p>
    </div>
    <div>
        <h3>Adresa nemovitosti:</h3>
        <p><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->adresa, ENT_NOQUOTES) ?></p>
    </div>
    <div>
        <h3>Popis nemovitosti:</h3>
        <p><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->popis, ENT_NOQUOTES) ?></p>
    </div>
<?php if ($nemovitost->mod < 2) { ?>
    <div class="inline">
        <div>
            <h3>Aktuální cena nemovitosti:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($template->number($drazba['cena']), ENT_NOQUOTES) ?> Kč 
<?php if ($status == 3) { ?>
                    <?php if ($user->isAllowed('drazba','prihodit')&&($nemovitost->id == $user->identity->id_nemovitost)) { ?>
                    <a class="btn btn-default button" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Aukce:prihodit", array($nemovitost->id)), ENT_COMPAT) ?>
">
                        Přihodit
                    </a>
<?php } } ?>
            </p>               
        </div>
        <div>
            <h3>Poznámka k ceně:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->price_description, ENT_NOQUOTES) ?></p>               
        </div>
        <div>
            <h3>Nejvyšší nabídka od:</h3> 
            <p>
<?php if ($user->isAllowed('zajemce','zobrazit')&&$drazba['nick']!=null) { ?>
                    <a class="ref-profil" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:vizitka", array($drazba['id'])), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($drazba['nick'], ENT_NOQUOTES) ?></a>
<?php } else { ?>
                    <?php echo Latte\Runtime\Filters::escapeHtml($drazba['nick'], ENT_NOQUOTES) ?>

<?php } ?>
            </p>
        </div>
    </div>
    <div class="inline">
        <div>
            <h3>Datum zahájení aukce:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($template->date($nemovitost->datum_zacatek, 'j.n.Y'), ENT_NOQUOTES) ?></p>
        </div>
        <div>
            <h3>Čas zahájení aukce:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($template->date($nemovitost->datum_zacatek, 'H:i'), ENT_NOQUOTES) ?></p>
        </div>
    </div>
    <div class="inline">
        <div>
            <h3>Datum ukončení aukce:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($template->date($nemovitost->datum_konec, 'j.n.Y'), ENT_NOQUOTES) ?></p>
        </div>
        <div>
            <h3>Čas ukončení aukce:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($template->date($nemovitost->datum_konec, 'H:i'), ENT_NOQUOTES) ?></p>
        </div>
    </div>
<?php } else { ?>
    <div class="inline">
        <div>
            <h3>Cena nemovitosti:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($template->number($nemovitost->pocatecni_cena), ENT_NOQUOTES) ?> Kč</p>               
        </div>
        <div>
            <h3>Poznámka k ceně:</h3> 
            <p><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->price_description, ENT_NOQUOTES) ?></p>               
        </div>
    </div>
<?php } ?>
</div>
<div class="box-right">

<?php if (isset($hlavni_fotka->name)) { ?>
    <div id="main-photo" class="main-photo" photo-id="0">
                <div>
            <img src="../../images/icons/mix/zoom.png">
            <span>Zobrazit plnou velikost</span>
        </div>
                <img src="../../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($hlavni_fotka->id_property), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($hlavni_fotka->name), ENT_COMPAT) ?>">
<?php } else { ?>
    <div class="main-photo" photo-id="0">
        <img src="../../images/auction/default.jpg">
<?php } ?>
    </div>
    <div class="miniatures">
<?php $index = 0 ;$iterations = 0; foreach ($fotky as $fotka) { ?>
            <span href="../../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($fotka->id_property), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($fotka->name), ENT_COMPAT) ?>
" data-lightbox="photogallery" photo-id="<?php echo Latte\Runtime\Filters::escapeHtml($index++, ENT_COMPAT) ?>">
            	<img src="../../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($fotka->id_property), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($fotka->name), ENT_COMPAT) ?>">  
            </span>  
<?php $iterations++; } ?>
    </div>

    <div class="pdfs">
    	<h3>Přiložené PDF soubory:</h3>
<?php ob_start() ?>
    	 <ul>
<?php $iterations = 0; foreach ($files as $file) { ?>
            	<li>
            		<a href="../../files/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->id_property), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->hid_name), ENT_COMPAT) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->timestamp), ENT_COMPAT) ?>
.<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->type), ENT_COMPAT) ?>" target="_blank">
            			<img src="../../images/icons/pdf.jpg" height="18">    
            			<?php echo Latte\Runtime\Filters::escapeHtml($file->name, ENT_NOQUOTES) ?>
 (.<?php echo Latte\Runtime\Filters::escapeHtml($file->type, ENT_NOQUOTES) ?>, <?php echo Latte\Runtime\Filters::escapeHtml($file->size, ENT_NOQUOTES) ?> MB)
            		</a>  
            	</li>
<?php $iterations++; } ?>
         </ul>
<?php ob_start() ?>
        	<span>Nejsou k dispozici, žádné PDF soubory.</span>
<?php if (isset($file)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } ?>
    </div>

    <div class="contact">
        <h3>Kontaktní osoba:</h3>
        <div>
            <p>
                <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->uzivatel->jmeno, ENT_NOQUOTES) ?><br>
            </p>
            <p>
                <a href="mailto:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($nemovitost->uzivatel->email), ENT_COMPAT) ?>">
                    <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->uzivatel->email, ENT_NOQUOTES) ?>

                </a>
            </p>
            <p>
                <a href="tel:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($template->replace($template->strip($nemovitost->uzivatel->telefon), ' ', '')), ENT_COMPAT) ?>">
                    <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->uzivatel->telefon, ENT_NOQUOTES) ?>

                </a>
            </p>
        </div>
    </div>
</div>
<div class="box-bottom">
    <iframe width="100%" height="400" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFNdFUtRnkm7hvikG-jOHUQZGWorUtxOA&q=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($template->replace($template->strip($nemovitost->adresa), ' ', '+')), ENT_COMPAT) ?>">
    </iframe>
</div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbc72a3c5429_head')) { function _lbc72a3c5429_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    a { color: #555; text-decoration: none;}
    a:hover { color: #555; text-decoration: none; background: transparent;}
    div.info { margin-bottom: 2em;}
    div.flash { margin-bottom: 1em;}
    div.box-right { 
        margin: 0;  
        padding: 0; 
        overflow: hidden;
        width: 40%;
        text-align: center;
    }
    div.box-right .contact > div { margin: 1em 0; padding: 0; }
    div.box-right .contact > div p { margin: 0; padding: 0;}
    div.box-right .contact { margin: 1em 2em 1em 0;}
    div.box-right .pdfs { 
    	margin: 1em 2em 1em 0;
    	padding: 0;
    }
    div.box-right .pdfs span { margin: 0; padding: 0; display: block; text-align: left;}
    div.box-right .pdfs ul li a, div.box-right .pdfs span { color: #999; font-size: 90%;}
    div.box-right .pdfs ul { margin: 0; padding: 0;}
    div.box-right .pdfs ul li { margin: 0; padding: 5px 7px; list-style-type: none; height: 22px; vertical-align: middle; text-align: left;}
    div.box-right .pdfs ul li img { margin-bottom: -4px;}
    div.box-right .contact h3, div.box-right .pdfs h3 { color: #1e5eb6; font-weight: normal; margin: 0; padding: 0; font-size: 1em; text-align: left;}
    div.box-right .main-photo { margin: 0 2em 0 0; padding: 0;}
    div.box-right .main-photo > img { width: 100%;}
    div.box-right #main-photo img, div.box-right .main-photo > div { cursor: pointer;}
    div.box-right .main-photo > div {
        height: 28px; 
        margin: 0;
        padding: 4px 0 0 0;
        position: absolute;
        background-color: #ffffff; 
        opacity: 0.9;
        filter: alpha(opacity=90); /* For IE8 and earlier */
        -webkit-border-bottom-right-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        border-bottom-right-radius: 5px;
    }
    div.box-right .main-photo > div span { margin: 0; padding: 0 8px 0 2px; display: none;}
    div.box-right .main-photo > div > img { float: left; margin: -4px 0 0 0;}
    div.box-right .miniatures { margin: 0 2em 0 0; padding: 0; text-align: left;}
    div.box-right .miniatures img { width: 23.85%; cursor: pointer;}
    div.box-right .miniatures a, div.box-right .main-photo a, div.box-right .miniatures a:hover, div.box-right .main-photo a:hover, div.box-right .miniatures a:active, div.box-right .main-photo a:active { padding: 0; margin: 0; border: 0; background: transparent;} 
    div.box-right .map { margin: 0 2em 0 0; padding: 0;}
    div.box-left { 
        margin: 0;  
        padding: 0; 
        overflow: hidden;
        width: 60%;
        text-align: left;
        float: left;
    }
    div.box-left h2 { margin: 1em; padding: 0; font-size: 1.7em;}
    div.box-left h3, div.box-left p { margin: 0 1em; padding: 0; font-size: 1em;}
    div.box-left h3 { color: #1e5eb6; font-weight: normal;}
    div.box-left > div { margin: 1em;}
    div.box-left div.inline { display: block;}
    div.box-left div.inline h3 { display: inline-block; width: 40%;}
    div.box-left div.inline p { display: inline-block; text-align: left;}
    div.box-left div.inline a.btn { text-decoration: none; position: absolute; margin-left: 167px; margin-top: -17px;}
    div.box-admin-menu { 
        clear: both;
        margin: 0 0 1em 0;  
        padding: 0; 
        overflow: visible;
        text-align: center;
    }
    div.box-bottom {
        clear: both; 
        margin: 0 -0.5em;  
        padding: 0; 
        
        text-align: right;
    }  
    .adminmenu ul, .adminmenu li, .adminmenu span, .adminmenu a { margin: 0; padding: 0; position: relative; }
    .adminmenu {
        z-index: 100;
        display: inline-block;
        width: auto;
        line-height: 1;
        background: #141414;
        background: -moz-linear-gradient(top, #333333 0%, #141414 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #333333), color-stop(100%, #141414));
        background: -webkit-linear-gradient(top, #333333 0%, #141414 100%);
        background: -o-linear-gradient(top, #333333 0%, #141414 100%);
        background: -ms-linear-gradient(top, #333333 0%, #141414 100%);
        background: linear-gradient(to bottom, #333333 0%, #141414 100%);
        margin: 1em auto;
        padding: 0;
        border-radius: 6px;
    }
    .adminmenu a {
        background: #141414;
        background: -moz-linear-gradient(top, #333333 0%, #141414 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #333333), color-stop(100%, #141414));
        background: -webkit-linear-gradient(top, #333333 0%, #141414 100%);
        background: -o-linear-gradient(top, #333333 0%, #141414 100%);
        background: -ms-linear-gradient(top, #333333 0%, #141414 100%);
        background: linear-gradient(to bottom, #333333 0%, #141414 100%);
        color: #ffffff;
        display: inline-block;
        padding: 6px 12px;
        text-decoration: none;
    }
    .adminmenu a:hover { background: rgb(102,123,180); }
    .adminmenu ul { list-style: none; }
    .adminmenu > ul > li { display: inline-block; margin: 0; }
    .adminmenu > ul > li > a, .adminmenu ul ul li a { color: #ffffff; font-size: 12px; }
    .adminmenu > ul > li:first-child > a { border-radius: 6px 0 0 6px; }
    .adminmenu > ul > li:last-child > a { border-radius: 0 6px 6px 0; }
    .adminmenu ul li ul { position: absolute; display: none; border-radius: 6px; margin: 1px 0 0 0;}
    .adminmenu ul li:hover ul { display: block;}
    .adminmenu ul ul li a { width: 100%; text-align: left;}
    .adminmenu ul ul li:first-child a { border-radius: 6px 6px 0 0;}
    .adminmenu ul ul li:last-child a { border-radius: 0 0 6px 6px;}
</style>
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
if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['titulek']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['navigace']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars()) ; 