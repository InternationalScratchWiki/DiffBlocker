<?php
class SpecialAllowAnonDiffViewing extends SpecialPage {
	function __construct() {
		parent::__construct('AllowAnonDiffViewing');
	}
	
	function getGroupName() {
		return '';
	}
	
	function showForm() {
		$this->getOutput()->addHTML(Html::openElement('form', ['method' => 'post', $this->getPageTitle()->getLocalUrl()]));
		
		$this->getOutput()->addHTML(
			Html::rawElement(
				'div',
				[],
				$this->msg('diffblocker-anon-diff-form-content')->parse()
			)
		);
		
		$this->getOutput()->addHTML(
			Html::element('button', ['type' => 'submit'], 'Allow')
		);
				
		$this->getOutput()->addHTML(Html::closeElement('form'));
	}
	
	function handlePost() {
		$this->getRequest()->getSession()->persist();
		$this->getRequest()->getSession()->set('anondiffs', 'true');
		
		$this->getOutput()->addHTML($this->msg('diffblocker-anon-diff-success')->parse());
	}
	
	function execute($par) {
		$this->getOutput()->setPageTitle( $this->msg( "allowanondiffviewing" )->escaped() );
		
		if ($this->getRequest()->wasPosted()) {
			$this->handlePost();
		} else {
			$this->showForm();
		}
	}
}