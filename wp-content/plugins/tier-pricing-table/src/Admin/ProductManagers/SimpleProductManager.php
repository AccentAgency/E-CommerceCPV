<?php

namespace TierPricingTable\Admin\ProductManagers;

use  TierPricingTable\PriceManager ;
use  WC_Product ;
/**
 * Class SimpleProductManager
 *
 * @package TierPricingTable\Admin\Product
 */
class SimpleProductManager extends ProductManagerAbstract
{
    /**
     * Register hooks
     */
    protected function hooks()
    {
        add_action( 'woocommerce_product_options_pricing', [ $this, 'renderPriceRules' ] );
        add_action( 'save_post_product', [ $this, 'updatePriceRules' ] );
    }
    
    /**
     * Update price quantity rules for simple product
     *
     * @param int $product_id
     */
    public function updatePriceRules( $product_id )
    {
        
        if ( isset( $_POST['tiered_price_fixed_quantity'] ) ) {
            $amounts = $_POST['tiered_price_fixed_quantity'];
            $prices = ( !empty($_POST['tiered_price_fixed_price']) ? $_POST['tiered_price_fixed_price'] : [] );
            PriceManager::updateFixedPriceRules( $amounts, $prices, $product_id );
        }
    
    }
    
    /**
     * Render inputs for price rules on simple product
     *
     * @global WC_Product $product_object
     */
    public function renderPriceRules()
    {
        global  $product_object ;
        
        if ( $product_object instanceof WC_Product ) {
            $type = PriceManager::getPricingType( $product_object->get_id() );
            $this->fileManager->includeTemplate( 'admin/add-price-rule-simple.php', [
                'price_rules_fixed'      => PriceManager::getFixedPriceRules( $product_object->get_id() ),
                'price_rules_percentage' => PriceManager::getPercentagePriceRules( $product_object->get_id() ),
                'type'                   => $type,
                'isFree'                 => $this->licence->isFree(),
            ] );
        }
    
    }

}