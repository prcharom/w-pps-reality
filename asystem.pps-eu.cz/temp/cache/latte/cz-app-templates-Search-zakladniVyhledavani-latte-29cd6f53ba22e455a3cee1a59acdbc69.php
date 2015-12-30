<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Search/zakladniVyhledavani.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3012866692', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb202b3fc625_titulek')) { function _lb202b3fc625_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Vyhledávání nemovitostí
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb32ee37f273_navigace')) { function _lb32ee37f273_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> »<?php } ?> Vyhledávání nemovitostí
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb53018069b6_content')) { function _lb53018069b6_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;ob_start() ;ob_start() ?>
        <div class="info">
            Hledaný výraz byl nalezen v nadpisu u těchto nemovitostí:
        </div>
        <div class="search-basic-boxes">
<?php $iterations = 0; foreach ($n_nemovitosti as $n_nemovitost) { ?>
        <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
             
<?php if (isset($n_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                url(../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($n_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($n_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                url(../images/auction/default.jpg);
<?php } ?>
            background-position: 50% 0%; background-size: auto 155px; background-repeat: no-repeat;" class="detail">
            <div class="detail-popis">
                <h2>
                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($n_nemovitost->nazev, 23), ENT_NOQUOTES) ?>

                </h2>
                <p class="adresa"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($n_nemovitost->adresa, 32), ENT_NOQUOTES) ?></p>
            </div>
        </div>   
<?php $iterations++; } ?>
        </div>
<?php if (isset($n_nemovitost)) ob_end_flush(); else ob_end_clean() ?>
    
<?php ob_start() ?>
        <div class="info">
            Hledaný výraz byl nalezen v popisu u těchto nemovitostí:
        </div>
        <div class="search-basic-boxes">
<?php $iterations = 0; foreach ($p_nemovitosti as $p_nemovitost) { ?>
        <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($p_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($p_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($p_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
             
<?php if (isset($p_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                url(../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($p_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($p_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                url(../images/auction/default.jpg);
<?php } ?>
            background-position: 50% 0%; background-size: auto 155px; background-repeat: no-repeat;" class="detail">
            <div class="detail-popis">
                <h2>
                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($p_nemovitost->nazev, 23), ENT_NOQUOTES) ?>

                </h2>
                <p class="adresa"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($p_nemovitost->adresa, 32), ENT_NOQUOTES) ?></p>
            </div>
        </div>   
<?php $iterations++; } ?>
        </div>
<?php if (isset($p_nemovitost)) ob_end_flush(); else ob_end_clean() ?>
    
<?php ob_start() ?>
        <div class="info">
            Hledaný výraz byl nalezen v adrese u těchto nemovitostí:
        </div>
        <div class="search-basic-boxes">
<?php $iterations = 0; foreach ($a_nemovitosti as $a_nemovitost) { ?>
        <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($a_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($a_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($a_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
             
<?php if (isset($a_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                url(../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($a_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($a_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                url(../images/auction/default.jpg);
<?php } ?>
            background-position: 50% 0%; background-size: auto 155px; background-repeat: no-repeat;" class="detail">
            <div class="detail-popis">
                <h2>
                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($a_nemovitost->nazev, 23), ENT_NOQUOTES) ?>

                </h2>
                <p class="adresa"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($a_nemovitost->adresa, 32), ENT_NOQUOTES) ?></p>
            </div>
        </div>   
<?php $iterations++; } ?>
        </div>
<?php if (isset($a_nemovitost)) ob_end_flush(); else ob_end_clean() ?>

<?php ob_start() ?>
        <div class="info">
            Hledaný výraz byl nalezen v id u těchto nemovitostí:
        </div>
        <div class="search-basic-boxes">
<?php $iterations = 0; foreach ($i_nemovitosti as $i_nemovitost) { ?>
        <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($i_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($i_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($i_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
             
<?php if (isset($i_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                url(../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($i_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($i_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                url(../images/auction/default.jpg);
<?php } ?>
            background-position: 50% 0%; background-size: auto 155px; background-repeat: no-repeat;" class="detail">
            <div class="detail-popis">
                <h2>
                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($i_nemovitost->nazev, 23), ENT_NOQUOTES) ?>

                </h2>
                <p class="adresa"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($i_nemovitost->adresa, 32), ENT_NOQUOTES) ?></p>
            </div>
        </div>   
<?php $iterations++; } ?>
        </div>
<?php if (isset($i_nemovitost)) ob_end_flush(); else ob_end_clean() ?>
    
<?php ob_start() ?>
        <div class="info">
            Hledaný výraz se nepodařilo nalézt. Nechcete využít naše <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Search:rozsireneVyhledavani", array(null, $q)), ENT_COMPAT) ?>
">rozšířené vyhledávání</a>?
        </div>
<?php if (isset($n_nemovitost) || isset($p_nemovitost) || isset($a_nemovitost) || isset($i_nemovitost)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } ?>

<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbe0e3b34bf7_head')) { function _lbe0e3b34bf7_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    .search-basic-boxes { display: inline-block; margin: 0 -0.5em; padding: 0 3%; height:100%; width: 883px;}
    .search-basic-boxes div.detail { 
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
    .search-basic-boxes div.detail-popis { 
        display: inline-block;
        width: 202px;
        height: 50px;
        margin: 152px 0 0 0;
        background: #fff;
        border: 0;
        border-radius: 0 0 10px 10px;
        overflow: hidden;
    }
    .search-basic-boxes div.detail:hover, .search-basic-boxes div.detail:hover div.detail-popis, .search-basic-boxes div.detail:hover div.detail-popis h2 { 
        background: #333;
        color: #fff;
    }
    .search-basic-boxes div.detail:hover, .search-basic-boxes div.detail-popis {
    	border-color: #333;
    }
    .search-basic-boxes div.detail div.detail-popis h2 a { 
        background: transparent;
        color: #555;
    }
    .search-basic-boxes div.info { display: block; width: 100%; height: auto; color: #fff; background-color: rgb(102,123,180); border-color: #285e8e; }
    .search-basic-boxes h2 { text-align: left; margin: 3px 5px 0.5em 5px; font-size: 105%; font-weight: normal; overflow: hidden; }
    .search-basic-boxes h3 { display: block; clear: both; text-align: left; margin: 0 5px; font-size: 90%; font-weight: normal; }
    .search-basic-boxes img { width: 100%; margin: 0; }
    .search-basic-boxes p { clear: both; margin: 0 5px 0.5em 5px; }
    .search-basic-boxes p.adresa { font-size: 80%; }
    .search-basic-boxes p.info { margin: 1em auto; text-align: center;}
    .search-basic-boxes p a { color: #006aeb; background: #f7f7f7; padding: 1px 3px; border-radius: 3px; text-decoration: none; box-shadow: 0 2px 5px rgba(0, 0, 0, .10); }
    .search-basic-boxes p a:hover, .search-basic-boxes p a:active, .search-basic-boxes p a:focus { color: white; background-color: #006aeb; }
    .search-basic-boxes > div:nth-child(4n) { margin: 0.5em 0; }
    @media (max-width: 700px) {
	.search-basic-boxes > div { float: none; width: auto; margin: 0 0 1.1em; min-height: 0; }
	.search-basic-boxes h2, .search-basic-boxes p { margin: 0 0.5em; }
	.search-basic-boxes > div:nth-child(3n - 2) img { margin: -1em 0 0 -1em; }
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