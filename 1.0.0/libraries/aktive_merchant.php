<?php

class Aktive_merchant
{
	/**
	* The CodeIgniter Instance
	*/
	protected $_ci;

	/**
	* The Payment Gateway
	*/	
	private $_gateway;

	/**
	* Payment Gateway Options
	*/	
	protected $_options;

	/**
	* The CC Info for This Transaction
	*/	
	protected $_cc;

	/**
	* The Constructor Function
	*/	
	public function __construct()
	{
		$this->_ci = get_instance();
		$this->_ci->load->config('merchants', true);
		require_once('lib/merchant.php');
		Merchant_Billing_Base::mode($this->_ci->config->item('aktive-merchant_mode'));
	}
	
	/**
	* Try to do a payment
	* @param	string	The name of the gateway to call
	* @param	array	Info for credit card
	* @param	array	Options for the transaction
	*/	
    public function try_payment($gateway, $amount, $gateway_function, $cc_info, $options = array())
    { 	

	
    	if($this->_check_gateway_exists($gateway))
    	{	
    		if(count($options) > 0)
    		{
    			$this->_set_options($options);
    		}
    		$this->_cc = new Merchant_Billing_CreditCard($cc_info);
    		try
    		{
	    		if($this->_cc == false)
	    		{
	    			$response = $this->_cc->errors();
	    		}
	    		else
	    		{
	    			$response = $this->_gateway->$gateway_function($amount, $this->_cc, $options);
	    			$response = $response->message();
	    		}
	    	}
	    	catch (Exception $e)
	    	{
	    		$response = $e->getMessage();
	    	}
     	}
     	else 
     	{
     		$response = 'That gateway does not exist';
     	}
     	
     	return $response;
    }

	/**
	* Check to ensure payment gateway exists
	* @param	string	The name of the gateway to call
	* @param	array	Info for credit card
	* @param	array	Options for the transaction
	* @return 	bool
	*/	    
    private function _check_gateway_exists($gateway)
    {
    	//Set this to a variable, because PHP is sometimes a man lover
    	$this->_gateway_config = $this->_ci->config->item($gateway, 'merchants');
    	
    	if(isset($this->_gateway_config))
    	{
    		$this->_init_gateway($gateway);
    		$response = TRUE;
    	}	
    	else
    	{
    		$response = FALSE;
    	}
    	
    	return $response;
    }
    
	/**
	* Initialize the gateway
	* @param	string	The name of the gateway to call
	* @return	void
	*/	    
    private function _init_gateway($gateway)
    {
    	$config_array = array();
    	foreach($this->_gateway_config as $key=>$value)
    	{
    		$config_array[$key] = $value;
    	}
    	
    	$call = 'Merchant_Billing_'.$gateway;
    	
    	$this->_gateway = new $call($config_array); 
    }
 
 	/**
	* Set options to the gateway object from user input
	* @param	string	The name of the gateway to call
	*/	   
    private function _set_options($options)
    {
		$options['order_id'] = 'Ref' . $this->_gateway->generate_unique_id();	
		$this->_options = $options;    
    }
}