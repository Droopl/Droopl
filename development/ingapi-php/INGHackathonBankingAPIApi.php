<?php

include ('APIClient.php');
 
class INGHackathonBankingAPIApi {

  var $apiClient = null;
  var $username  = null;
  var $password  = null;
  var $secretKey = null;
  
  function __construct() {    
    $this->basePath = 'http://159.8.142.102:1131/ibmlgeef/sb/ing';
    $this->apiClient = new APIClient($this->basePath);    
  }

  /**
	 * getMunicipalityFomTheMunicipalityID
	 * getMunicipalityFomTheMunicipalityID
   * id, number: The municipality ID. This value is within a range [0..860], where not all IDs are used. (required)

   * @return Municipality
	 */

  public function getMunicipalityFomTheMunicipalityID($id) {

    //parse inputs
    $resourcePath = "/pdm/municipality/{id}";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($id != null) {
  		$resourcePath = str_replace("{" . "id" . "}",
  		                            $this->apiClient->toPathValue($id), $resourcePath);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Municipality');
    	return $responseObject;  
    }
  /**
	 * getCustomerFromTheCustomerID
	 * getCustomerFromTheCustomerID
   * id, number: The customer ID. This value is within the range [1..25473], where all IDs are used. (required)

   * @return Customer
	 */

  public function getCustomerFromTheCustomerID($id) {

    //parse inputs
    $resourcePath = "/pdm/party/{id}";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($id != null) {
  		$resourcePath = str_replace("{" . "id" . "}",
  		                            $this->apiClient->toPathValue($id), $resourcePath);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Customer');
    	return $responseObject;  
    }
  /**
	 * getCustomersOfTheSameFamilyFromACustomerID
	 * getCustomersOfTheSameFamilyFromACustomerID
   * id, number: The customer ID. This value is within the range [1..25473], where all IDs are used. (required)

   * @return Array[Customer]
	 */

  public function getCustomersOfTheSameFamilyFromACustomerID($id) {

    //parse inputs
    $resourcePath = "/pdm/family/{id}";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($id != null) {
  		$resourcePath = str_replace("{" . "id" . "}",
  		                            $this->apiClient->toPathValue($id), $resourcePath);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Array[Customer]');
    	return $responseObject;  
    }
  /**
	 * searchForCustomers
	 * searchForCustomers
   * age_min, number: The minimum age (inclusive). (optional)

   * age_max, number: The maximum age (inclusive). (optional)

   * bolig_form, string: The housing type (may include % as wildcard). (optional)

   * customer_type, string: The customer type (may include % as wildcard). (optional)

   * dna_fam, string: The general desription of the family (may include % as wildcard). (optional)

   * fam_type, string: The family type (may include % as wildcard). (optional)

   * gender, string: The gender (may include % as wildcard). M stands for male, F stands for female. (optional)

   * social_class, string: The social class (may include % as wildcard). (optional)

   * @return Array[Customer]
	 */

  public function searchForCustomers($age_min=null, $age_max=null, $bolig_form=null, $customer_type=null, $dna_fam=null, $fam_type=null, $gender=null, $social_class=null) {

    //parse inputs
    $resourcePath = "/pdm/multi";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($age_min != null) {
  	  $queryParams['age_min'] = $this->apiClient->toQueryValue($age_min);
  	}
  	if($age_max != null) {
  	  $queryParams['age_max'] = $this->apiClient->toQueryValue($age_max);
  	}
  	if($bolig_form != null) {
  	  $queryParams['bolig_form'] = $this->apiClient->toQueryValue($bolig_form);
  	}
  	if($customer_type != null) {
  	  $queryParams['customer_type'] = $this->apiClient->toQueryValue($customer_type);
  	}
  	if($dna_fam != null) {
  	  $queryParams['dna_fam'] = $this->apiClient->toQueryValue($dna_fam);
  	}
  	if($fam_type != null) {
  	  $queryParams['fam_type'] = $this->apiClient->toQueryValue($fam_type);
  	}
  	if($gender != null) {
  	  $queryParams['gender'] = $this->apiClient->toQueryValue($gender);
  	}
  	if($social_class != null) {
  	  $queryParams['social_class'] = $this->apiClient->toQueryValue($social_class);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Array[Customer]');
    	return $responseObject;  
    }
  /**
	 * getAccountsFromACustomerID
	 * getAccountsFromACustomerID
   * id, number: The customer ID. This value is within the range [1..25473], where all IDs are used. (required)

   * @return Array[Account]
	 */

  public function getAccountsFromACustomerID($id) {

    //parse inputs
    $resourcePath = "/pk/customer/{id}";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($id != null) {
  		$resourcePath = str_replace("{" . "id" . "}",
  		                            $this->apiClient->toPathValue($id), $resourcePath);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Array[Account]');
    	return $responseObject;  
    }
  /**
	 * searchForCustomersBasedAnAccountAttributes
	 * searchForCustomersBasedAnAccountAttributes
   * product_cat_nm, string: The account product category name (may include % as wildcard). (optional)

   * product_cls_nm, string: The account product class name (may include % as wildcard). (optional)

   * product_grp_nm, string: The account product group name (may include % as wildcard). (optional)

   * @return Array[Customer]
	 */

  public function searchForCustomersBasedAnAccountAttributes($product_cat_nm=null, $product_cls_nm=null, $product_grp_nm=null) {

    //parse inputs
    $resourcePath = "/pk/multi";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($product_cat_nm != null) {
  	  $queryParams['product_cat_nm'] = $this->apiClient->toQueryValue($product_cat_nm);
  	}
  	if($product_cls_nm != null) {
  	  $queryParams['product_cls_nm'] = $this->apiClient->toQueryValue($product_cls_nm);
  	}
  	if($product_grp_nm != null) {
  	  $queryParams['product_grp_nm'] = $this->apiClient->toQueryValue($product_grp_nm);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Array[Customer]');
    	return $responseObject;  
    }
  /**
	 * getTransactionsFromAnAccountID
	 * getTransactionsFromAnAccountID
   * id, number: The account ID. This value is within a range of [1..78124], where all IDs are used. (required)

   * @return Array[Transaction]
	 */

  public function getTransactionsFromAnAccountID($id) {

    //parse inputs
    $resourcePath = "/pe/transaction/account/{id}";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($id != null) {
  		$resourcePath = str_replace("{" . "id" . "}",
  		                            $this->apiClient->toPathValue($id), $resourcePath);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){

          return null;
        }
      //print_r($respone);
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Array[Transaction]');

    	return $responseObject;  
    }
  /**
	 * getTransactionsFromACustomerIDAndOptionalAccountCategory
	 * getTransactionsFromACustomerIDAndOptionalAccountCategory
   * id, number: The customer ID. This value is within the range [1..25473], where all IDs are used. (required)

   * category, string: The category of the transaction (may include % as wildcard). (optional)

   * @return Array[Transaction]
	 */

  public function getTransactionsFromACustomerIDAndOptionalAccountCategory($id, $category=null) {

    //parse inputs
    $resourcePath = "/pe/transaction/customer/{id}";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "GET";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($category != null) {
  	  $queryParams['category'] = $this->apiClient->toQueryValue($category);
  	}
  	if($id != null) {
  		$resourcePath = str_replace("{" . "id" . "}",
  		                            $this->apiClient->toPathValue($id), $resourcePath);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Array[Transaction]');
    	return $responseObject;  
    }
  /**
	 * addTransaction
	 * addTransaction
   * body, Transaction: Transaction object that needs to be created (required)

   * id, string: The account ID (must refer to an existing account).  (required)

   * period, string: The account period, following format 'YYYYMM'. Typical value: '201301' (required)

   * @return Transaction
	 */

  public function addTransaction($body, $id, $period) {

    //parse inputs
    $resourcePath = "/pe/account/{id}/period/{period}";
  	$resourcePath = str_replace("{format}", "json", $resourcePath);
  	$method = "POST";
    $queryParams = array();
    $headerParams = array();
    $headerParams['Accept'] = 'application/json';
    $headerParams['Content-Type'] = 'application/json';
  
    if ($this->secretKey) { 
      $headerParams['API_SECRET'] = $this->secretKey;
    } 
    
    if ($this->username && $this->password) { 
      $data = $this->username. ":".$this->password;
      $encodedData = base64_encode($data);
      $headerParams['Authorization'] = "Basic ".$encodedData;
    } 
    
    if($id != null) {
  		$resourcePath = str_replace("{" . "id" . "}",
  		                            $this->apiClient->toPathValue($id), $resourcePath);
  	}
  	if($period != null) {
  		$resourcePath = str_replace("{" . "period" . "}",
  		                            $this->apiClient->toPathValue($period), $resourcePath);
  	}
  	//make the API Call
    if (! isset($body)) {
      $body = null;
    }
  	$response = $this->apiClient->callAPI($resourcePath, $method,
  	                                      $queryParams, $body,
  	                                      $headerParams);  
  
    if(! $response){
          return null;
        }
    
    	$responseObject = $this->apiClient->deserialize($response,
    	                                                'Transaction');
    	return $responseObject;  
    }
  

}

