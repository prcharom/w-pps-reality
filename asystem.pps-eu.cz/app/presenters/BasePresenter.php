<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/**
      * Tovarnicka na formular pro vyhledávání.
      * @return Nette\Application\UI\Form
      */
    protected function createComponentBasicSearchForm()
    {
        $form = new Nette\Application\UI\Form;
    
        $form->addText('search')
        ->setRequired('Prosím zadejte výraz, který chcete vyhledat.');

        $form->addSubmit('send', 'Najít')
        ->setAttribute('class', 'btn btn-primary');

        $form->onSuccess[] = function(Nette\Application\UI\Form $form) {
            
            $obj = $form->getValues();                        
            $this->redirect('Search:zakladniVyhledavani', $obj->search);

        };
        return $form;
    }

}
