<?php

return [
    /*
     * This package will look for a GLADE_MERCHANT_KEY in your env file
     * This package will look for GLADE_MERCHANT_ID in your env file
     * This package will look for GLADE_MERCHANT_URL in your env file
     * If the above three are not found. It will throw errors when trying to use
     */
    'merchantkey' => getenv('GLADE_MERCHANT_KEY'),
    'merchantid' => getenv('GLADE_MERCHANT_ID'),
    'paymenturl' => getenv('GLADE_MERCHANT_URL'),

];
