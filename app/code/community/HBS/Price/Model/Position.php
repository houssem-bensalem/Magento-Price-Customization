<?php 

class HBS_Price_Model_Position
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'l', 'label'=>Mage::helper('adminhtml')->__('Left')),
            array('value' => 'r', 'label'=>Mage::helper('adminhtml')->__('Right')),
        );
    }

}