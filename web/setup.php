<?php
//WEBインストーラーの使い方
//1.SNSを運用したい独自ドメインのドキュメントルートを/path/to/OpenPNE3/webに向くようにします。
//2.http://(独自ドメイン)/setup.php/setupにアクセスします
//3.フォームに必要事項を入力し、内容を確認してインストール実行ボタンをクリックします
//4.インストール完了！（を目指している途中です…まだ未完成。）


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