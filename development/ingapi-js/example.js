// Import the SDK package.
var sdk = require('INGHackathonBankingAPI');

// Alternatively, if you are not using npm, then import the API class module.
// var INGHackathonBankingAPI = require('./lib/INGHackathonBankingAPI.js');

// Create a new instance of the API class.
var api = new sdk.INGHackathonBankingAPI();

// Set the API credentials and API secret key.
// TODO: replace username, password, and secret key with those from the API definition.



// Example for the getMunicipalityFomTheMunicipalityID operation.
function example_getMunicipalityFomTheMunicipalityID() {

	// Set up the request parameters for the getMunicipalityFomTheMunicipalityID operation.
	var request = {};
	request.id = 'value'; // TODO: the id parameter is required.
	
	// Invoke the getMunicipalityFomTheMunicipalityID operation.
	api.getMunicipalityFomTheMunicipalityID(request, function (error, response) {
	
		// Handle any errors from the getMunicipalityFomTheMunicipalityID operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the getMunicipalityFomTheMunicipalityID operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the getCustomerFromTheCustomerID operation.
function example_getCustomerFromTheCustomerID() {

	// Set up the request parameters for the getCustomerFromTheCustomerID operation.
	var request = {};
	request.id = 'value'; // TODO: the id parameter is required.
	
	// Invoke the getCustomerFromTheCustomerID operation.
	api.getCustomerFromTheCustomerID(request, function (error, response) {
	
		// Handle any errors from the getCustomerFromTheCustomerID operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the getCustomerFromTheCustomerID operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the getCustomersOfTheSameFamilyFromACustomerID operation.
function example_getCustomersOfTheSameFamilyFromACustomerID() {

	// Set up the request parameters for the getCustomersOfTheSameFamilyFromACustomerID operation.
	var request = {};
	request.id = 'value'; // TODO: the id parameter is required.
	
	// Invoke the getCustomersOfTheSameFamilyFromACustomerID operation.
	api.getCustomersOfTheSameFamilyFromACustomerID(request, function (error, response) {
	
		// Handle any errors from the getCustomersOfTheSameFamilyFromACustomerID operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the getCustomersOfTheSameFamilyFromACustomerID operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the searchForCustomers operation.
function example_searchForCustomers() {

	// Set up the request parameters for the searchForCustomers operation.
	var request = {};
	request.age_min = 'value'; // The age_min parameter is optional.
	request.age_max = 'value'; // The age_max parameter is optional.
	request.bolig_form = 'value'; // The bolig_form parameter is optional.
	request.customer_type = 'value'; // The customer_type parameter is optional.
	request.dna_fam = 'value'; // The dna_fam parameter is optional.
	request.fam_type = 'value'; // The fam_type parameter is optional.
	request.gender = 'value'; // The gender parameter is optional.
	request.social_class = 'value'; // The social_class parameter is optional.
	
	// Invoke the searchForCustomers operation.
	api.searchForCustomers(request, function (error, response) {
	
		// Handle any errors from the searchForCustomers operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the searchForCustomers operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the getAccountsFromACustomerID operation.
function example_getAccountsFromACustomerID() {

	// Set up the request parameters for the getAccountsFromACustomerID operation.
	var request = {};
	request.id = 'value'; // TODO: the id parameter is required.
	
	// Invoke the getAccountsFromACustomerID operation.
	api.getAccountsFromACustomerID(request, function (error, response) {
	
		// Handle any errors from the getAccountsFromACustomerID operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the getAccountsFromACustomerID operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the searchForCustomersBasedAnAccountAttributes operation.
function example_searchForCustomersBasedAnAccountAttributes() {

	// Set up the request parameters for the searchForCustomersBasedAnAccountAttributes operation.
	var request = {};
	request.product_cat_nm = 'value'; // The product_cat_nm parameter is optional.
	request.product_cls_nm = 'value'; // The product_cls_nm parameter is optional.
	request.product_grp_nm = 'value'; // The product_grp_nm parameter is optional.
	
	// Invoke the searchForCustomersBasedAnAccountAttributes operation.
	api.searchForCustomersBasedAnAccountAttributes(request, function (error, response) {
	
		// Handle any errors from the searchForCustomersBasedAnAccountAttributes operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the searchForCustomersBasedAnAccountAttributes operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the getTransactionsFromAnAccountID operation.
function example_getTransactionsFromAnAccountID() {

	// Set up the request parameters for the getTransactionsFromAnAccountID operation.
	var request = {};
	request.id = 'value'; // TODO: the id parameter is required.
	
	// Invoke the getTransactionsFromAnAccountID operation.
	api.getTransactionsFromAnAccountID(request, function (error, response) {
	
		// Handle any errors from the getTransactionsFromAnAccountID operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the getTransactionsFromAnAccountID operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
function example_getTransactionsFromACustomerIDAndOptionalAccountCategory() {

	// Set up the request parameters for the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
	var request = {};
	request.id = 'value'; // TODO: the id parameter is required.
	request.category = 'value'; // The category parameter is optional.
	
	// Invoke the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
	api.getTransactionsFromACustomerIDAndOptionalAccountCategory(request, function (error, response) {
	
		// Handle any errors from the getTransactionsFromACustomerIDAndOptionalAccountCategory operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the getTransactionsFromACustomerIDAndOptionalAccountCategory operation. 
		console.log(JSON.stringify(response));
		
			
	});

}

// Example for the addTransaction operation.
function example_addTransaction() {

	// Set up the request parameters for the addTransaction operation.
	var request = {};
	request.body = {
		// TODO: insert required body object here.
	};
	request.id = 'value'; // TODO: the id parameter is required.
	request.period = 'value'; // TODO: the period parameter is required.
	
	// Invoke the addTransaction operation.
	api.addTransaction(request, function (error, response) {
	
		// Handle any errors from the addTransaction operation.
		if (error) {
			console.log(error);
			throw error;
		}
			
		// Handle the response from the addTransaction operation. 
		console.log(JSON.stringify(response));
		
			
	});

}


