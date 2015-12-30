<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Uzivatele/upravitProfil.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9972189657', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb75fd7a63d0_titulek')) { function _lb75fd7a63d0_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Úprava profilu
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb829251453b_navigace')) { function _lb829251453b_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> » <?php } ?>Úprava profilu
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb38137de7a6_content')) { function _lb38137de7a6_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="info">
        Alias přiděluje administrátor a nelze měnit.
    </div>
<?php $_l->tmp = $_control->getComponent("userEditForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb9cc49fb0d2_head')) { function _lb9cc49fb0d2_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.info { margin-bottom: 1em;}
    #frm-userEditForm, #frm-userEditForm table { margin: 1em auto; }
    #frm-userEditForm tr th { width: 20%; text-align: right; padding: 6px; }
    #frm-userEditForm tr th label { font-weight: bold; }
    #frm-userEditForm tr td { width: 40%; text-align: left; }
    #frm-userEditForm tr td input, #frm-userEditForm tr td textarea {
        width: 55%; 
        text-align: left;
    }
    #frm-userEditForm tr td textarea { height: 12em; text-align: left; }
    #frm-userEditForm tr td .button { width: auto; text-align: center; }
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