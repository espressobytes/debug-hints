<?php

namespace Espressobytes\DebugHints\Model\TemplateEngine\Plugin;

use Espressobytes\DebugHints\Helper\Config;
use Espressobytes\DebugHints\Model\TemplateEngine\Decorator\DebugHintsFactory;
use Magento\Framework\View\TemplateEngineFactory;
use Magento\Framework\View\TemplateEngineInterface;

class DebugHintsFrontend
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
            'showDebugHints' => (bool)$this->config->showFrontendHints(),
        ]);
    }
}
