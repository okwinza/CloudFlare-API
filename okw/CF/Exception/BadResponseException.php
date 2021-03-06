<?php

/**
 * CloudFlare API Library
 * @link http://github.com/okwinza/cloudflare-api
 * @author Oleg Krasavin <okwinza@gmail.com>
 */
namespace okw\CF\Exception;


class BadResponseException extends \Exception {

    const CURL_NOT_FOUND = 1;
    const CURL_ERROR = 3;

}
