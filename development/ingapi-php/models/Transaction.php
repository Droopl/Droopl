<?php

class Transaction {

  static $swaggerTypes = array(
      'amount' => 'float',
      'category' => 'string',
      'transactDate' => 'int',
      'transactionDesc' => 'string',
      'counterPart' => 'string'

    );

  static $swaggerNames = array(
      'amount' => 'amount',
      'category' => 'category',
      'transactDate' => 'transactDate',
      'transactionDesc' => 'transactionDesc',
      'counterPart' => 'counterPart'

    );
    
  /**
  * The amount of the transaction , such as 1.0
  */
  public $amount; // float
  /**
  * The category of the transaction
  */
  public $category; // string
  /**
  * The transaction date, such as 1358722800000
  */
  public $transactDate; // int
  /**
  * The transaction description.
  */
  public $transactionDesc; // string
  /**
  * The transaction counter part .
  */
  public $counterPart; // string
  }

