# Glade Pay - Bank Transfer in Laravel

This package will enable customers make payment with bank transfer using Glade Api. This package uses [Guzzle](https://docs.guzzlephp.org/)).  Guzzle is a PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services.


## Installation and usage

This package requires PHP 7.2 and Laravel 7.* or higher.  

You can install the package via composer:

```bash
composer require angwa/glade-bank-transfer
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

    return GladeBankTransfer::verifyTransaction("GP679268020210221M");


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

