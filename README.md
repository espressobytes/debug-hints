# Magento2 Debug-Hints

### Overview

A simple Magento 2 module to show block and template names on the output html.

If the module is enabled, comments are integrated in the html-output at the start and the end of each block:

    <!-- Start Template: /path/to/template.phtml (BlockClass: Vendor\Namespace\Block\Class) -->

        ... html content of block and template ...

    <!-- End Template: /path/to/template.phtml -->

### Installation

    composer require espressobytes/debug-hints --dev

    bin/magento module:enable Espressobytes_DebugHints

    bin/magento setup:up

    php bin/magento cache:clean

### Configuration

- In Admin navigate to: **Stores > Configuration > Espressobytes Modules > Debug Hints**
- Set **Show Frontend Hints** to **Yes**, if you want to show template names in frontend
- Set **Show Adminhtml Hints** to **Yes**, if you want to show template names in adminhtml

### Changelog

v1.1.1: Support for blocks and templates in Adminhtml, show layout-names of blocks
