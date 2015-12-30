<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Search/rozsireneVyhledavani.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0687382561', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb34edd98542_titulek')) { function _lb34edd98542_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Vyhledávání nemovitostí
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb27c4c2da10_navigace')) { function _lb27c4c2da10_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> »<?php } ?> Rozšířené vyhledávání nemovitostí
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb4e85db356f_content')) { function _lb4e85db356f_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="search-main info">
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["searchForm"], array()) ?>
            <table>
                <tr>
                    <td colspan="2"><?php echo $_form["search"]->getControl() ?>
 <?php echo $_form["send"]->getControl() ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo $_form["t1"]->getControl() ?> <?php echo $_form["t2"]->getControl() ?>
 <?php echo $_form["t3"]->getControl() ?> <?php echo $_form["t4"]->getControl() ?>

                    </td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo $_form["s1"]->getControl() ?></td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo $_form["s2"]->getControl() ?></td>
                </tr>
                <tr>
                    <td colspan="2"><?php echo $_form["s3"]->getControl() ?></td>
                </tr>
                <tr>
                    <td>Minimální cena v Kč:<br> <?php echo $_form["min"]->getControl() ?></td>
                    <td>Maximální cena v Kč:<br> <?php echo $_form["max"]->getControl() ?></td>
                </tr>
            </table>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
    </div>
<?php if ($is_q == true) { ob_start() ;ob_start() ?>
            <div class="info">
                Hledaný výraz byl nalezen v nadpisu u těchto nemovitostí:
            </div>
            <div class="search-boxes">
<?php $iterations = 0; foreach ($n_nemovitosti as $n_nemovitost) { ?>
            <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
                 
<?php if (isset($n_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($n_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($n_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/default.jpg);
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
            <div class="search-boxes">
<?php $iterations = 0; foreach ($p_nemovitosti as $p_nemovitost) { ?>
            <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($p_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($p_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($p_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
                 
<?php if (isset($p_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($p_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($p_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/default.jpg);
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
            <div class="search-boxes">
<?php $iterations = 0; foreach ($a_nemovitosti as $a_nemovitost) { ?>
            <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($a_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($a_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($a_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
                 
<?php if (isset($a_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($a_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($a_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/default.jpg);
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
            <div class="search-boxes">
<?php $iterations = 0; foreach ($i_nemovitosti as $i_nemovitost) { ?>
            <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($i_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($i_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($i_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
                 
<?php if (isset($i_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($i_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($i_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/default.jpg);
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
                Hledaný výraz se dle Vámi zadaných kriterií nepodařilo nalézt. Je možné, že jste nevhodně nastavili parametry vyhledávání a nebo se hledaný výraz na webu nevyskytuje.
            </div>
<?php if (isset($n_nemovitost) || isset($p_nemovitost) || isset($a_nemovitost) || isset($i_nemovitost)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } } else { ob_start() ?>
            <div class="info">
                Dle zadaných kritérií se podařilo nalézt tyto nemovitosti:
            </div>
            <div class="search-boxes">
<?php $iterations = 0; foreach ($n_nemovitosti as $n_nemovitost) { ?>
            <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($n_nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
                 
<?php if (isset($n_nemovitost->related('photo.id_property')->fetch()->name)) { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($n_nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($n_nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
                    url(<?php if (isset($id) || $id != null) { ?>../<?php } ?>../images/auction/default.jpg);
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
<?php ob_start() ?>
            <div class="info">
                Dle zadaných kritérií se nepodařilo nalézt žádnou nemovitost. Změňte prosím parametry vyhledávání.
            </div>    
<?php if (isset($n_nemovitost)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } } ?>

<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb9152d6c6c8_head')) { function _lb9152d6c6c8_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.search-main {
        margin-bottom: 1em;
    }
    .search-main table {
        margin: auto;
        width: 400px;
    }
    .search-main input[type="submit"] {
        float: right;
        width: 25%;
    }
    .search-main table tr:nth-child(2) td {
        margin-bottom: 1em;
    }
    .search-main table tr:last-child td input {
        width: 120px;
    }
    .search-main table tr:first-child td input[type="text"] {
        width: 67%;
    }
    .search-boxes { display: inline-block; margin: 0 -0.5em; padding: 0 3%; height:100%; width: 883px;}
    .search-boxes div.detail { 
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
    .search-boxes div.detail-popis { 
        display: inline-block;
        width: 202px;
        height: 50px;
        margin: 152px 0 0 0;
        background: #fff;
        border: 0;
        border-radius: 0 0 10px 10px;
        overflow: hidden;
    }
    .search-boxes div.detail:hover, .search-boxes div.detail:hover div.detail-popis, .search-boxes div.detail:hover div.detail-popis h2 { 
        background: #333;
        color: #fff;
    }
    .search-boxes div.detail:hover, .search-boxes div.detail-popis {
    	border-color: #333;
    }
    .search-boxes div.detail div.detail-popis h2 a { 
        background: transparent;
        color: #555;
    }
    .search-boxes div.info { display: block; width: 100%; height: auto; color: #fff; background-color: rgb(102,123,180); border-color: #285e8e; }
    .search-boxes h2 { text-align: left; margin: 3px 5px 0.5em 5px; font-size: 105%; font-weight: normal; overflow: hidden; }
    .search-boxes h3 { display: block; clear: both; text-align: left; margin: 0 5px; font-size: 90%; font-weight: normal; }
    .search-boxes img { width: 100%; margin: 0; }
    .search-boxes p { clear: both; margin: 0 5px 0.5em 5px; }
    .search-boxes p.adresa { font-size: 80%; }
    .search-boxes p.info { margin: 1em auto; text-align: center;}
    .search-boxes p a { color: #006aeb; background: #f7f7f7; padding: 1px 3px; border-radius: 3px; text-decoration: none; box-shadow: 0 2px 5px rgba(0, 0, 0, .10); }
    .search-boxes p a:hover, .search-boxes p a:active, .search-boxes p a:focus { color: white; background-color: #006aeb; }
    .search-boxes > div:nth-child(4n) { margin: 0.5em 0; }
    @media (max-width: 700px) {
	.search-boxes > div { float: none; width: auto; margin: 0 0 1.1em; min-height: 0; }
	.search-boxes h2, .search-boxes p { margin: 0 0.5em; }
	.search-boxes > div:nth-child(3n - 2) img { margin: -1em 0 0 -1em; }
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