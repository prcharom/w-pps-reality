<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Uzivatele/zmenitHeslo.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1305603313', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb2e0f4ee068_titulek')) { function _lb2e0f4ee068_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Změna hesla
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb6593991ff8_navigace')) { function _lb6593991ff8_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> » <?php } ?>Změna hesla
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbf163a1ba5b_content')) { function _lbf163a1ba5b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="info">
        Pole označená <strong>*</strong> (hvězdičkou) je třeba vyplnit.
    </div>
<?php $_l->tmp = $_control->getComponent("passEditForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb313f6290b6_head')) { function _lb313f6290b6_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.info { margin-bottom: 1em;}
    #frm-passEditForm, #frm-passEditForm table { margin: 1em auto; width: 671px;}
    #frm-passEditForm tr th { width: 20%; text-align: right; padding: 6px; }
    #frm-passEditForm tr th label { font-weight: bold; }
    #frm-passEditForm tr td { width: 40%; text-align: left; }
    #frm-passEditForm tr td input, #frm-passEditForm tr td textarea {
        width: 55%; 
        text-align: left;
    }
    #frm-passEditForm tr td textarea { height: 12em; text-align: left; }
    #frm-passEditForm tr td .button { width: auto; text-align: center; }
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