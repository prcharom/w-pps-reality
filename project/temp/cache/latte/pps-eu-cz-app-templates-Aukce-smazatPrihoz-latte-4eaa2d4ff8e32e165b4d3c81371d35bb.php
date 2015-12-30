<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Aukce/smazatPrihoz.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0580098416', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb443d33c4c1_titulek')) { function _lb443d33c4c1_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Mazání příhozu
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbe8d1ccda92_navigace')) { function _lbe8d1ccda92_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <a href="#">Administrátor</a> » <?php if ($status == 1) { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(1)), ENT_COMPAT) ?>
">Nemovitosti, které čekají na zahájení dražby</a><?php } elseif ($status == 2) { ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(2)), ENT_COMPAT) ?>
">Nemovitosti, u kterých dražba již proběhla</a><?php } else { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(3)), ENT_COMPAT) ?>
">Nemovitosti, u kterých dražba právě probíhá</a><?php } ?> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($prihoz->id_nemovitost)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($prihoz->nemovitost->nazev, ENT_NOQUOTES) ?>
</a> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Aukce:vypisHistorieAukce", array($prihoz->id_nemovitost)), ENT_COMPAT) ?>
">Výpis historie aukce</a> » Smazat příhoz
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb1d3be58942_content')) { function _lb1d3be58942_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="info">
        Opravdu chcete smazat příhoz od <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:vizitka", array($prihoz->uzivatel)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($prihoz->uzivatel->nick, ENT_NOQUOTES) ?>
</a> k <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($prihoz->nemovitost)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($prihoz->nemovitost->nazev, ENT_NOQUOTES) ?>
</a> z <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Aukce:vypisHistorieAukce", array($prihoz->nemovitost)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($prihoz->datum_vkladu, 'd.m.Y H:i'), ENT_NOQUOTES) ?></a> ?
<?php $_l->tmp = $_control->getComponent("deletePrihozForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb8e941d8dba_head')) { function _lb8e941d8dba_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    form table { width: auto; margin: 0; }
    form table tr:first-child { display: none; }
    form table th { display: none; }
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