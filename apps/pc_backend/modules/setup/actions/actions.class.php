<?php

class setupActions extends sfActions
{
  public function preExecute()
  {
    if('setup' !== sfConfig::get('sf_environment'))
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
        
        $install = $this->getUser()->getAttribute('setup_install');
        
        $fileSystem = new sfFileSystem();
        $root = sfConfig::get('sf_root_dir');
        //PENDING: receive manual setting and reflect it to config/OpenPNE.yml
        $fileSystem->copy($root.'/config/OpenPNE.yml.sample', $root.'/config/OpenPNE.yml');
        $fileSystem->copy($root.'/config/ProjectConfiguration.class.php.sample', $root.'/config/ProjectConfiguration.class.php');
        
        $plugins = $this->form->getAllPluginList();
        $selectedPlugins = (array)$install['plugins'];
        $pergedPlugins = array();
        foreach($plugins as $name)
        {
          if(!in_array($name, $selectedPlugins))
          {
            $pergedPlugins[$name] = array('install'=>false);
          }
        }
        file_put_contents(sfConfig::get('sf_config_dir').'/plugins.yml', sfYaml::dump($pergedPlugins));
        
        //PENDING: reflect first administrator settings. update fixture
        
        //PENDING: reflect first user settings. update fixture
        
        //PENDING: run fast-install command here
        $settings = array();
        $settings['dbms'] = $install['dbms'];
        $settings['dbuser'] = $install['dbuser'];
        $settings['dbpassword'] = $install['dbpass'];
        $settings['dbhost'] = $install['dbhost'];
        $settings['dbname'] = $install['dbname'];
        
        spl_autoload_register('setupActions::autoload');

        chdir(sfConfig::get('sf_root_dir'));
        
        $configuration = $this->getContext()->getConfiguration();
        $dispatcher = $configuration->getEventDispatcher();
        $task = new OpenPNEFastInstallTask($dispatcher, new sfFormatter());
        $task->run(array(), $settings);
        
        $this->getUser()->setAttribute('setup_install', null);
        $this->getUser()->setFlash('notice', 'Install complete!');
        
        //PENDING: remove config/setup.txt here
        //$filesystem->remove(sfConfig::get('sf_config_dir').'/setup.txt');
        
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
  
  public static function autoload($class)
  {
    if(false !== strpos($class, 'Task'))
    {
      require_once sfConfig::get('sf_lib_dir').'/vendor/symfony/lib/plugins/sfDoctrinePlugin/lib/task/'.$class.'.class.php';
    }
  }
}