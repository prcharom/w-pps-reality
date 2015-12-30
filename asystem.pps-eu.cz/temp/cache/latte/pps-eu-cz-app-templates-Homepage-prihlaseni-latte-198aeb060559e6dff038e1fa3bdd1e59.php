<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Homepage/prihlaseni.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1078425954', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbd31c0266bf_titulek')) { function _lbd31c0266bf_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Přihlášení
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb16a3f0c9e0_navigace')) { function _lb16a3f0c9e0_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Přihlášení
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lba743b97c21_content')) { function _lba743b97c21_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="login"> 
<?php $_l->tmp = $_control->getComponent("loginForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbd7525c7423_head')) { function _lbd7525c7423_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    #content table { margin: 1em auto; }
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