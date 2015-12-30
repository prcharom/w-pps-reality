<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Foto/smazat.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8278180530', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbd3792c8364_titulek')) { function _lbd3792c8364_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Mazání fotografií
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbd77131b178_navigace')) { function _lbd77131b178_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
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
"><?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_NOQUOTES) ?></a> » Mazání fotografií
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb12ce219807_content')) { function _lb12ce219807_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div> 
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormBegin($form = $_form = $_control["deletePhotoForm"], array()) ?>

		<!-- vykreslení chyb -->
<?php if ($form->hasErrors()) { ?>		<ul class="errors">
<?php $iterations = 0; foreach ($form->errors as $error) { ?>		    <li><?php echo Latte\Runtime\Filters::escapeHtml($error, ENT_NOQUOTES) ?></li>
<?php $iterations++; } ?>
		</ul>
<?php } ?>

		<table id="photos_delete">
<?php $iterations = 0; foreach ($photos as $photo) { ?>
			<tr class="required">
			    <td><?php $_input = is_object($photo->id) ? $photo->id : $_form[$photo->id]; echo $_input->getControl() ?></td>
			    <td style="background-image: url(../../images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($photo->id_property), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($photo->name), ENT_COMPAT) ?>);  background-position: 50% 0%; background-size: auto 120px; background-repeat: no-repeat;">
			    	<img class="icon-selected" src="../../images/icons/blue//118.png">
			    </td>
			</tr>
<?php $iterations++; } ?>
			<tr>
			    <td colspan="2"><?php echo $_form["send"]->getControl() ?></td>
			</tr>
		</table>
<?php Nette\Bridges\FormsLatte\FormMacros::renderFormEnd($_form) ?>
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb2e0024eec6_head')) { function _lb2e0024eec6_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    #content table { margin: 1em auto; }
    #content td img { width: 120px; margin: 0; padding: 0; border: 0;}
    #content tr td:first-child { display:none; border-radius: 10px 0 0 10px;}
    #content tr.active td { background: #DDD;}
    #content input { cursor: pointer;}
    #content table tr { display: inline-block; margin: 2px; }
    #content table tr td { vertical-align: middle; text-align: center; padding: 0; width: 120px; height: 120px; }
    #content table tr.required { cursor: pointer; }
    #content table tr.required td input { vertical-align: middle; }
    #content table tr:last-child { display: block;}
    #content table tr:last-child td { 
    	width: 100%;
    	display: block;
    	text-align: center; 
    	padding: 1em 0 0 0;
    }
    #content img.icon-selected {
    	width: 50px;
    	display: none;
    }
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