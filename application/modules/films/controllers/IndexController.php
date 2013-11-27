<?php

class Films_IndexController extends Zend_Controller_Action{
	private $paginator;
	
	public function init(){
		$this->_helper->layout()->setlayout("backend");
		$db = Zend_Registry::get("db");
		$adapter = new Zend_Paginator_Adapter_DbSelect($db->select()->from('films'));
		$this->paginator = new Zend_Paginator($adapter);
		$this->paginator->setCurrentPageNumber($this->_getParam('page'));
		$this->paginator->setItemCountPerPage(3);
		//$this->paginator->setPageRange(3);
	}
	
	public function indexAction(){
		//Llamar al Mapper de Films que se encuentra en models y pasarselo a la vista
		$film = new Films_Model_FilmMapper();
		$this->view->films = $film->fetchAll();
		$this->view->paginator = $this->paginator;
	}
	
	public function addAction(){
		$form = new Films_Form_Film();

		$form->submit->setLabel('Add');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
// 				Zend_Debug::dump($form->getValues());
// 				die;
				$film = new Films_Model_Entity_Film($form->getValues());
				$mapper  = new Films_Model_FilmMapper();
				$mapper->save($film);
				return $this->_helper->redirector('index');

			} else {
				$form->populate($formData);
			}
		}
	}
	
	function editAction()
	{
		$form = new Films_Form_Film();
		$form->submit->setLabel('Save');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				print_r($form->getValues());
				$film = new Films_Model_Entity_Film($form->getValues());
                $mapper  = new Films_Model_FilmMapper();
                $mapper->save($film);
                return $this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('id', 0);
			$idfilms["idfilms"] = $id;
			if ($id > 0) {
				$film = new Films_Model_Entity_Film();
                $mapper  = new Films_Model_FilmMapper();
                $film = $mapper->find($id, $film);
              	$formfilm["id"] = $film->getId();
                $formfilm["iduser"] = $film->getIduser();
                $formfilm["title"] = $film->getTitle();
                $formfilm["director"] = $film->getDirector();
				$form->populate($formfilm);
			}
		}
	}
	
	public function deleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('id');
				$mapper  = new Films_Model_FilmMapper();
                $mapper->delete($id);
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			$film = new Films_Model_Entity_Film();
	        $mapper  = new Films_Model_FilmMapper();
	        $film = $mapper->find($id, $film);
	        $formfilm["id"] = $film->getId();
	        $formfilm["title"] = $film->getTitle();
	        $formfilm["director"] = $film->getDirector();
			$this->view->film = $formfilm;
		}
	}
	
	
}