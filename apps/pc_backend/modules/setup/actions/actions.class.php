<?php

class setupActions extends sfActions
{
  public function preExecute()
  {
    if(file_exists(sfConfig::get('sf_root_dir').'/ProjectConfiguration.class.php'))
    {
      $this->redirect('@homepage');
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('setup', 'install');
  }
  
  public function executeInstall(sfWebRequest $request)
  {
    $this->form = new OpenPNEInstallForm();
    
    if($request->isMethod(sfRequest::POST))
    {
      if($this->getUser()->getAttribute('setup_install'))
      {
        $request->checkCSRFProtection();
        
        //PENDING: create config/OpenPNE.yml here
        //PENDING: create config/ProjectConfiguration.class.php here
        //PENDING: run fast-install command here
        
        $this->getUser()->setAttribute('setup_install', null);
        $this->getUser()->setFlash('notice', 'Install complete!');
        
        $this->redirect('/pc_backend.php');
      }
      
      $this->form->bind($request->getParameter($this->form->getName()));
      if($this->form->isValid())
      {
        $this->getUser()->setAttribute('setup_install', $this->form->getValues());
        $this->confirmForm = new BaseForm();
        return 'Confirm';
      }
    }
    
    return sfView::INPUT;
  }
}