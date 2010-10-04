<?php

class HBS_Price_Model_Price extends Mage_Directory_Model_Currency
{

	 /**
     * Apply currency format to number with specific rounding precision
     *
     * @param   float $price
     * @param   int $precision
     * @param   array $options
     * @param   bool $includeContainer
     * @param   bool $addBrackets
     * @return  string
     */
    public function formatPrecision($price, $precision, $options=array(), $includeContainer = true, $addBrackets = false)
    {
        if (!isset($options['precision'])) {
            $options['precision'] = $precision;
        }
        if ($includeContainer) {
            return '<span class="price">' . ($addBrackets ? '[' : '') . $this->formatTxt($price, $options) . ($addBrackets ? ']' : '') . '</span>';
        }
        return $this->formatTxt($price, $options);
    }

    public function formatTxt($price, $options=array())
    {
        if (!is_numeric($price)) {
            $price = Mage::app()->getLocale()->getNumber($price);
        }
        /**
         * Fix problem with 12 000 000, 1 200 000
         *
         * %f - the argument is treated as a float, and presented as a floating-point number (locale aware).
         * %F - the argument is treated as a float, and presented as a floating-point number (non-locale aware).
         */
        $price = sprintf("%F", $price);
        //Custom Symbol.
        $currencySymbol = Mage::getStoreConfig('price/price/currency');
        //Custom position.
        $currencySymbolPosition = Mage::getStoreConfig('price/price/show');
        
        if(!empty($currencySymbolPosition)){
            switch($currencySymbolPosition){
                case 'l' : $options['position'] = Zend_Currency::LEFT; break;
                case 'r' : $options['position'] = Zend_Currency::RIGHT; break;
            }
        }
        //Precision
        $currencyPrecision = Mage::getStoreConfig('price/price/precision');
        
        if(!(empty($currencyPrecision))){
            $options['precision'] = (int) $currencyPrecision;
        }
        //Custom currency Symbol.
        $currencyFormat = Mage::getStoreConfig('price/price/display');
        
        if($currencyFormat == 'custom'){
            !empty($currencySymbol) ? $options['symbol'] = $currencySymbol : false;
        }
        
        switch($currencyFormat) {
            case '' 	  :
            case 'short'  : $options['display'] = Zend_Currency::USE_SHORTNAME; break;
            case 'name'   : $options['display'] = Zend_Currency::USE_NAME; break;
        }
        //Position.
        /*
        $options = array(
            'position'  => Zend_Currency::STANDARD,
            'format'    => null,
            'display'   => Zend_Currency::USE_SHORTNAME,
            'precision' => 4,
            'name'      => 'Dinars tunisiens ',
            'currency'  => 'Dinars ',
            'symbol'    => 'D '
        );*/
        return  Mage::app()->getLocale()->currency($this->getCode())->toCurrency($price, $options);
        //retur$price;
    }


}