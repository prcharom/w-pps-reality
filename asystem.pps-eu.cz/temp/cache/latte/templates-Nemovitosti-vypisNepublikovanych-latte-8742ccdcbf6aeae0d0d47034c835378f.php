<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Nemovitosti/vypisNepublikovanych.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6956641430', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb669383ac69_titulek')) { function _lb669383ac69_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Přehled nepublikovaných nemovitostí
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbf3cc1f1ca2_navigace')) { function _lbf3cc1f1ca2_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <?php if ($user->isAllowed('adminMenu')) { ?><a href="#">Administrátor</a> »<?php } ?>

    Nepublikované nemovitosti
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb9ee2c498b1_content')) { function _lb9ee2c498b1_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="main-window">
<?php ob_start() ?>
        <table>
<?php $iterations = 0; foreach ($nemovitosti as $nemovitost) { ?>
            <tr>
                <td idn="<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
            	 
<?php if (isset($nemovitost->related('photo.id_property')->fetch()->name)) { ?>
            		url(../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
            		url(../images/auction/default.jpg);
<?php } ?>
             	background-position: 50% 50%; background-size: auto 155px; background-repeat: no-repeat;" class="detail">
                </td>
                <td>
                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($nemovitost->nazev, 23), ENT_NOQUOTES) ?>

                </td>
                <td>
                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($nemovitost->adresa, 32), ENT_NOQUOTES) ?>

                </td>
                <td>
                    <ul>
                        <li>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["pubForm"], array()) ?>

							<!-- vykreslení chyb -->
<?php if ($form->hasErrors()) { ?>							<ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error) { ?>							    <li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
							</ul>
<?php } ?>

							<div id="pub_tab_<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->id, ENT_COMPAT) ?>">
								<div class="required">
									<?php echo Latte\Runtime\Filters::escapeHtml($form["id"]->control->setValue($nemovitost->id), ENT_NOQUOTES) ?>

								</div>
								<div>
									<?php echo $_form["send"]->getControl() ?>

								</div>
							</div>

<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
                        </li>
                        <li>
                            <a class="btn btn-primary" href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("nemovitosti:detailNemovitosti", array($nemovitost->id)), ENT_COMPAT) ?>
">Detail</a>
                        </li>
                    </ul>
                </td>
            </tr>  
<?php $iterations++; } ?>
        </table>
<?php ob_start() ?>
            <p class="info">Momentálně nejsou k dispozici žádné nemovitosti.</p>
<?php if (isset($nemovitost)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb2f97dd9d35_head')) { function _lb2f97dd9d35_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    .main-window table { width: 90%; margin: 0 auto; border-collapse: collapse;}
    .main-window table td { 
        width: 27%; 
        padding: 3px 6px; 
        background: #EAEAEA;
        border-bottom: 1px solid white;
    }
    .main-window table td:first-child { width: 100px; border-right: 1px solid white;}
    .main-window table tr { height: 100px;}
    .main-window table div > div:first-child { display: none;}
    .main-window table div > div { margin: 2px;}
    ul { list-style: none;}
    .btn { text-decoration: none; margin: 0; width: 130px;}
    form .btn { margin: 0; width: 155px;}
    form { margin: 0 0 0 -2px; padding: 0;}
    div.flash { margin-bottom: 1em;}
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