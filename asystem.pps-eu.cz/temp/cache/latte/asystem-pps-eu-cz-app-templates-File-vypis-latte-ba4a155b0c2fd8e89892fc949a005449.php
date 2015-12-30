<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/File/vypis.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3815606959', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb69bca02245_titulek')) { function _lb69bca02245_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Výpis přiložených souborů
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbcfe92eb9fb_navigace')) { function _lbcfe92eb9fb_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
"><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_NOQUOTES) ?></a> » Výpis přiložených souborů
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbbfe10d10c8_content')) { function _lbbfe10d10c8_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div>
<?php ob_start() ?>
        <table class="tabulka">
            <tr>
                <th>Název souboru</th>
                <th>Typ souboru</th>
                <th></th>
            </tr>
<?php $iterations = 0; foreach ($files as $file) { ?>
            <tr>
                <td>
                    <?php echo Latte\Runtime\Filters::escapeHtml($file->name, ENT_NOQUOTES) ?>

                </td>
                <td>
                    <?php echo Latte\Runtime\Filters::escapeHtml($file->type, ENT_NOQUOTES) ?>

                </td>
                <td>
                    <a class="upravit" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("edit", array($file->id_property, $file->id)), ENT_COMPAT) ?>
"><span>Upravit</span></a>
                    <a class="smazat" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("delete", array($file->id_property, $file->id)), ENT_COMPAT) ?>
"><span>Smazat</span></a> 
                </td>
            </tr>
<?php $iterations++; } ?>
        </table>
<?php ob_start() ?>
            <p class="info">Nejsou nahrány žádné PDF.</p>
<?php if (isset($file)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbe8714e9a06_head')) { function _lbe8714e9a06_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    #content table { margin: 1em auto; width: 70%; border-radius: 4px; border-color: transparent; }
    #content table th, #content table td { padding: 3px 6px;}
    #content table th:first-child { border-radius: 4px 0 0 4px; }
    #content table th:last-child { border-radius: 0 4px 4px 0; }
    #content table th:first-child, #content table td:first-child { width: 50%; }
    #content table th:last-child, #content table td:last-child { width: 25%; }
    #content table th { font-weight: normal; text-align: left; font-size: 90%; }
    #content table td { font-weight: normal; text-align: center; }
    #content table td:first-child { text-align: left; }
    #content table th:nth-child(2) { text-align: center; }
    #content table tr:last-child td { border-bottom: 1px solid #555; }
    #content a.smazat { color: red; }
    #content a.smazat:hover { color: white; background: red; }
    #content a.upravit { color: darkcyan; }
    #content a.upravit:hover { color: white; background: darkcyan; }
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