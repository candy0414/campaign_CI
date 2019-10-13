<?php

/**
 * This is the implementation of a small RESTClient based on PHP Curl.
 */
class RESTClient
{
    /**
     * =====================================
     * Properties
     * =====================================.
     */

    /**
     * The URL to call.
     *
     * @var string
     */
    protected $url;

    /**
     * The data send along with the request.
     *
     * @var array
     */
    protected $data;

    /**
     * The Method of the request (POST,GET,DELETE,PUT).
     *
     * @var string
     */
    protected $method;

    /**
     * @var resource
     */
    protected $curl;

    /**
     * The Last Response received.
     *
     * @var string
     */
    protected $lastResponse;

    /**
     * The last HTTP Code received.
     *
     * @var string
     */
    protected $lastHttpCode;

    /**
     * The MicroworkersApiKey.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * ======================
     * Constructors
     * ======================.
     */

    /**
     * @param string $url
     * @param string $method
     * @param array  $data
     */
    public function __construct($url = null, $method = null, $data = null)
    {
        $this->url = $url;
        $this->method = $method;
        $this->data = $data;
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($this->curl, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($this->curl, CURLOPT_FORBID_REUSE, true);
        $this->lastResponse = null;
        $this->lastHttpCode = null;
        $this->apiKey = null;
    }

    /**
     * =======================
     * Getters/Setters
     * =======================.
     */

    /**
     * Set the Api Key.
     *
     * @param $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get the Api Key.
     *
     * @return null|string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set the curl handle.
     *
     * @param $curl
     */
    public function setCurl($curl)
    {
        $this->curl = $curl;
    }

    /**
     * Get the curl handle.
     *
     * @return resource
     */
    public function getCurl()
    {
        return $this->curl;
    }

    /**
     * Set the data.
     *
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get the data currently.
     *
     * @return array|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the last received HTTP Code.
     *
     * @return null|string
     */
    public function getLastHttpCode()
    {
        return $this->lastHttpCode;
    }

    /**
     * Get the plain last response.
     *
     * @return null|string
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * Set the request method.
     *
     * @param $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Get the Request method currently set.
     *
     * @return null|string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set the URL.
     *
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get the URL currently set.
     *
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * ====================
     * Main Functions
     * ====================.
     */

    /**
     * Execute the request.
     */
    public function execute()
    {
        if ($this->apiKey) {
            curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
                "MicroworkersApiKey: $this->apiKey",
            ));
        }

        switch ($this->method) {
            case 'GET':
                $this->executeGET();
                break;
            case 'DELETE':
                $this->executeDELETE();
                break;
            case 'PUT':
                $this->executePUT();
                break;
            case 'POST':
                $this->executePOST();
                break;
        }
    }

    /**
     * Execute the GET request.
     */
    private function executeGET()
    {
        ini_set('max_execution_time', 86400);

        $url = $this->url;

        if (!empty($this->data)) {
            $url .= '?';
            foreach (array_keys($this->data) as $key) {
                $url .= $key.'='.$this->data[$key].'&';
            }
        }
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'GET');

        $this->lastResponse = curl_exec($this->curl);
        $this->lastHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    /**
     * Execute the DELETE Request.
     */
    private function executeDELETE()
    {
        $url = $this->url;
        curl_setopt($this->curl, CURLOPT_URL, $url);

        if ($this->data != null) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($this->data));
        } else {
            // workaround "411 Length Required"
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query(array()));
        }

        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $this->lastResponse = curl_exec($this->curl);
        $this->lastHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    /**
     * Execute the PUT Request.
     */
    private function executePUT()
    {
        $url = $this->url;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        if ($this->data != null) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($this->data));
        } else {
            // workaround "411 Length Required"
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query(array()));
        }
        $this->lastResponse = curl_exec($this->curl);
        $this->lastHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    /**
     * Execute the POST Request.
     */
    private function executePOST()
    {
        $url = $this->url;
        $postData = array();
        $this->http_build_query_for_curl($this->data, $postData);
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $postData);
        $this->lastResponse = curl_exec($this->curl);
        $this->lastHttpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    /**
     * Close the curl handle.
     */
    public function close()
    {
        curl_close($this->curl);
    }

    /**
     * Get the last json response decoded as array.
     *
     * @return mixed
     */
    public function getLastResponseDecoded()
    {
        return json_decode($this->lastResponse, true);
    }

    /**
     * Reset the client.
     */
    public function resetClient()
    {
        $this->url = null;
        $this->method = null;
        $this->data = null;
    }

    /**
     * Flattens the array so that it can be used with curl.
     *
     * @param $arrays
     * @param array $new
     * @param null  $prefix
     */
    private function http_build_query_for_curl($arrays, &$new = array(), $prefix = null)
    {
        if (is_object($arrays)) {
            $arrays = get_object_vars($arrays);
        }

        foreach ($arrays as $key => $value) {
            $k = isset($prefix) ? $prefix.'['.$key.']' : $key;
            if (is_array($value)) {
                $this->http_build_query_for_curl($value, $new, $k);
            } else {
                $new[$k] = $value;
            }
        }
    }
}