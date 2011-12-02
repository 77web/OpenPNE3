<?php
$configPath = dirname(__FILE__).'/../config/';
$dummyPath = $configPath.'setup.txt';

if(!file_exists($dummyPath))
{
  die('OpenPNE is already installed!');
}

$projectConfigurationPath = $configPath.'ProjectConfiguration.class.php';

$dummyProjectConfigurationClass = file_get_contents($configPath.'setup.txt');

file_put_contents($projectConfigurationPath, $dummyProjectConfigurationClass);

require_once $projectConfigurationPath;

$configuration = ProjectConfiguration::getApplicationConfiguration('pc_backend', 'setup', true);
sfContext::createInstance($configuration)->dispatch();