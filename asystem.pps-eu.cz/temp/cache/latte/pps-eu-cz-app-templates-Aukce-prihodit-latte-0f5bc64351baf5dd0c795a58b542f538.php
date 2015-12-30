<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Aukce/prihodit.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8432815966', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb06151f9f9b_titulek')) { function _lb06151f9f9b_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Dražba nemovitosti
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lba68ccec82a_navigace')) { function _lba68ccec82a_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> » <?php } ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(3)), ENT_COMPAT) ?>
">Nemovitosti, u kterých aukce právě probíhá</a> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($nemovitost->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_NOQUOTES) ?></a> » Přihodit
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbcbcbe9e89b_content')) { function _lbcbcbe9e89b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($pocet_prihozu > 0) { ?>
    <div class="info">
       Vložte částku, kterou chcete přihodit. Minimální přihazovaná částka je <span>5,000</span> Kč.
    </div>
    <div class="info mt">
        Nejvyšší nabídka je <span><?php echo Latte\Runtime\Filters::escapeHtml($template->number($drazba['cena']), ENT_NOQUOTES) ?>
</span> Kč od uživatele <span><?php echo Latte\Runtime\Filters::escapeHtml($drazba['nick'], ENT_NOQUOTES) ?></span>.
    </div>
    <div class="info mt c">
        Vaše nabídka: 
        <span id="money" money="<?php echo Latte\Runtime\Filters::escapeHtml($drazba['cena'], ENT_COMPAT) ?>">
            0  
        </span> Kč
    </div>
<?php $_l->tmp = $_control->getComponent("prihozForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} else { ?>
    <div class="info">
        Zatím nebyla podána žádná nabídka. Přejete si podat nabídku v hodnotě <span><?php echo Latte\Runtime\Filters::escapeHtml($template->number($drazba['cena']), ENT_NOQUOTES) ?></span> Kč.
    </div>
<?php $_l->tmp = $_control->getComponent("prvniPrihozForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;} 
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb4551631f3e_head')) { function _lb4551631f3e_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.c { text-align: center;}
    div.info span { color: #1e5eb6; font-weight: normal; margin: 0; padding: 0;}
    div.mt { margin-top: 0.5em; }
    div.flash { margin-bottom: 0.5em; }
    #frm-prihozForm, #frm-prihozForm table { margin: 1em auto; }
    #frm-prihozForm tr:first-child { display: none; }
    #frm-prihozForm tr:nth-child(2) { display: none; }
    #frm-prihozForm tr:nth-child(3) { display: none; }
    #frm-prihozForm tr th { width: 20%; text-align: right; padding: 6px; }
    #frm-prihozForm tr th label { font-weight: bold; }
    #frm-prihozForm tr td { width: 40%; text-align: left; }
    #frm-prihozForm tr td input, #frm-prihozForm tr td textarea {
        width: 55%; 
        text-align: left;
    }
    #frm-prihozForm tr td .button { width: auto; text-align: center; }
    #frm-prvniPrihozForm, #frm-prvniPrihozForm table { margin: 1em auto; }
    #frm-prvniPrihozForm tr:first-child { display: none; }
    #frm-prvniPrihozForm tr:nth-child(2) { display: none; }
    #frm-prvniPrihozForm tr:nth-child(3) { display: none; }
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