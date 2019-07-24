<?php
/**
 * Hamo - PHP class for working with the payment system QIWI webhook
 * Class Version 0.5
 * PHP Version 7.3
 *
 * @author    Vinogradov Victor <victor@eslavon.ru>
 * @copyright 2019 Vinogradov Victor
 * @copyright 2019 Eslavon Creative Studio
 * @note      This program is distributed in the hope that it will be useful. 
 */
 
class Hamo
{
    /**
    * QIWI API Access URL
    *
    * @var string
    */	
    private $api = 'https://edge.qiwi.com/payment-notifier/v1/';
	
    /**
    * Token access to QIWI API
    *
    * @var string
    */
    private $token;
	 
    /**
    * Constructor.
    *
    * @param string $token access to QIWI API
    */	
    public function __construct($token)
    {
        $this->token = $token;
    }
	
    /**
    * API Request.
    *
    * @param string $param request parameters
    * @param int $type request type
    *
    * @return string
    */	    
    private function request($param,$type)
    {
        $ch = curl_init();
        $url = $this->api.$param;
        curl_setopt($ch, CURLOPT_URL, $url);
        switch ($type)
        {
            case 1:
              curl_setopt($ch, CURLOPT_PUT, true);
              break;
            case 2:
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
              break;
            case 3:
              curl_setopt($ch, CURLOPT_POST, 1);
              break;
         }
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->token,]);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result ;		
      }
	
    /**
    * Register a webhook handler.
    *
    * @param string $urlHook The URL of the web processing server.
    * @param int $txnType The type of transaction for which notifications will be included.
    * Option:0 - incoming transactions only, 1 - outgoing transactions only, 2 - all Transactions
    *
    * @return string
    */	
    public function setHook($urlHook,$txnType = 1)
    {
        $urlHook = urlencode($urlHook);
        $param = 'hooks?hookType=1&param='.$urlHook.'.&txnType='.$txnType;	
        $result = $this->request($param,1);
        return $result;
	  }
	
    /**
    * Active Web Hook Details.
    *
    * @return string
    */		
    public function getHook()
    {
        $param = 'hooks/active';
        $result = $this->request($param,0);
        return $result;
    }
	
    /**
    * Remove webhook.
    *
    * @param string $hookId UUID web hook
    *
    * @return string
    */
    public function delHook($hookId)
    {
        $param = 'hooks/'.$hookId;
        $result = $this->request($param,2);
        return $result;
    }
	
    /**
    * Getting the secret key
    *
    * @param string $hookId UUID web hook
    *
    * @return string
    */
    public function getKey($hookId)
    {
		    $param = 'hooks/'.$hookId.'/key';
		    $result = $this->request($param,0);
		    return $result;
    }
	
    /**
    * Change secret key
    *
    * @param string $hookId UUID web hook
    *
    * @return string
    */
    public function newKey($hookId)
    {
        $param = 'hooks/'.$hookId.'/newkey';
        $result = $this->request($param,3);
        return $result;
    }	
}
