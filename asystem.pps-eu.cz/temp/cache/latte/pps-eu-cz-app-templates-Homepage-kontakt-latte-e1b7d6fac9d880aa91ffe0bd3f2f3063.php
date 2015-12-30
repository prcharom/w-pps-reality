<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Homepage/kontakt.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1903561549', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbff3305e76b_titulek')) { function _lbff3305e76b_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Kontakt
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lb034b6bb524_navigace')) { function _lb034b6bb524_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Kontakt
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe353c4b253_content')) { function _lbe353c4b253_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><div class="contact-box-left">
	<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAFNdFUtRnkm7hvikG-jOHUQZGWorUtxOA&q=<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($template->replace($template->strip($contact->address), ' ', '+')), ENT_COMPAT) ?>" width="400" height="300" frameborder="0" style="border:0"></iframe>
</div>

<div class="contact-box-right">
    	<div class="contact-adress">
        <div>
            <?php echo $template->replace($contact->name, ';', '<br>') ?>

        </div>
		<?php echo $template->replace($contact->address, ';', '<br>') ?>

	</div>
	<div class="contact-info">
		<?php echo $template->replace($contact->working_hours, ';', '<br>') ?>

	</div>
	<div class="contact-info">
		E-mail: <?php echo Latte\Runtime\Filters::escapeHtml($contact->email, ENT_NOQUOTES) ?>

	</div>
	<div class="contact-info">
		Tel: <?php echo Latte\Runtime\Filters::escapeHtml($contact->phone, ENT_NOQUOTES) ?>

	</div>
	<div class="contact-info">
		IČ: <?php echo Latte\Runtime\Filters::escapeHtml($contact->ico, ENT_NOQUOTES) ?>

	</div>	
</div>
   
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb911a6afe5a_head')) { function _lb911a6afe5a_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.contact-adress { 
    	margin: 1em; 
    	text-align: center; 
    	padding: 1em; 
    	border-radius: 10px;
    	background: rgb(80,100,140);
    	color: white;
    	cursor: pointer;
    }
    div.contact-adress:hover { 
    	background: rgb(102,123,180);
    }
    div.contact-adress > div { display: block; padding: 0; margin: 0 0 0.5em 0; font-size: 110%;}
    div.contact-info { 
    	margin: 1em; 
    	text-align: center; 
    	padding: 0.5em; 
    	border-radius: 10px;
    	background: rgb(80,100,140);
    	color: white;
    	cursor: pointer;
    }
    div.contact-info:hover {
    	background: rgb(102,123,180); 
    }
    div.contact-box-left { 
    	margin: 0;  
    	padding: 1.3em 0; 
    	overflow: hidden;
    	width: 50%;
    	text-align: center;
    	float: left;
    }
    div.contact-box-right { 
    	margin: 0;  
    	padding: 0; 
    	overflow: hidden;
    	width: 50%;
    	text-align: center;
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