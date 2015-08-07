# CloudFlare API #
[![Latest Stable Version](https://poser.pugx.org/okwinza/cloudflare-api/v/stable)](https://packagist.org/packages/okwinza/cloudflare-api) 
[![Total Downloads](https://poser.pugx.org/okwinza/cloudflare-api/downloads)](https://packagist.org/packages/okwinza/cloudflare-api) 
[![Latest Unstable Version](https://poser.pugx.org/okwinza/cloudflare-api/v/unstable)](https://packagist.org/packages/okwinza/cloudflare-api) 
[![License](https://poser.pugx.org/okwinza/cloudflare-api/license)](https://packagist.org/packages/okwinza/cloudflare-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/okwinza/cloudflare-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/okwinza/cloudflare-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/okwinza/CloudFlare-API/badges/coverage.png?b=integrate-tests)](https://scrutinizer-ci.com/g/okwinza/CloudFlare-API/?branch=integrate-tests)
[![Build Status](https://travis-ci.org/okwinza/CloudFlare-API.svg)](https://travis-ci.org/okwinza/CloudFlare-API)

A small, compact but flexible API library for popular CDN provider [CloudFlare](http://cloudflare.com) written in PHP.

Supports both HOST and CLIENT APIs.

## Docs ##

[CloudFlare Client API documentation](https://www.cloudflare.com/docs/client-api.html)   
[CloudFlare Hosting Provider API documentation](http://www.cloudflare.com/docs/host-api.html)

## HOW TO ##

* Get yourself an API key. You can grab one [here](https://www.cloudflare.com/my-account).
* Replace {EMAIL} and {TOKEN} with your real data.
* Start coding.

## Example ##
You can find some demo code in /examples dir.

But still, here are the basics:

If you want to use CLIENT API then instantiate API object like this:

```
$cf_api_client = new CF("{EMAIL}","{TOKEN}");

```

Otherwise just pass your {HOST_KEY} to the constructor:

```
$cf_api_client = new CF("{HOST_KEY}");

```
And start making requests:

```
    $response = $cf_api_client->rec_new(array(
        'z' => 'yoursite.com',
        'name' => 'new.yoursite.com',
        'ttl' => 1,
        'type' => 'A',
        'content' => '1.2.3.4'
    ));

```

Note: `rec_new` is a name of api method listed in [docs](https://github.com/okwinza/CloudFlare-API#docs)

Also, you can change your current EMAIL/TOKEN/HOST_KEY values at any time without re-creating the object:

```
$cf_api_client->setEmail($email);
$cf_api_client->setToken($token);
$cf_api_client->setHostKey($host_key);

```


## Installation ##
You can install `cloudflare-api` via [Composer](http://getcomposer.org/):

```
composer require okwinza/cloudflare-api
```
  
Or by simple `require`.

## Support ##
vk: [okwinza](https://vk.com/okwinza)  
email: <okwinza@gmail.com>

 
