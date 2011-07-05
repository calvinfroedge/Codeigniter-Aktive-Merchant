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
	* The CodeIgniter Instance
	* @param	string	The name of the gateway to call
	* @param	array	Info for credit card
	* @param	array	Options for the transaction
	*/	
    public function try_payment($gateway, $cc_info, $options)
    { 	
    	if($this->_check_gateway_exists($gateway))
    	{	
    		$this->_options = $this->_set_options($options);
    		$this->_cc = new Merchant_Billing_CreditCard($cc_info);
    		try
    		{
	    		if($this->_cc == false)
	    		{
	    			$response = $this->_cc->errors();
	    		}
	    		else
	    		{
	    			$response = $this->_gateway->purchase("0.01", $this->_cc, $this->_options);
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
	* Check to ensure 
	* @param	string	The name of the gateway to call
	* @param	array	Info for credit card
	* @param	array	Options for the transaction
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
    
    private function _init_gateway($gateway)
    {
    	$config_array = array();
    	foreach($this->_gateway_config as $key=>$value)
    	{
    		$config_array[$key] = $value;
    	}
    	$this->_gateway = Merchant_Billing_Base::gateway($gateway, $config_array); 
    }
    
    private function _set_options($options)
    {
    	$gatway_options = array();
    	
    	foreach($options as $key=>$value)
    	{
    		$gatway_options[$key] = $value;
    	}
    	
		$gateway_options['order_id'] = 'Ref' . $this->_gateway->generate_unique_id();
		
		$this->_options = $gateway_options;    
    }
}