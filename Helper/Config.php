<?php

namespace Espressobytes\DebugHints\Helper;

use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Espressobytes\DebugHints\Helper
 */
class Config
{

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isModuleEnabled()
    {
        return $this->scopeConfig->getValue('espressobytes_debughints/general/is_enabled', ScopeInterface::SCOPE_STORE);
    }

}