<?php

class FestivalsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout()->setLayout("backend");
    }

    public function indexAction()
    {
        $festivales = new Application_Model_FestivalsMapper();
        $this->view->festivals = $festivales->fetchAll();
    }
    
    function addAction()
    {
        $form = new Application_Form_Festival();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	$date = new Zend_Date($formData['date']);
            	$formData['date'] = $date->toString('YYYY-MM-dd 00:00:00');
            	$festival = new Application_Model_Festivals($formData);
            	$festivalsMapper = new Application_Model_FestivalsMapper();
                $festivalsMapper->save($festival);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    function editAction()
    {
        $form = new Application_Form_Festival();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
            	$date = new Zend_Date($formData['date']);
            	$formData['date'] = $date->toString('YYYY-MM-dd 00:00:00');
            	$festival = new Application_Model_Festivals($formData);
            	$festivalsMapper = new Application_Model_FestivalsMapper();
            	$festivalsMapper->save($festival);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $festivals = new Application_Model_FestivalsMapper();
            	$festival = $festivals->find($id);
            	$date = new Zend_Date($festival->date);
            	$festival->date = $date->toString('MM/dd/YYYY');
                $form->populate($festival->__toArray());
            }
        }
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $festivals = new Application_Model_FestivalsMapper();
                $festivals->delete($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $festivals = new Application_Model_FestivalsMapper();
            $this->view->festival = $festivals->find($id);
        }
    }
}
