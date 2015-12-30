<?php
// source: /home/www/pps-eu.cz/www/asystem.pps-eu.cz/app/templates/Homepage/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1617599099', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block titulek
//
if (!function_exists($_b->blocks['titulek'][] = '_lb7cfed8075c_titulek')) { function _lb7cfed8075c_titulek($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Domovská stránka
<?php
}}

//
// block navigace
//
if (!function_exists($_b->blocks['navigace'][] = '_lbf9236a68b5_navigace')) { function _lbf9236a68b5_navigace($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    Domovská stránka
<?php
}}

//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb6995e6d1cb_content')) { function _lb6995e6d1cb_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>    <h2>Poslední přidané nemovitosti</h2>
    <div class="def-boxes">
<?php ob_start() ;$iterations = 0; foreach ($nemovitosti as $nemovitost) { ?>
	        <div idn="<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->id, ENT_COMPAT) ?>
" title="<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->nazev, ENT_COMPAT) ?>
 (<?php echo Latte\Runtime\Filters::escapeHtml($nemovitost->adresa, ENT_COMPAT) ?>)" style="background-image:
	        	 
<?php if (isset($nemovitost->related('photo.id_property')->fetch()->name)) { ?>
	        		url(images/auction/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($nemovitost->id), ENT_COMPAT) ?>
/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::escapeCss($nemovitost->related('photo.id_property')->order('order DESC')->order('id ASC')->fetch()->name), ENT_COMPAT) ?>);
<?php } else { ?>
	        		url(images/auction/default.jpg);
<?php } ?>
	         	background-position: 50% 0%; background-size: auto 155px; background-repeat: no-repeat;" class="detail">
	            <div class="detail-popis">
	                <h2>
	                    <?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($nemovitost->nazev, 23), ENT_NOQUOTES) ?>

	                </h2>
	                <p class="adresa"><?php echo Latte\Runtime\Filters::escapeHtml($template->truncate($nemovitost->adresa, 32), ENT_NOQUOTES) ?></p>
	            </div>
		    </div>   
<?php $iterations++; } ob_start() ?>
            <p class="info">Zatím nebyly přidány žádné nemovitosti.</p>
<?php if (isset($nemovitost)) { ob_end_clean(); ob_end_flush(); } else { $_l->else = ob_get_contents(); ob_end_clean(); ob_end_clean(); echo $_l->else; } ?>
    </div>
    <div class="pata">
    	<h2>O nás</h2>
    	<p><?php echo $template->replace($about_us, ';', '<br>') ?></p>  
    </div>
<?php
}}

//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lb545f45a530_head')) { function _lb545f45a530_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><style>
    div.pata { 
    	display: block; 
    	margin: 1em -0.5em; 
    	padding: 2em 0.5em; 
    	background: #f0f0f0; 
    	clear: both;
    	border-top: 1px solid #e6e6e6;
    	border-bottom: 1px solid #e6e6e6;
    }
    div.pata p { display: block; margin: 0 2em 0 2em; padding: 0; }
    .def-boxes { display: inline-block; margin: 1em -0.5em; padding: 0 3%; height:100%; width: 883px; text-align: left; }
    .def-boxes div.detail { 
        width: 202px;
        height: 202px;
        vertical-align: top; 
        display: inline-block;
        background: #FFF; 
        margin: 0.5em 1.9% 0.5em 0;   
        border: 1px solid #e6e6e6; 
        border-radius: 10px; 
        overflow: hidden;
        cursor: pointer;
    }
    .def-boxes div.detail-popis { 
        display: inline-block;
        width: 202px;
        height: 50px;
        margin: 152px 0 0 0;
        background: #fff;
        border: 0;
        border-radius: 0 0 10px 10px;
        overflow: hidden;
    }
    .def-boxes div.detail:hover, .def-boxes div.detail:hover div.detail-popis, .def-boxes div.detail:hover div.detail-popis h2 { 
        background: #333;
        color: #fff;
    }
    .def-boxes div.detail:hover, .def-boxes div.detail-popis {
    	border-color: #333;
    }
    .def-boxes div.detail div.detail-popis h2 a { 
        background: transparent;
        color: #555;
    }
    .def-boxes div.info { display: block; width: 100%; height: auto; color: #fff; background-color: rgb(102,123,180); border-color: #285e8e; }
    .def-boxes h2 { text-align: left; margin: 3px 5px 0.5em 5px; font-size: 105%; font-weight: normal; overflow: hidden; }
    .def-boxes h3 { display: block; clear: both; text-align: left; margin: 0 5px; font-size: 90%; font-weight: normal; }
    .def-boxes img { width: 100%; margin: 0; }
    .def-boxes p { clear: both; margin: 0 5px 0.5em 5px; text-align: left;}
    .def-boxes p.adresa { font-size: 80%; }
    .def-boxes p.info { margin: 1em auto; text-align: center;}
    .def-boxes p a { color: #006aeb; background: #f7f7f7; padding: 1px 3px; border-radius: 3px; text-decoration: none; box-shadow: 0 2px 5px rgba(0, 0, 0, .10); }
    .def-boxes p a:hover, .def-boxes p a:active, .def-boxes p a:focus { color: white; background-color: #006aeb; }
    .def-boxes > div:nth-child(4n) { margin: 0.5em 0; }
    @media (max-width: 700px) {
	.def-boxes > div { float: none; width: auto; margin: 0 0 1.1em; min-height: 0; }
	.def-boxes h2, .def-boxes p { margin: 0 0.5em; }
	.def-boxes > div:nth-child(3n - 2) img { margin: -1em 0 0 -1em; }
    }
    #content > h2 { display: block; margin: 1em 1em 0 1em; padding: 0; font-size: 1.7em; color: #1e5eb6;}
    #content div.pata h2 { display: block; margin: 0 1em 0.5em 1em; padding: 0; font-size: 1.7em; color: #1e5eb6;}
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