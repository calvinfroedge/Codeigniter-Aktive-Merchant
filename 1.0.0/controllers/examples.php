<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AK_Examples extends CI_Controller 
{

	public function index()
	{
		$this->load->spark('aktive-merchant/1.0.0/');
		
		$cc = array(
			"first_name" => "John",
			"last_name" => "Doe",
			"number" => "4111111111111111",
			"month" => "01",
			"year" => "2015",
			"verification_value" => "000"		
		);		
		/*
		
		var_dump($this->aktive_merchant->try_payment('authorizenet', '20.00', 'purchase', $cc, array()));

		*/
		//ARB
		/*
		
		$options = array(
		  'description' => '',
		  'length' => '1',
		  'unit' => 'months',
		  'start_date' => '2011-09-11',
		  'occurrences' => '10',
		  'billing_address' => array(
		    'first_name' => 'John',
		    'last_name' => 'Doe',
		    'address1' => '1234 Street',
		    'zip' => '98004',
		    'state' => 'WA'
		  )
		);
		var_dump($this->aktive_merchant->try_payment('authorizenet', '20.00', 'recurring', $cc, $options));	
		*/
		
			
		//BOGUS
		/*/
		$cc_bogus =   array(  
			"first_name" => "Test",
	    	"last_name" => "User",
	    	"number" => "1",
	    	"month" => "7",
	    	"year" => "2010",
	    	"verification_value" => "000"
    	);
    
		var_dump($this->aktive_merchant->try_payment('bogus', '10.00', 'purchase', $cc_bogus, array()));
		/*/
		
		//EUROBANK
		/*/
		var_dump($this->aktive_merchant->try_payment('eurobank', '10.00', 'authorize', $cc, array('customer_email'=>'test@test.com')));
		/*/
		
		//HSBC
		/*/
		var_dump($this->aktive_merchant->try_payment('HsbcSecureEpayments', '100', 'authorize', $cc));
		/*/
		

		//PayPal
		/*/
		var_dump($this->aktive_merchant->try_payment('paypal', '100.00', 'purchase', $cc));
		/*/
		
		//Piraeus
		/*/
		var_dump($this->aktive_merchant->try_payment('piraeuspaycenter', '10', 'purchase', $cc));
		/*/
	}

}