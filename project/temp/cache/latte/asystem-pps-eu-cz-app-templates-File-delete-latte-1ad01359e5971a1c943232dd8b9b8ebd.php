<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/File/delete.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9619663284', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb7c51a5bf37_titulek')) { function _lb7c51a5bf37_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Smazat PDF soubor
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbed53964b32_navigace')) { function _lbed53964b32_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>     <a href="#">Administrátor</a> »
<?php if ($nemovitost->mod == 2) { ?>
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(4)), ENT_COMPAT) ?>
">Nemovitosti, které jsou určeny k prodeji</a>
<?php } elseif ($nemovitost->mod == 3) { ?>
        <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(5)), ENT_COMPAT) ?>
">Nemovitosti, které již byly prodány</a>
<?php } else { if ($status == 1) { ?>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(1)), ENT_COMPAT) ?>
">Nemovitosti, které čekají na zahájení aukce</a>
<?php } elseif ($status == 2) { ?>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(2)), ENT_COMPAT) ?>
">Nemovitosti, u kterých aukce již proběhla</a>
<?php } else { ?>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(3)), ENT_COMPAT) ?>
">Nemovitosti, u kterých aukce právě probíhá</a>
<?php } ?>
    <?php } ?> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($nemovitost->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_NOQUOTES) ?>
</a> »  <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("File:vypis", array($nemovitost->id)), ENT_COMPAT) ?>
">Výpis přiložených souborů</a> » Smazat PDF soubor
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6d2d48edff_content')) { function _lb6d2d48edff_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="info">
        Opravdu chcete smazat soubor <a href="../../files/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->id_property), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->hid_name), ENT_COMPAT) ?>
-<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->timestamp), ENT_COMPAT) ?>
.<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($file->type), ENT_COMPAT) ?>" target="_blank">
        <?php echo Latte\Runtime\Filters::escapeHtml($file->name, ENT_NOQUOTES) ?>
 (.<?php echo Latte\Runtime\Filters::escapeHtml($file->type, ENT_NOQUOTES) ?>, <?php echo Latte\Runtime\Filters::escapeHtml($file->size, ENT_NOQUOTES) ?> MB)</a>   ? 
<?php $_l->tmp = $_control->getComponent("deleteFileForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbc055d91fdb_head')) { function _lbc055d91fdb_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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