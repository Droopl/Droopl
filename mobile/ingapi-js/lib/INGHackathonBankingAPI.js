var request = require('request');

function INGHackathonBankingAPI() {
	this.basePath = 'http://159.8.142.102:1131/ibmlgeef/sb/ing';
}

INGHackathonBankingAPI.prototype.getBasePath = function () {
	return this.basePath;
};

INGHackathonBankingAPI.prototype.setBasePath = function (basePath) {
	this.basePath = basePath;
};

INGHackathonBankingAPI.prototype.getMunicipalityFomTheMunicipalityID = function (parameters, callback) {
	if (parameters.id === undefined) {
		return callback(new Error('Required parameter "id" has not been supplied'), null);
	}
	var path = '/pdm/municipality/{id}'.replace('{' + 'id' + '}', encodeURIComponent(parameters.id));
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.getCustomerFromTheCustomerID = function (parameters, callback) {
	if (parameters.id === undefined) {
		return callback(new Error('Required parameter "id" has not been supplied'), null);
	}
	var path = '/pdm/party/{id}'.replace('{' + 'id' + '}', encodeURIComponent(parameters.id));
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.getCustomersOfTheSameFamilyFromACustomerID = function (parameters, callback) {
	if (parameters.id === undefined) {
		return callback(new Error('Required parameter "id" has not been supplied'), null);
	}
	var path = '/pdm/family/{id}'.replace('{' + 'id' + '}', encodeURIComponent(parameters.id));
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.searchForCustomers = function (parameters, callback) {
	var path = '/pdm/multi';
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	if (parameters.age_min !== undefined) {
		options.qs.age_min = parameters.age_min;
	}
	if (parameters.age_max !== undefined) {
		options.qs.age_max = parameters.age_max;
	}
	if (parameters.bolig_form !== undefined) {
		options.qs.bolig_form = parameters.bolig_form;
	}
	if (parameters.customer_type !== undefined) {
		options.qs.customer_type = parameters.customer_type;
	}
	if (parameters.dna_fam !== undefined) {
		options.qs.dna_fam = parameters.dna_fam;
	}
	if (parameters.fam_type !== undefined) {
		options.qs.fam_type = parameters.fam_type;
	}
	if (parameters.gender !== undefined) {
		options.qs.gender = parameters.gender;
	}
	if (parameters.social_class !== undefined) {
		options.qs.social_class = parameters.social_class;
	}
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.getAccountsFromACustomerID = function (parameters, callback) {
	if (parameters.id === undefined) {
		return callback(new Error('Required parameter "id" has not been supplied'), null);
	}
	var path = '/pk/customer/{id}'.replace('{' + 'id' + '}', encodeURIComponent(parameters.id));
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.searchForCustomersBasedAnAccountAttributes = function (parameters, callback) {
	var path = '/pk/multi';
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	if (parameters.product_cat_nm !== undefined) {
		options.qs.product_cat_nm = parameters.product_cat_nm;
	}
	if (parameters.product_cls_nm !== undefined) {
		options.qs.product_cls_nm = parameters.product_cls_nm;
	}
	if (parameters.product_grp_nm !== undefined) {
		options.qs.product_grp_nm = parameters.product_grp_nm;
	}
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.getTransactionsFromAnAccountID = function (parameters, callback) {
	if (parameters.id === undefined) {
		return callback(new Error('Required parameter "id" has not been supplied'), null);
	}
	var path = '/pe/transaction/account/{id}'.replace('{' + 'id' + '}', encodeURIComponent(parameters.id));
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.getTransactionsFromACustomerIDAndOptionalAccountCategory = function (parameters, callback) {
	if (parameters.id === undefined) {
		return callback(new Error('Required parameter "id" has not been supplied'), null);
	}
	var path = '/pe/transaction/customer/{id}'.replace('{' + 'id' + '}', encodeURIComponent(parameters.id));
	var options = {
		method: 'GET',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	if (parameters.category !== undefined) {
		options.qs.category = parameters.category;
	}
	options.json = true;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

INGHackathonBankingAPI.prototype.addTransaction = function (parameters, callback) {
	if (parameters.body === undefined) {
		return callback(new Error('Required parameter "body" has not been supplied'), null);
	}
	if (parameters.id === undefined) {
		return callback(new Error('Required parameter "id" has not been supplied'), null);
	}
	if (parameters.period === undefined) {
		return callback(new Error('Required parameter "period" has not been supplied'), null);
	}
	var path = '/pe/account/{id}/period/{period}'.replace('{' + 'id' + '}', encodeURIComponent(parameters.id)).replace('{' + 'period' + '}', encodeURIComponent(parameters.period));
	var options = {
		method: 'POST',
		uri: this.basePath + path,
		headers: {},
		qs: {}
	};
	options.json = parameters.body;
	request(options, function (error, response, body) {
		if (error) {
			callback(error, null);
		} else {
			callback(null, body);
		}
	});
};

module.exports = INGHackathonBankingAPI;

