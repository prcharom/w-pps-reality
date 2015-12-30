<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Uzivatele/vizitka.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5913848958', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbc56d42a8cb_titulek')) { function _lbc56d42a8cb_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Vizitka uživatele
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb7bbf520c47_navigace')) { function _lb7bbf520c47_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="#">Administrátor</a> » <?php if ($uzivatel->id_typ_uzivatele == 3) { ?>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Uzivatele:zajemci"), ENT_COMPAT) ?>
">Přehled zájemců</a> » <?php } ?>Vizitka uživatele  
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3ecefcd529_content')) { function _lb3ecefcd529_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <table class="vizitka left">
        <tr>
            <th>
                Alias:
            </th>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($uzivatel->nick, ENT_NOQUOTES) ?>

            </td>
        </tr>
        <tr>
            <th>
                Jméno:
            </th>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($uzivatel->jmeno, ENT_NOQUOTES) ?>

            </td>
        </tr>
        <tr>
            <th>
                Email:
            </th>
            <td>
                <a href="mailto:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($uzivatel->email), ENT_COMPAT) ?>">
                    <?php echo Latte\Runtime\Filters::escapeHtml($uzivatel->email, ENT_NOQUOTES) ?>

                </a>
            </td>
        </tr>
        <tr>
            <th>
                Telefon:
            </th>
            <td>
                <a href="tel:<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($template->replace($template->strip($uzivatel->telefon), ' ', '')), ENT_COMPAT) ?>">
                    <?php echo Latte\Runtime\Filters::escapeHtml($uzivatel->telefon, ENT_NOQUOTES) ?>

                </a>
            </td>
         </tr>
         <tr>
            <th>
                Adresa:
            </th>
            <td>
                <?php echo Latte\Runtime\Filters::escapeHtml($uzivatel->adresa, ENT_NOQUOTES) ?>

            </td>
         </tr>
    </table>
    <table class="vizitka right">
        <tr>
            <th>
                Přístup k:
            </th>
            <td>
<?php if ($uzivatel->nemovitost != null) { ?>                <a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("Nemovitosti:detailNemovitosti", array($uzivatel->nemovitost)), ENT_COMPAT) ?>
">
                    <?php echo Latte\Runtime\Filters::escapeHtml($uzivatel->nemovitost->nazev, ENT_NOQUOTES) ?>

                </a>
<?php } ?>
            </td>
        </tr>
        <tr>
            <th>
            	První přihlášení:
            </th>
            <td>
<?php if ($uzivatel->prvni_prihlaseni != null) { ?>
            		<?php echo Latte\Runtime\Filters::escapeHtml($template->date($uzivatel->prvni_prihlaseni, 'd.m.Y H:i'), ENT_NOQUOTES) ?>

<?php } else { ?>
            		Ještě se nepřihlásil(a).
<?php } ?>
            </td>
        </tr>
    </table>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb537adcb8ef_head')) { function _lb537adcb8ef_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    table.vizitka th { text-align: right; color: #1e5eb6; }
    table.vizitka th, table.vizitka td { padding: 3px 6px; font-size: 1em; font-weight: normal; }
    table.vizitka a { color: #555; text-decoration: none;}
    table.vizitka a:hover { color: #555; text-decoration: none; background: transparent;}
    table.left { float: left; margin: 0 0 0 10%; width: 40%;}
    table.left th { width: 20%; }
    table.right { width: 50%; }
    table.right th { width: 28%; }
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