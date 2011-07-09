<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AK_Examples extends CI_Controller 
{

	public function index()
	{
		$this->load->spark('aktive-merchant/1.0.0/');
			
		//AUTHORIZE.NET	
		/*
		$cc_info = array(
			"first_name" => "John",
			"last_name" => "Doe",
			"number" => "4111111111111111",
			"month" => "01",
			"year" => "2015",
			"verification_value" => "000"		
		);
		
		$options = array(
			'description'	=>	'This is just a test',
			'address' => array(
				'address1' => '1234 Street',
			    'zip' => '98004',
			    'state' => 'WA'
			)			
		);
		
		echo $this->aktive_merchant->try_payment('authorizenet', 'purchase', $cc_info, $options);	
		*/
		
		
		
		//AUTHORIZE.NET ARB
		/*
		$cc_info = array(
		    "first_name" => "John",
		    "last_name" => "Doe",
		    "number" => "4111111111111111",
		    "month" => "01",
		    "year" => "2015",
		    "verification_value" => "000"		
		);
		
		$options = array(
			'description' => '',
			'length' => '1',
			'unit' => 'months',
			'start_date' => '2010-09-11',
			'occurrences' => '10',
			'billing_address' => array(
				'first_name' => 'John',
			    'last_name' => 'Doe',
			    'address1' => '1234 Street',
			    'zip' => '98004',
			    'state' => 'WA'
			)
		);
		
		echo $this->aktive_merchant->try_payment('authorizenet', 'recurring', $cc_info, $options);
		*/
		
		
		//BOGUS TEST CARD
		/*
		$cc_info = array(
			"first_name" => "Test",
			"last_name" => "User",
			"number" => "1",
			"month" => "7",
			"year" => "2010",
			"verification_value" => "000"		
		);

		echo $this->aktive_merchant->try_payment('bogus', $cc_info);			
		*/
		
		
		//EUROBANK
		/*
		$cc_info = array(
			"first_name" => "Test",
			"last_name" => "User",
			"number" => "41111111111111",
			"month" => "12",
			"year" => "2012",
			"verification_value" => "123"		
		);

		echo $this->aktive_merchant->try_payment('eurobank', $cc_info);				
		*/
		
		//HSBC
		/*
		
		*/
	}

}