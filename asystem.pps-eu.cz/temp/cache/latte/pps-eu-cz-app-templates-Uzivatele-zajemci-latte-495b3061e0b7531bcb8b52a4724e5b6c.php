<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Uzivatele/zajemci.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2101903331', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbcbbcfdbd78_titulek')) { function _lbcbbcfdbd78_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Přehled účtů zájemců
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbbd44442dcf_navigace')) { function _lbbd44442dcf_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <a href="#">Administrátor</a> » Přehled zájemců
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb7c80e673b3_content')) { function _lb7c80e673b3_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div>
<?php ob_start() ?>
        <table class="tabulka">
            <tr>
                <th>Alias</th>
                <th>Jméno</th>
                <th>Přístup k</th>
                <th>První přihlášení</th>
                <th></th>
            </tr>
<?php $iterations = 0; foreach ($zajemci as $zajemce) { ?>
            <tr>
            <td><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("vizitka", array($zajemce->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($zajemce->nick, ENT_NOQUOTES) ?></a></td>
                <td><?php echo Latte\Runtime\Filters::escapeHtml($zajemce->jmeno, ENT_NOQUOTES) ?></td>
                <td>
                    <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($zajemce->nemovitost)), ENT_COMPAT) ?>
">
                        <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($zajemce->nemovitost->nazev, 30), ENT_NOQUOTES) ?>

                    </a>
                </td>
                <td>
<?php if ($zajemce->prvni_prihlaseni != null) { ?>
                        <?php echo Latte\Runtime\Filters::escapeHtml($template->date($zajemce->prvni_prihlaseni, 'd.m.Y H:i'), ENT_NOQUOTES) ?>

<?php } else { ?>
                        Ještě se nepřihlásil(a).
<?php } ?>
                </td>
                <td>
                    <a class="upravit" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("upravitZajemce", array($zajemce->id)), ENT_COMPAT) ?>
"><span>upravit</span></a> 
                    <a class="smazat" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("smazatZajemce", array($zajemce->id)), ENT_COMPAT) ?>
"><span>smazat</span></a>
                </td>
            </tr>
<?php $iterations++; } ?>
        </table>
<?php ob_start() ?>
            <p class="info">Nejsou vytvořeny žádné účty zájemců. Vytvořte je pomocí administrátorského menu.</p>
<?php if (isset($zajemce)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb9aa8d657a5_head')) { function _lb9aa8d657a5_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    #content table { margin: 1em auto; width: 96%; border-radius: 4px; border-color: transparent; }
    #content table th, #content table td { padding: 3px 6px; width: 20%; }
    #content table th:first-child { border-radius: 4px 0 0 4px; }
    #content table th:last-child { border-radius: 0 4px 4px 0; }
    #content table th:nth-child(2), #content table td:nth-child(2) { padding: 3px 6px; width: 18%; }
    #content table th:nth-child(3), #content table td:nth-child(3) { padding: 3px 6px; width: 30%; }
    #content table th:first-child, #content table td:first-child { width: 15%; }
    #content table th:last-child, #content table td:last-child { width: 17%; text-align: center; }
    #content table th { font-weight: normal; text-align: left; font-size: 90%; }
    #content table td { font-weight: normal; text-align: left; }
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