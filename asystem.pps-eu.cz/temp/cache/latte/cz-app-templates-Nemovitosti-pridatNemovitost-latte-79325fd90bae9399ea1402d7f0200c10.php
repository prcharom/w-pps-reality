<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Nemovitosti/pridatNemovitost.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4415004764', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb8db5ccecbf_titulek')) { function _lb8db5ccecbf_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Přidání nemovitosti
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb2074210363_navigace')) { function _lb2074210363_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <a href="#">Administrátor</a> » Přidat nemovitost
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb0653cb3434_content')) { function _lb0653cb3434_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="info">
        Nemovitost, určená k aukci, musí obsahovat název, adresu, popis, počáteční cenu, datum a čas začátku, datum a čas konce.<br>
        Datum a čas je třeba zadat ve tvaru <span>[rok]</span>-<span>[měsíc]</span>-<span>[den]</span> <span>[hodiny]</span>:<span>[minuty]</span> (př. <?php echo Latte\Runtime\Filters::escapeHtml(Date('Y-m-d H:i'), ENT_NOQUOTES) ?>).
    </div>
<?php $_l->tmp = $_control->getComponent("nemovitostForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ;
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbfd35b785cf_head')) { function _lbfd35b785cf_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.info span { margin: 0; padding: 0; color: #1e5eb6;}
    #frm-nemovitostForm, #frm-nemovitostForm table { margin: 1em auto; }
    #frm-nemovitostForm tr:first-child { display: none; }
    #frm-nemovitostForm tr:nth-child(14) { display: none; }
    #frm-nemovitostForm tr th { width: 20%; text-align: right; padding: 6px; }
    #frm-nemovitostForm tr th label { font-weight: bold; }
    #frm-nemovitostForm tr td { width: 40%; text-align: left; }
    #frm-nemovitostForm tr td input, #frm-nemovitostForm tr td textarea {
        width: 55%; 
        text-align: left;
    }
    #frm-nemovitostForm tr td input[type="checkbox"] { width: auto;}
    #frm-nemovitostForm tr td textarea { height: 12em; text-align: left; }
    #frm-nemovitostForm tr td .button { width: auto; text-align: center; }
    #frm-nemovitostForm tr:last-child input { width: 362px;}
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