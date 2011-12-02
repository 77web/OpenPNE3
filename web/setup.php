<?php

$projectConfiguration = dirname(__FILE__).'/../config/ProjectConfiguration.class.php';

if(file_exists($projectConfiguration))
{
  die('OpenPNE is already installed!');
}


require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfImageHandlerPlugin');
  }
}

class sfDoctrineRouteCollection extends sfRouteCollection
{
}

class sfDoctrineRoute extends sfRoute
{
}

class BaseMember
{
}

$configuration = ProjectConfiguration::getApplicationConfiguration('pc_backend', 'setup', true);
sfContext::createInstance($configuration)->dispatch();