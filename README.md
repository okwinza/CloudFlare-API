# CloudFlare API #
A small, compact but flexible API library for popular CDN provider [CloudFlare](http://cloudflare.com) written in PHP.

Supports both HOST and CLIENT APIs.

[CloudFlare Client API documentation](https://www.cloudflare.com/docs/client-api.html)

[CloudFlare Hosting Provider API documentation](http://www.cloudflare.com/docs/host-api.html)

## HOW TO ##

* Get yourself an API key. You can grab one [here](https://www.cloudflare.com/my-account).
* Replace {EMAIL} and {TOKEN} with your real data.
* Start coding.

## Example ##
You can find some demo code in /examples dir. It will show you how to handle this piece of free software.

But still, here is the basics:

If you want to use CLIENT API then instantiate API object like this:

```
$cf = new okw\CF("{EMAIL}","{TOKEN}");

```

Oterwise just pass your {HOST_KEY} into constructor:

```
$cf = new okw\CF("{HOST_KEY}");

```
And start making requests:

```
    $response = $cf->rec_new(array(
        'z' => 'okwinza.ru',
        'name' => 'new.okwinza.ru',
        'ttl' => 1,
        'type' => 'A',
        'content' => '1.2.3.4'
    ));

```

Also, you can always change current EMAIL/TOKEN/HOST_KEY values:
```
$cf->setEmail($email);
$cf->setToken($token);
$cf->setHostKey($host_key);

```
So there is no need to re-instantiate the object.


## Installation ##
You can install `cloudflare-api` via [Composer](http://getcomposer.org/)
```
"require": {
    "okwinza/cloudflare-api": "dev-master"
}
```
  
Or by simple `require`.

## Support ##
vk: [okwinza](https://vk.com/okwinza) 

email: <okwinza@gmail.com>  

 
