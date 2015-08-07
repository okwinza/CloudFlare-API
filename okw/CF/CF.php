<?php

namespace okw\CF;

use okw\CF\Exception\BadResponseException;
use okw\CF\Exception\CFException;
use okw\CF\Exception\DecodeException;
use okw\CF\Exception\HttpException;

/**
* CloudFlare API Library
* @link http://github.com/okwinza/cloudflare-api
* @author Oleg Krasavin <okwinza@gmail.com>
*/
class CF {

    protected $email;
    protected $token;
    protected $host_key;
    protected $mode = 'client';
    protected $apiUrl = array('client' => 'https://www.cloudflare.com/api_json.html',
                                'host' => 'https://api.cloudflare.com/host-gw.html');

    protected $curlTimeout = 30;
    protected $curlConnectTimeout = 30;

    /**
     * @throws CFException
     */
    public function __construct() {

        if (!extension_loaded('curl')) {
            throw new CFException('Curl must be installed to use this library.', CFException::CURL_NOT_FOUND);
        }

        $args = func_get_args();
        switch (func_num_args()) {
            case 1:
                $this->mode = 'host';
                $this->host_key = $args[0];
                break;
            case 2:
                $this->mode = 'client';
                $this->email     = $args[0];
                $this->token     = $args[1];
                break;
        }
    }

    /**
     * Magic method for calling API methods
     * @param string $method
     * @param array  $arguments
     *
     * @return array
     **/
    public function __call($method, $arguments) {
        $params = (is_array($arguments[0]) ? $arguments[0] : array());
        return $this->post($method, $params);
    }

    /**
     *
     * @param string $method
     * @param array  $params
     *
     * @return array
     */
    public function post($method, $params = array()) {
        return $this->executeRequest($this->buildRequestParams($method, $params));
    }

    /**
     * @param $timeout
     */
    public function setRequestTimeout($timeout) {
        $this->curlTimeout = $timeout;
    }

    /**
     * @param $timeout
     */
    public function setConnectTimeout($timeout) {
        $this->curlConnectTimeout = $timeout;
    }

    /**
     * @param $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param $token
     */
    public function setToken($token) {
        $this->token = $token;
    }

    /**
     * @param $host_key
     */
    public function setHostKey($host_key) {
        $this->host_key = $host_key;
    }


    /**
     * Building parameters array
     * @param string $method
     * @param array  $parameters
     *
     * @return array
     */
    private function buildRequestParams($method, $parameters = array()) {

        switch ($this->mode) {
            case 'client':
                $parameters['email'] = $this->email;
                $parameters['tkn']   = $this->token;
                $parameters['a']     = $method;
                break;
            case 'host':
                $parameters['host_key'] = $this->host_key;
                $parameters['act']      = $method;
                break;
        }


        return $parameters;
    }

    /**
     * @param array $parameters
     * @return mixed
     *
     * @throws CFException
     * @throws \HttpException
     * @throws DecodeException
     * @throws BadResponseException
     *
     * @return array
     */
    private function executeRequest($parameters = array()) {

        $curl_options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_CONNECTTIMEOUT => $this->curlTimeout,
            CURLOPT_TIMEOUT        => $this->curlConnectTimeout,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $parameters,
            CURLOPT_URL            => $this->apiUrl[$this->mode]
        );

        $ch = curl_init();
        curl_setopt_array($ch, $curl_options);

        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($curl_error = curl_error($ch)) {
            throw new CFException($curl_error, CFException::CURL_ERROR);
        }

        $json_decode = json_decode($result, true);
        curl_close($ch);

        // Handling API errors
        if ((is_array($json_decode) && !empty($json_decode['err_code'])) || $json_decode['result'] == 'error') {
            throw new BadResponseException($json_decode['msg']);
        }
        if ($http_code !== 200) {
            throw new \HttpResponseException('HTTP Non-200 response', $http_code);
        }
        if (json_last_error() !== \JSON_ERROR_NONE) {
            throw new DecodeException('JSON decoding error', json_last_error());
        }

        return $json_decode;
    }
}
