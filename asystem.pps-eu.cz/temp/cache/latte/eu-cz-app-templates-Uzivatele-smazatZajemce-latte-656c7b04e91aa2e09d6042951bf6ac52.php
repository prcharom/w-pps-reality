<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Uzivatele/smazatZajemce.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8590578810', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbc684fc520f_titulek')) { function _lbc684fc520f_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Mazání účtů zájemců
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb9eaa4dbb02_navigace')) { function _lb9eaa4dbb02_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <a href="#">Administrátor</a> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:zajemci"), ENT_COMPAT) ?>
">Přehled zájemců</a> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:vizitka", array($zajemce->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($zajemce->jmeno, ENT_NOQUOTES) ?></a> » Smazat účet zájemce
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb4e6373a60d_content')) { function _lb4e6373a60d_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="info">
        Opravdu chcete smazat uživatele <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("vizitka", array($zajemce->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($zajemce->nick, ENT_NOQUOTES) ?></a> ? 
<?php $_l->tmp = $_control->getComponent("deleteUzivatelForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb602306050d_head')) { function _lb602306050d_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    form table { width: auto; margin: 0; }
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