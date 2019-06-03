<?php
/**
 * Decorator that inserts debugging hints into the rendered block contents
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Espressobytes\DebugHints\Model\TemplateEngine\Decorator;

class DebugHints implements \Magento\Framework\View\TemplateEngineInterface
{

    private $_subject;

    private $_showDebugHints;

    private $_directoryList;

    /**
     * @param \Magento\Framework\View\TemplateEngineInterface $subject
     * @param bool $showBlockHints Whether to include block into the debugging information or not
     */
    public function __construct(
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList,
        \Magento\Framework\View\TemplateEngineInterface $subject,
        $showDebugHints)
    {
        $this->_subject = $subject;
        $this->_showDebugHints = $showDebugHints;
        $this->_directoryList = $directoryList;
    }

    /**
     * Insert debugging hints into the rendered block contents
     *
     * {@inheritdoc}
     */
    public function render(\Magento\Framework\View\Element\BlockInterface $block, $templateFile, array $dictionary = [])
    {
        $result = $this->_subject->render($block, $templateFile, $dictionary);

        /*
         * cut off template file path:
         */
        $directoryRoot = $this->_directoryList->getRoot();
        $templateFile = str_replace($directoryRoot,"",$templateFile);

        if ($this->_showDebugHints) {
            $result = $this->_renderTemplateHints($result, $templateFile, $block);
        }
        
        return $result;
    }

    /**
     * Insert template debugging hints into the rendered block content
     * @return string
     */
    protected function _renderTemplateHints($blockHtml, $templateFile, \Magento\Framework\View\Element\BlockInterface $block)
    {

        $blockClass = get_class($block);

        $beforeHtml = "<!-- Start Template: $templateFile (BlockClass: $blockClass) -->";
        $afterHtml = "<!-- End Template: $templateFile -->";

        return $beforeHtml . $blockHtml . $afterHtml;

    }

}
