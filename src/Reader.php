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
    $response = $this->_client->get($this->_url);
    if ($response->getStatusCode() == '200') {
      $body = (string)$response->getBody();
      libxml_use_internal_errors(true);
      $dom = new \DOMDocument();
      $dom->loadHTML($body);
      $metas = $dom->getElementsByTagName('meta');
      $matches = [];
      $this->_ogValues = [];
      for ($i = 0; $i < $metas->length; $i++) {
        if (preg_match('/^og\:(.*?)$/', $metas->item($i)->getAttribute('property'), $matches)) {
          $this->_ogValues[$matches[1]] = $metas->item($i)->getAttribute('content');
        }
      }
    }
  }
  
  /**
   * All OG:Values of this web site
   * @return array
   */
  public function getValues(): array
  {
    return $this->_ogValues;
  }
  
  /**
   * A Single OG:Value
   * @param type $name
   * @return string
   */
  public function getValue($name): string
  {
    if (array_key_exists($name, $this->_ogValues)) {
      return $this->_ogValues[$name];
    }
    else {
      return NULL;
    }
  }
  
}
