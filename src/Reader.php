<?php

namespace Attus\OgReader;

use GuzzleHttp\Client;

/**
 * OG:Reader
 *
 * @author Attila Németh
 * 16.06.2020
 */
class Reader {
  
  // HTTP Client
  private     $_client;
  
  // URL to Read From
  private     $_url;
  
  // OG Values
  private     $_ogValues;
  
  public function __construct(string $url) 
  {
    $this->_url = $url;
    $this->_client = new Client();
  }
  
  public function read(): void 
  {
    $response = $this->_client->read($this->_url);
    var_dump($response);
    die();
  }
  
}
