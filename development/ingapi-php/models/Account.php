<?php

class Account {

  static $swaggerTypes = array(
      'accountId' => 'int',
      'period' => 'int',
      'income' => 'float',
      'localProductCd' => 'string',
      'localProductNm' => 'string',
      'productCatNm' => 'string',
      'productClsNm' => 'string',
      'productGrpNm' => 'string',
      'totalVolume' => 'float',
      'volumeLending' => 'float',
      'volumeSavings' => 'float',
      'balance' => 'float'

    );

  static $swaggerNames = array(
      'accountId' => 'accountId',
      'period' => 'period',
      'income' => 'income',
      'localProductCd' => 'localProductCd',
      'localProductNm' => 'localProductNm',
      'productCatNm' => 'productCatNm',
      'productClsNm' => 'productClsNm',
      'productGrpNm' => 'productGrpNm',
      'totalVolume' => 'totalVolume',
      'volumeLending' => 'volumeLending',
      'volumeSavings' => 'volumeSavings',
      'balance' => 'balance'

    );
    
  /**
  * The id of the account, within a range of [1..78124]
  */
  public $accountId; // int
  /**
  * The period for the account; only year and month are relevant, such as 1356994800000
  */
  public $period; // int
  /**
  * The income value for the account period, such as -0.8141423630
  */
  public $income; // float
  /**
  * The local product CD for this account.
  */
  public $localProductCd; // string
  /**
  * The local product name for this account.
  */
  public $localProductNm; // string
  /**
  * The product category name for this account
  */
  public $productCatNm; // string
  /**
  * The product class name for this account
  */
  public $productClsNm; // string
  /**
  * The product group name for this account
  */
  public $productGrpNm; // string
  /**
  * The total volume for the account period, such as 17623.2500000000
  */
  public $totalVolume; // float
  /**
  * The lending volume for the account period, such as 10.1
  */
  public $volumeLending; // float
  /**
  * The savings volume for the account period, such as -15.1
  */
  public $volumeSavings; // float
  /**
  * Current balance.
  */
  public $balance; // float
  }

