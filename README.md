# Auctions API

Auction API allows you to manage product auctions and get the best price

Actions:
* Create products
* Create buyers
* Add a bid
* Get the best offer made and the winning buyer

## How it works

(Preloaded data for testing)

Products

|#|Name|Price|
|---|---|---|
|1|Product 1|100.00|
|2|Product 2|20.00|
|3|Product 3|145.00|

Buyers

|#|Name|
|---|---|
|1|Buyer 1|
|2|Buyer 2|
|3|Buyer 3|

Bids

|#|product_id|buyer_id|amount|
|---|---|---|---|
|1|1|1|20.00|
|2|1|2|99.00|
|3|1|3|105.00|

Winner Offer for Product 1: 
```sh
GET http://auctions-api.test:8080/api/bid/1/result

Expected Response:

{
    "product": {
        "name": "Test product",
        "price": 100.00
    },
    "total_bids": 3,
    "winning_bid": {
        "buyer": "Buyer3",
        "amount": 105.00
    }
}
```

## Principles applied

* Clean code
* SOLID principles
* Design patterns
* Error handling
* Unit testing
* Hexagonal architecture

## Project set up

Prerequisites:
* Docker
* Composer
* 
Install and run the application.
```sh
git clone https://github.com/adolfoaguirrem/auctions-api.git
cd auctions-api
composer install
docker/up
```

## Examples of the use of the application.

```sh
POST http://auctions-api.test:8080/api/product

Json:
{
    "name": "New Product",
    "price": 100.00
}
```

```sh
POST http://auctions-api.test:8080/api/buyer

Json:
{
    "name": "New Buyer",
}
```

```sh
POST http://auctions-api.test:8080/api/bid

Json:
{
    "productId" : 1,
    "buyerId" : 1,
    "amount" : 200.00
}
```

```sh
GET http://auctions-api.test:8080/api/bid/1/result

Json:
{
    "productId" : 1,
    "buyerId" : 1,
    "amount" : 200.00
}
```

## Run Test

```sh
php bin/phpunit
```

Functional: 
* testAuctionResultService

Unit:
* testExecuteWithNoBids
* testAddBid
* testAddBidWithNegativeAmount
* testCreateProduct
* testBuyerConstructor
* testBuyerSetName
* testProductConstructor
* testProductSetName
* testProductSetPrice
