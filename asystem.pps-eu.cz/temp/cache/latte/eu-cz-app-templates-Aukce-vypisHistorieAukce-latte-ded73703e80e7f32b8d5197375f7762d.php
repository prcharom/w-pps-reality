<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Aukce/vypisHistorieAukce.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4566709635', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb2bb0be5b96_titulek')) { function _lb2bb0be5b96_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Výpis historie aukce
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbe5d0669c8e_navigace')) { function _lbe5d0669c8e_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <a href="#">Administrátor</a> » <?php if ($status == 1) { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(1)), ENT_COMPAT) ?>
">Nemovitosti, které čekají na zahájení aukce</a><?php } elseif ($status == 2) { ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(2)), ENT_COMPAT) ?>
">Nemovitosti, u kterých aukce již proběhla</a><?php } else { ?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:vypis", array(3)), ENT_COMPAT) ?>
">Nemovitosti, u kterých aukce právě probíhá</a><?php } ?> » <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($nemovitost->id)), ENT_COMPAT) ?>
"><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_NOQUOTES) ?></a> » Výpis historie aukce
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6310c0736c_content')) { function _lb6310c0736c_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><table class="tabulka drazba">
    <tr>
        <th>
            Status
        </th>
        <th>
            Datum a čas
        </th>
        <th>
            Nick uživatele
        </th>
        <th>
            Jméno uživatele
        </th>
        <th>
            Částka
        </th>
    </tr>
    <tr>
        <td>
            Zadáno
        </td>
        <td>
            <?php echo Latte\Runtime\Filters::escapeHtml($template->date($nemovitost->datum_zacatek, 'd.m.Y H:i'), ENT_NOQUOTES) ?>

        </td>
        <td>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:vizitka", array($nemovitost->id_uzivatel)), ENT_COMPAT) ?>
">
                <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->uzivatel->nick, ENT_NOQUOTES) ?>

            </a>
        </td>
        <td>
            <?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->uzivatel->jmeno, ENT_NOQUOTES) ?>

        </td>
        <td>
<?php $nabidka = $nemovitost->pocatecni_cena ?>
            <?php echo Latte\Runtime\Filters::escapeHtml($template->number($nabidka), ENT_NOQUOTES) ?> Kč
        </td>
    </tr>
<?php ob_start() ;$iterations = 0; foreach ($prihozy as $prihoz) { ?>
        <tr>
            <td>
                Nabídka
            </td>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($template->date($prihoz->datum_vkladu, 'd.m.Y H:i'), ENT_NOQUOTES) ?>

            </td>
            <td>
                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:vizitka", array($prihoz->id_uzivatel)), ENT_COMPAT) ?>
">
                    <?php echo Latte\Runtime\Filters::escapeHtml($prihoz->uzivatel->nick, ENT_NOQUOTES) ?>

                </a>
            </td>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($prihoz->uzivatel->jmeno, ENT_NOQUOTES) ?>

            </td>
            <td>
                <span>(+<?php echo Latte\Runtime\Filters::escapeHtml($template->number($prihoz->vkladana_castka), ENT_NOQUOTES) ?>
)</span> <?php echo Latte\Runtime\Filters::escapeHtml($template->number($nabidka = $nabidka + $prihoz->vkladana_castka), ENT_NOQUOTES) ?> Kč
            </td>
<?php if ($user->isAllowed('drazba','smazatPrihoz')) { ?>            <td>
                <a class="smazat" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("smazatPrihoz", array($prihoz->id)), ENT_COMPAT) ?>
">smazat</a>
            </td>
<?php } ?>
        </tr>
<?php $iterations++; } if (isset($prihoz)) ob_end_flush(); else ob_end_clean() ?>
    <tr>
<?php if ($status == 1) { ?>
            <td>
                Začne
            </td>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($template->date($nemovitost->datum_zacatek, 'd.m.Y H:i'), ENT_NOQUOTES) ?>

            </td>
<?php } elseif ($status == 2) { ?>
            <td>
                Konec
            </td>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($template->date($nemovitost->datum_konec, 'd.m.Y H:i'), ENT_NOQUOTES) ?>

            </td>
<?php } else { ?>
            <td>
                Probíhá
            </td>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($template->date($now, 'd.m.Y H:i'), ENT_NOQUOTES) ?>

            </td>    
<?php } ?>
        <td>
            <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:vizitka", array($drazba['id'])), ENT_COMPAT) ?>
">
                <?php echo Latte\Runtime\Filters::escapeHtml($drazba['nick'], ENT_NOQUOTES) ?>

            </a>
        </td>
        <td>
            <?php echo Latte\Runtime\Filters::escapeHtml($drazba['jmeno'], ENT_NOQUOTES) ?>

        </td>
        <td>
            <?php echo Latte\Runtime\Filters::escapeHtml($template->number($drazba['cena']), ENT_NOQUOTES) ?> Kč
        </td>
    </tr>
</table>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbcf0b67528f_head')) { function _lbcf0b67528f_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    a.smazat { color: red; }
    a.smazat:hover { color: white; background: red; }
    table.drazba { margin: 1em auto; width: 96%; border-collapse: collapse; border-color: transparent; border-radius: 4px; }
    table.drazba td:first-child { width: 10%; overflow: hidden;}
    table.drazba td:nth-child(2) { width: 20%; overflow: hidden;}
    table.drazba td:nth-child(3) { width: 20%; overflow: hidden;}
    table.drazba td:nth-child(4) { width: 20%; overflow: hidden;}
    table.drazba th { font-weight: normal; text-align: left; font-size: 90%; padding: 3px 6px; }
    table.drazba th:first-child { border-radius: 4px 0 0 4px; }
    table.drazba th:last-child { border-radius: 0 4px 4px 0; }
    table.drazba td { font-weight: normal; text-align: left; padding: 3px 6px; }
    table.drazba tr td:first-child { text-align: center; }
    table.drazba tr td:last-child { text-align: center; }
    table.drazba tr td:nth-child(5) { text-align: right; }
    table.drazba tr:nth-child(2n+1) { background: #f0f0f0; }
    table.drazba tr:nth-child(2) td { border-bottom: 1px solid #555; background: white; }
    table.drazba tr:last-child td { border-top: 1px solid #555; border-bottom: 1px solid #555; background: white; }
    table.drazba td span { margin: 0; padding: 0; color: #AAA;}
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