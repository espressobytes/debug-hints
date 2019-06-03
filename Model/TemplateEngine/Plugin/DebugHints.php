<?php

namespace Espressobytes\DebugHints\Model\TemplateEngine\Plugin;

use Espressobytes\DebugHints\Helper\Config;
use Espressobytes\DebugHints\Model\TemplateEngine\Decorator\DebugHintsFactory;
use Magento\Framework\View\TemplateEngineFactory;
use Magento\Framework\View\TemplateEngineInterface;

class DebugHints
{

    /**
     * @var DebugHintsFactory
     */
    protected $debugHintsFactory;

    /**
     * @var Config 
     */
    protected $config;
    
    /**
     * XPath of configuration of the debug hints
     *
     * Allowed values:
     *     dev/debug/template_hints_storefront
     *     dev/debug/template_hints_admin
     *
     * @var string
     */
    protected $debugHintsPath;

    /**
     * DebugHints constructor.
     * @param DebugHintsFactory $debugHintsFactory
     */
    public function __construct(
        DebugHintsFactory $debugHintsFactory,
        Config $config
    )
    {
        $this->debugHintsFactory = $debugHintsFactory;
        $this->config = $config;
    }

    /**
     * Wrap template engine instance with the debugging hints decorator, depending of the store configuration
     *
     * @param TemplateEngineFactory $subject
     * @param TemplateEngineInterface $invocationResult
     *
     * @return TemplateEngineInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterCreate(
        TemplateEngineFactory $subject,
        TemplateEngineInterface $invocationResult
    )
    {
        return $this->debugHintsFactory->create([
            'subject' => $invocationResult,
            'showDebugHints' => (bool)$this->config->isModuleEnabled(),
        ]);
    }
}
