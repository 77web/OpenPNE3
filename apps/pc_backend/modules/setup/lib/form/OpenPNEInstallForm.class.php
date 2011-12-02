<?php

class OpenPNEInstallForm extends BaseForm
{
  public function configure()
  {
    //database settings
    $dbms = array('mysql'=>'mysql', 'postgres'=>'postgres(not supported)', 'sqlite'=>'sqlite(not supported)');
    $this->setWidget('dbms', new sfWidgetFormChoice(array('choices'=>$dbms)));
    $this->setValidator('dbms', new sfValidatorChoice(array('choices'=>array_keys($dbms))));
    
    $this->setWidget('dbhost', new sfWidgetFormInput(array('default'=>'127.0.0.1')));
    $this->setValidator('dbhost', new sfValidatorString());
    
    $this->setWidget('dbuser', new sfWidgetFormInput(array('default'=>'openpne')));
    $this->setValidator('dbuser', new sfValidatorString());
    
    $this->setWidget('dbpass', new sfWidgetFormInput(array('default'=>'password')));
    $this->setValidator('dbpass', new sfValidatorString());
    
    $this->setWidget('dbname', new sfWidgetFormInput(array('default'=>'openpne')));
    $this->setValidator('dbname', new sfValidatorString());
    
    //first administrator settings
    $this->setWidget('first_admin_username', new sfWidgetFormInput(array('default'=>'admin')));
    $this->setValidator('first_admin_username', new sfValidatorString());
    
    $this->setWidget('first_admin_password', new sfWidgetFormInput(array('default'=>'password')));
    $this->setValidator('first_admin_password', new sfValidatorString());
    
    //first user settings
    $this->setWidget('first_user_email', new sfWidgetFormInput(array('default'=>'sns@example.com')));
    $this->setValidator('first_user_email', new sfValidatorEmail());
    $this->setWidget('first_user_password', new sfWidgetFormInput(array('default'=>'password')));
    $this->setValidator('first_user_password', new sfValidatorString());
    
    //plugins
    $plugins = array('opAuthMailAddressPlugin'=>'opAuthMailAddressPlugin', 'opCommunityTopicPlugin'=>'opCommunityTopicPlugin', 'opDiaryPlugin'=>'opDiaryPlugin'); //PENDING: get list of bundled plugins
    $this->setWidget('plugins', new sfWidgetFormChoice(array('expanded'=>true, 'multiple'=>true, 'choices'=>$plugins)));
    $this->setValidator('plugins', new sfValidatorChoice(array('multiple'=>true, 'choices'=>array_keys($plugins))));
    
    
    //i18n & name format
    $this->getWidgetSchema()->setNameFormat($this->getName().'[%s]');
    $this->getWidgetSchema()->getFormFormatter()->setTranslationCatalogue('form_install');
  }
  
  public function getName()
  {
    return 'install';
  }
}