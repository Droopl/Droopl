<?php

// Import the SDK package.
include ('INGHackathonBankingAPIApi.php');

// Create a new instance of the API class.
$api = new INGHackathonBankingAPIApi();


$arrayOfTransactions = example_getTransactionsFromAnAccountID($api);
echo "<ul class='transaction'>";
foreach ($arrayOfTransactions as $transaction) {
  
    echo "<li>";
    echo "<span class='transactionDate'>" . date("m/d/Y", $transaction->transactDate / 1000) . "</span>";
      echo "<hr class='lijn'>";
      echo "<div class='bolleke'></div>";
      echo "<div class='transactionDescription'>";
        echo "<span class='transactionName'>Verwencafé</span>";
        echo "<span class='transactionAmount'>&euro;" . $transaction->amount . "</span>";
        echo "<span class='transactionReceiver'>Gianluca</span>";
      echo "</div>";
    echo "</div>";
        //echo $transaction->transactionDesc;
    echo "</li>";
}
echo "</ul>";
// Example for the getMunicipalityFomTheMunicipalityID operation.
function example_getMunicipalityFomTheMunicipalityID($api) {

  # Set up the request parameters for the getMunicipalityFomTheMunicipalityID operation.
  $id = '1'; # TODO: the id parameter is required.
  
  // Catch exceptions from invoking the getMunicipalityFomTheMunicipalityID operation.
  try{
    // Invoke the getMunicipalityFomTheMunicipalityID operation.
    $response = $api->getMunicipalityFomTheMunicipalityID($id); 
  
    // Handle the response from the getMunicipalityFomTheMunicipalityID operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the getCustomerFromTheCustomerID operation.
function example_getCustomerFromTheCustomerID($api) {

  # Set up the request parameters for the getCustomerFromTheCustomerID operation.
  $id = '1'; # TODO: the id parameter is required.
  
  // Catch exceptions from invoking the getCustomerFromTheCustomerID operation.
  try{
    // Invoke the getCustomerFromTheCustomerID operation.
    $response = $api->getCustomerFromTheCustomerID($id); 
  
    // Handle the response from the getCustomerFromTheCustomerID operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the getCustomersOfTheSameFamilyFromACustomerID operation.
function example_getCustomersOfTheSameFamilyFromACustomerID($api) {

  # Set up the request parameters for the getCustomersOfTheSameFamilyFromACustomerID operation.
  $id = 'value'; # TODO: the id parameter is required.
  
  // Catch exceptions from invoking the getCustomersOfTheSameFamilyFromACustomerID operation.
  try{
    // Invoke the getCustomersOfTheSameFamilyFromACustomerID operation.
    $response = $api->getCustomersOfTheSameFamilyFromACustomerID($id); 
  
    // Handle the response from the getCustomersOfTheSameFamilyFromACustomerID operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the searchForCustomers operation.
function example_searchForCustomers($api) {

  # Set up the request parameters for the searchForCustomers operation.
  $age_min = 'value'; # The age_min parameter is optional.
  $age_max = 'value'; # The age_max parameter is optional.
  $bolig_form = 'value'; # The bolig_form parameter is optional.
  $customer_type = 'value'; # The customer_type parameter is optional.
  $dna_fam = 'value'; # The dna_fam parameter is optional.
  $fam_type = 'value'; # The fam_type parameter is optional.
  $gender = 'value'; # The gender parameter is optional.
  $social_class = 'value'; # The social_class parameter is optional.
  
  // Catch exceptions from invoking the searchForCustomers operation.
  try{
    // Invoke the searchForCustomers operation.
    $response = $api->searchForCustomers($age_min, $age_max, $bolig_form, $customer_type, $dna_fam, $fam_type, $gender, $social_class); 
  
    // Handle the response from the searchForCustomers operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the getAccountsFromACustomerID operation.
function example_getAccountsFromACustomerID($api) {

  # Set up the request parameters for the getAccountsFromACustomerID operation.
  $id = 'value'; # TODO: the id parameter is required.
  
  // Catch exceptions from invoking the getAccountsFromACustomerID operation.
  try{
    // Invoke the getAccountsFromACustomerID operation.
    $response = $api->getAccountsFromACustomerID($id); 
  
    // Handle the response from the getAccountsFromACustomerID operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the searchForCustomersBasedAnAccountAttributes operation.
function example_searchForCustomersBasedAnAccountAttributes($api) {

  # Set up the request parameters for the searchForCustomersBasedAnAccountAttributes operation.
  $product_cat_nm = 'value'; # The product_cat_nm parameter is optional.
  $product_cls_nm = 'value'; # The product_cls_nm parameter is optional.
  $product_grp_nm = 'value'; # The product_grp_nm parameter is optional.
  
  // Catch exceptions from invoking the searchForCustomersBasedAnAccountAttributes operation.
  try{
    // Invoke the searchForCustomersBasedAnAccountAttributes operation.
    $response = $api->searchForCustomersBasedAnAccountAttributes($product_cat_nm, $product_cls_nm, $product_grp_nm); 
  
    // Handle the response from the searchForCustomersBasedAnAccountAttributes operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the getTransactionsFromAnAccountID operation.
function example_getTransactionsFromAnAccountID($api) {

  # Set up the request parameters for the getTransactionsFromAnAccountID operation.
  $id = 'BE65 3377 0000 0096'; # TODO: the id parameter is required.
  
  // Catch exceptions from invoking the getTransactionsFromAnAccountID operation.
  try{
    // Invoke the getTransactionsFromAnAccountID operation.
    $response = $api->getTransactionsFromAnAccountID($id); 
  
    // Handle the response from the getTransactionsFromAnAccountID operation.
    //print(json_encode($response,JSON_PRETTY_PRINT));
    return $response;
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
function example_getTransactionsFromACustomerIDAndOptionalAccountCategory($api) {

  # Set up the request parameters for the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
  $id = 'value'; # TODO: the id parameter is required.
  $category = 'value'; # The category parameter is optional.
  
  // Catch exceptions from invoking the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
  try{
    // Invoke the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
    $response = $api->getTransactionsFromACustomerIDAndOptionalAccountCategory($id, $category); 
  
    // Handle the response from the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

// Example for the addTransaction operation.
function example_addTransaction($api) {

  # Set up the request parameters for the addTransaction operation.
  $body = new Transaction(); # TODO: the body parameter is required.
  $id = 'value'; # TODO: the id parameter is required.
  $period = 'value'; # TODO: the period parameter is required.
  
  // Catch exceptions from invoking the addTransaction operation.
  try{
    // Invoke the addTransaction operation.
    $response = $api->addTransaction($body, $id, $period); 
  
    // Handle the response from the addTransaction operation.
    print(json_encode($response,JSON_PRETTY_PRINT));
    
  } catch (Exception $e) {
    print('Caught exception: '.$e);   
  }
  
}

?>

