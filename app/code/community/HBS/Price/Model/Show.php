<?php 

class HBS_Price_Model_Show
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => '', 'label'=>Mage::helper('adminhtml')->__('Default')),
            array('value' => 'custom', 'label'=>Mage::helper('adminhtml')->__('Custom')),
            array('value' => 'short', 'label'=>Mage::helper('adminhtml')->__('Short Name')),
            array('value' => 'name', 'label'=>Mage::helper('adminhtml')->__('Name')),
        );
    }

}