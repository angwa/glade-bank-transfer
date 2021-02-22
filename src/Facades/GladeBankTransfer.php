<?php

namespace GladeApi\GladeBankTransfer\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This package is written by Angwa Moses
 * 
 * @method static mixed setRequestOptions()
 * @method static mixed setUrl()
 * @method static mixed setMerchantKey()
 * @method static mixed setMerchantId()
 * @method static mixed setApiResponse($appendUrl, $body = [])
 * @method static mixed verifyTransaction($ref)
 * @method static mixed getResponse()
 * @method static mixed makePayment($amount, $business_name=null, $firstname=null,$lastname=null,$email=null)
 *
 * @see \GladeApi\GladeBankTransfer
 */
class GladeBankTransfer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'glade-bank-transfer';
    }
}
