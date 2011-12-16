<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class myUser extends opSecurityUser
{
  
  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    parent::initialize($dispatcher, $storage, $options);
    
    if(sfContext::getInstance()->getRequest()->hasParameter('op_layout'))
    {
      $layout = sfContext::getInstance()->getRequest()->getParameter('op_layout')=='pc' ? 'pc' : 'smartphone';
      $this->setPreferredLayout($layout);
    }
  }

  public function setPreferredLayout($layout = 'pc')
  {
    $this->setAttribute('preferred_layout', $layout);
  }
  
  public function getPreferredLayout()
  {
    return $this->getAttribute('preferred_layout', sfContext::getInstance()->getRequest()->isSmartphone() ? 'smartphone' : 'pc');
  }
}
