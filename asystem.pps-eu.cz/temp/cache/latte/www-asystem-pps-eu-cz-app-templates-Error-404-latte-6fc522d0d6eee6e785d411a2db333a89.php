<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Error/404.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8913503005', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block title
//
if (!function_exists($_b->blocks['title'][] = '_lbb61fdb5c55_title')) { function _lbb61fdb5c55_title($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Stránka nenalezena
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbd602d56464_navigace')) { function _lbd602d56464_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <a href="#">Error</a> » Stránka nenalezena
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb0589028da9_content')) { function _lb0589028da9_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><p class="error">Je nám líto, ale požadovaná stránka není k dispozici. 
    Je možné, že byla odstraněna, přejmenována nebo není dočasně dostupná. Je rovněž možné, 
    že jste udělali chybu v URL adrese.</p>

<p class="error"><small>error 4O4</small></p>
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
call_user_func(reset($_b->blocks['title']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['navigace']), $_b, get_defined_vars())  ?>

<?php call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars())  ?>

