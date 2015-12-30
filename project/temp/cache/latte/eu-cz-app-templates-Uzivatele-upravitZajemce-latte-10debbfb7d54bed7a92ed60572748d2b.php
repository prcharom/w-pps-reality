<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Uzivatele/upravitZajemce.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6876296141', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbbed67370df_titulek')) { function _lbbed67370df_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Úprava účtu zájemce
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbf01077a528_navigace')) { function _lbf01077a528_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <a href="#">Administrátor</a> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:zajemci"), ENT_COMPAT) ?>
">Přehled zájemců</a> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:vizitka", array($zajemce->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($zajemce->jmeno, ENT_NOQUOTES) ?></a> » Upravit účet zájemce
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb28c0b4adbf_content')) { function _lb28c0b4adbf_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="info">
        Z bezpečnostních důvodů je třeba znovu určit heslo pro účet zájemce. Pole označená 
        <strong>*</strong> (hvězdičkou) je třeba vyplnit.
    </div>
<?php $_l->tmp = $_control->getComponent("zajemceForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lba2e2005f62_head')) { function _lba2e2005f62_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    #frm-zajemceForm, #frm-zajemceForm table { margin: 1em auto; }
    #frm-zajemceForm tr:first-child { display: none; }
    #frm-zajemceForm tr th { width: 20%; text-align: right; padding: 6px; }
    #frm-zajemceForm tr th label { font-weight: bold; }
    #frm-zajemceForm tr td { width: 40%; text-align: left; }
    #frm-zajemceForm tr td input, #frm-zajemceForm tr td textarea {
        width: 55%; 
        text-align: left;
    }
    #frm-zajemceForm tr td textarea { height: 12em; text-align: left; }
    #frm-zajemceForm tr td .button { width: auto; text-align: center; }
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