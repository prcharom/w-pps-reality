<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Nemovitosti/vypis.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0845455117', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb3cf187cbd1_titulek')) { function _lb3cf187cbd1_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Přehled nemovitostí
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lba5676236cb_navigace')) { function _lba5676236cb_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> »<?php } ?>

<?php if ($id == 1) { ?>
        Nemovitosti, které čekají na zahájení aukce 
<?php } elseif ($id == 2) { ?>
        Nemovitosti, u kterých aukce již proběhla
<?php } elseif ($id == 4) { ?>
        Nemovitosti, které jsou určeny k prodeji
<?php } elseif ($id == 5) { ?>
        Nemovitosti, které již byly prodány
<?php } else { ?>
                Nemovitosti, u kterých aukce právě probíhá    
<?php } 
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb93cc08b208_content')) { function _lb93cc08b208_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="boxes">
<?php ob_start() ;$iterations = 0; foreach ($nemovitosti as $nemovitost) { ?>
        <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
        	 
<?php if (isset($nemovitost->related('photo.id_property')->fetch()->name)) { ?>
        		url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
        		url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/default.jpg);
<?php } ?>
         	background-position: 50% 0%; background-size: auto 155px; background-repeat: no-repeat;" class="detail">
            <div class="detail-popis">
                <h2>
                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($nemovitost->nazev, 23), ENT_NOQUOTES) ?>

                </h2>
                <p class="adresa"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($nemovitost->adresa, 32), ENT_NOQUOTES) ?></p>
            </div>
	    </div>   
<?php $iterations++; } ob_start() ?>
            <p class="info">Momentálně nejsou k dispozici žádné nemovitosti.</p>
<?php if (isset($nemovitost)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbba03e5b32e_head')) { function _lbba03e5b32e_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    .boxes { display: inline-block; margin: 0 -0.5em; padding: 0 3%; height:100%; width: 883px;}
    .boxes div.detail { 
        width: 202px;
        height: 202px;
        vertical-align: top; 
        display: inline-block;
        background: #FFF; 
        margin: 0.5em 1.9% 0.5em 0;   
        border: 1px solid #e6e6e6; 
        border-radius: 10px; 
        overflow: hidden;
        cursor: pointer;
    }
    .boxes div.detail-popis { 
        display: inline-block;
        width: 202px;
        height: 50px;
        margin: 152px 0 0 0;
        background: #fff;
        border: 0;
        border-radius: 0 0 10px 10px;
        overflow: hidden;
    }
    .boxes div.detail:hover, .boxes div.detail:hover div.detail-popis, .boxes div.detail:hover div.detail-popis h2 { 
        background: #333;
        color: #fff;
    }
    .boxes div.detail:hover, .boxes div.detail-popis {
    	border-color: #333;
    }
    .boxes div.detail div.detail-popis h2 a { 
        background: transparent;
        color: #555;
    }
    .boxes div.info { display: block; width: 100%; height: auto; color: #fff; background-color: rgb(102,123,180); border-color: #285e8e; }
    .boxes h2 { text-align: left; margin: 3px 5px 0.5em 5px; font-size: 105%; font-weight: normal; overflow: hidden; }
    .boxes h3 { display: block; clear: both; text-align: left; margin: 0 5px; font-size: 90%; font-weight: normal; }
    .boxes img { width: 100%; margin: 0; }
    .boxes p { clear: both; margin: 0 5px 0.5em 5px; }
    .boxes p.adresa { font-size: 80%; }
    .boxes p.info { margin: 1em auto; text-align: center;}
    .boxes p a { color: #006aeb; background: #f7f7f7; padding: 1px 3px; border-radius: 3px; text-decoration: none; box-shadow: 0 2px 5px rgba(0, 0, 0, .10); }
    .boxes p a:hover, .boxes p a:active, .boxes p a:focus { color: white; background-color: #006aeb; }
    .boxes > div:nth-child(4n) { margin: 0.5em 0; }
    @media (max-width: 700px) {
	.boxes > div { float: none; width: auto; margin: 0 0 1.1em; min-height: 0; }
	.boxes h2, .boxes p { margin: 0 0.5em; }
	.boxes > div:nth-child(3n - 2) img { margin: -1em 0 0 -1em; }
    }
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