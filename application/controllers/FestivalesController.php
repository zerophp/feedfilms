<?php

class FestivalesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->layout()->setLayout("backend");
    }

    public function indexAction()
    {
        $festivales = new Application_Model_DbTable_Festivales();
        $this->view->festivales = $festivales->fetchAll();
    }
    
    function addAction()
    {
        $form = new Application_Form_Festival();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $description = $form->getValue('description');
                $date = $form->getValue('date');
                $festivals = new Application_Model_DbTable_Festivales();
                $festivals->addFestivales($name, $description, $date);
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
                $id = (int)$form->getValue('idfestival');
                $name = $form->getValue('name');
                $description = $form->getValue('description');
                $date = $form->getValue('date');
                $festivals = new Application_Model_DbTable_Festivales();
                $festivals->updateFestivales($id, $name, $description, $date);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $festivals = new Application_Model_DbTable_Festivales();
            	$festival = $festivals->getFestivales($id);
            	$date = new Zend_Date($festival['date']);
            	$festival['date'] = $date->toString('MM/dd/YYYY');
                $form->populate($festival);
            }
        }
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $festivals = new Application_Model_DbTable_Festivales();
                $festivals->deleteFestivales($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $festivals = new Application_Model_DbTable_Festivales();
            $this->view->festival = $festivals->getFestivales($id);
        }
    }
}
