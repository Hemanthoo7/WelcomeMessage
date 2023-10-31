<?php 

namespace Dcw\WelcomeMessage\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

class ProductsWelcomeMessage extends Template
{
    protected $customerSession;    
    
    public function __construct(
        Context $context,
        Registry $registry,
        CustomerSession $customerSession,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }    
    
    public function isConfigurableProduct()
    {
        $product = $this->registry->registry('current_product');
        if ($product->getTypeId() == 'configurable') {
            return true;
        }

        return false;
    }

    public function isLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }

    public function getWelcomeMessage()
    {
        if ($this->isConfigurableProduct()) {
            return "Welcome back to our store !";
        }
    }   
}
