<?php

namespace Espressobytes\DebugHints\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
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
    public function showFrontendHints()
    {
        return $this->scopeConfig->getValue('espressobytes_debughints/general/show_frontend_hints', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return bool
     */
    public function showAdminhtmlHints()
    {
        return $this->scopeConfig->getValue('espressobytes_debughints/general/show_adminhtml_hints', ScopeInterface::SCOPE_STORE);
    }

}