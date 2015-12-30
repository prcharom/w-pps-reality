<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Homepage/podminky.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7555518924', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lbb2217a3a09_titulek')) { function _lbb2217a3a09_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Podmínky
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbc1b1d0ec39_navigace')) { function _lbc1b1d0ec39_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Podmínky
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lbe4490693b9_content')) { function _lbe4490693b9_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <div class="terms"> 
        <h2><?php echo Latte\Runtime\Filters::escapeHtml($terms->title, ENT_NOQUOTES) ?></h2>
        <h3>Naposledy upraveno: <?php echo Latte\Runtime\Filters::escapeHtml($month, ENT_NOQUOTES) ?>
 <?php echo Latte\Runtime\Filters::escapeHtml($template->date($terms->last_modified, 'j, Y'), ENT_NOQUOTES) ?></h3>
                <p><?php echo $body ?></p> 
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb3bc0975627_head')) { function _lb3bc0975627_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.terms { display: block; margin: 1em 1.5em; text-align: left; font-weight: normal; font-size: 1em; }
    div.terms h2, div.terms h3, div.terms p { display: block; margin: 0; padding: 0;} 
    div.terms h2 { font-size: 1.7em;}
    div.terms h3 { font-size: 80%; font-weight: normal; margin: 1em 0;}
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