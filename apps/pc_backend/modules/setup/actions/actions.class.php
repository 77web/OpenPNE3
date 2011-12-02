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
        try
        {
          $request->checkCSRFProtection();
        }
        catch(Exception $e)
        {
          $this->getUser()->setAttribute('setup_install');
          $this->redirect('/setup.php/setup');
        }
        
        $fileSystem = new sfFileSystem();
        $root = sfConfig::get('sf_root_dir');
        //PENDING: receive manual setting and reflect it to config/OpenPNE.yml
        $fileSystem->copy($root.'/config/OpenPNE.yml.sample', $root.'/config/OpenPNE.yml');
        $fileSystem->copy($root.'/config/ProjectConfiguration.class.php.sample', $root.'/config/ProjectConfiguration.class.php');
        
        //PENDING: create plugins.yml here
        
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