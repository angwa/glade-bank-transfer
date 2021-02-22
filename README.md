# Glade Pay - Bank Transfer Option in Laravel

This package will enable customers make payment with bank transfer using Glade Api. This package uses [Guzzle](https://docs.guzzlephp.org/).  Guzzle is a PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services.


## Installation and usage

This package requires PHP 7.2 and Laravel 7.* or higher.  

You can install the package via composer:

```bash
composer require angwa/glade-bank-transfer
```
Next step is to register our service providers. Simply open ```config/app.php``` and locate  providers section and add  ```GladeApi\GladeBankTransfer\GladeServiceProvider::class,``` Like below
```
'providers' => [
    ...
    GladeApi\GladeBankTransfer\GladeServiceProvider::class,
    ...
]

```

Go down still inside ```config/app.php``` and place ```'GladeBankTransfer' => GladeApi\GladeBankTransfer\Facades\GladeBankTransfer::class,``` in the ```aliases``` section like below

```
'aliases' => [
    ...
    'GladeBankTransfer' => GladeApi\GladeBankTransfer\Facades\GladeBankTransfer::class,
    ...
]
```
The ablove code will enable use ```use GladeBankTransfer``` in our controllers

### Load Configuration file
Our configuration file is named glade.php and will be created when you run the bash code below
```bash
php artisan vendor:publish --provider="GladeApi\GladeBankTransfer\GladeServiceProvider"

```

You can also copy the code below, create a file named glade.php in the config folder and paste
```
<?php

return [
    /*
     * This package will look for a GLADE_MERCHANT_KEY in your env file
     * This package will look for GLADE_MERCHANT_ID in your env file
     * This package will look for GLADE_MERCHANT_URL in your env file
     * If the above three are not found. It might throw errors when trying to use
     */
    'merchantKey' => getenv('GLADE_MERCHANT_KEY'),
    'merchantId' => getenv('GLADE_MERCHANT_ID'),
    'paymentUrl' => getenv('GLADE_MERCHANT_URL'),

];

```
## Usage

### Tutorials
For a detailed description and documentation of Glade Api, please see the:
- [Glade API Reference](https://developer.glade.ng/docs/#getting-started)


### Description
This package will require your MerchantID and Merchant Key for authentification. Demo MerchantId and Merchant key can be found in the [Glade API Reference Page](https://developer.glade.ng/docs/#getting-started) and looks like the ones below: 

```
Merchant ID: GP0000001
Merchant Key: 123456789
```

If you want to change the demo endpoint to live Please Use the merchant id and merchant key located in your Glade dashboard:
[Glade API ](https://developer.glade.ng/docs/#getting-started)

### Using Demo account
Add the following lines to your env file:
```
GLADE_MERCHANT_KEY=123456789
GLADE_MERCHANT_ID=GP0000001
GLADE_MERCHANT_URL=https://demo.api.gladepay.com
```

Remember: Everytime you make changes to your env file, you have to run 
```
php artisan cache:clear
php artisan config:cache
``` 
Add the following line to your controller or where you want to use it
```
use GladeBankTransfer;
```
#### Examples:
To Make payment, simply call the ```makePayment()``` method in your controller
```

//For Example
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GladeBankTransfer;

class TestGladeApi extends Controller
{
    public function test()
    {
    //compulsary parameter is amount
        $amount = "5999";
     
     //return json response
    return GladeBankTransfer::makePayment($amount);

    return GladeBankTransfer::verifyTransaction("GP679268020210221M");


    }
}

```
#### Sample response for payment:
```
 {"status":202,"txnRef":"GP88405170320210221S","auth_type":"device","accountNumber":"9922554842","accountName":"GladePay Demo","bankName":"Providus Bank","accountExpires":600,"message":"Make a transfer into the following account using your bank app or internet banking platfrom to complete the transaction"}
 ```

#### Multiple Details on parameter: 
Our ```makePayment()``` method have other parameters that  you may like to use which are not compulsary

```
//For example
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GladeBankTransfer;

class TestGladeApi extends Controller
{
    public function test()
    {
    //compulsary parameter is amount
     $amount = "5999";
     $firstname = "John";
     $lastname = "Doe";
     $email = "johndoe@mail.com";
     $business_name = "my business name";

     //return json response 
    return GladeBankTransfer::makePayment($amount,$firstname,$lastname,$email,$business_name);

    }
}
```

#### Verifying Transaction:
To verify transaction, Please use the ```verifyTransaction()``` method.
This method have one parameter and its the reference number for verifying transaction
```
for example
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GladeBankTransfer;

class TestGladeApi extends Controller
{
    public function testVerify()
    {
    //compulsary parameter is reference
    //You can use reference number you got after payment or use one below
     $reference = "GP679268020210221M";

     //return json response    
    return GladeBankTransfer::verifyTransaction($reference);
    }
}
```  
### Sample Response for verification
```
{"status":200,"txnStatus":"pending","txnRef":"GP88405170320210221S","message":"PENDING","chargedAmount":0,"currency":"NGN","payment_method":"bank_transfer","fullname":" ","email":"","bank_message":"Awaiting Validation"}
```

## Testing

Run the tests with:

``` bash
composer test
```

### Security

If you discover any security related issues, please email angwamoses@gmail.com instead of using the issue tracker.

## Credits

- [Angwa Moses](https://github.com/angwa)


## License

The MIT License (MIT).

