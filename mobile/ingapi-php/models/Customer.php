<?php

class Customer {

  static $swaggerTypes = array(
      'customerId' => 'int',
      'age' => 'int',
      'boligForm' => 'string',
      'customerIdCreateDate' => 'string',
      'customerType' => 'string',
      'dnaFam' => 'string',
      'famType' => 'string',
      'gender' => 'string',
      'socialClass' => 'string',
      'name' => 'string',
      'firstName' => 'string',
      'municipality' => 'string'

    );

  static $swaggerNames = array(
      'customerId' => 'customerId',
      'age' => 'age',
      'boligForm' => 'boligForm',
      'customerIdCreateDate' => 'customerIdCreateDate',
      'customerType' => 'customerType',
      'dnaFam' => 'dnaFam',
      'famType' => 'famType',
      'gender' => 'gender',
      'socialClass' => 'socialClass',
      'name' => 'name',
      'firstName' => 'firstName',
      'municipality' => 'municipality'

    );
    
  /**
  * The customer ID (within the range [1..25473], where all IDs are used)
  */
  public $customerId; // int
  /**
  * The age of the customer
  */
  public $age; // int
  /**
  * The housing type
  */
  public $boligForm; // string
  /**
  * A string representing the creation date of the customer (example: '03MAR1978')
  */
  public $customerIdCreateDate; // string
  /**
  * The customer type
  */
  public $customerType; // string
  /**
  * The general desription of the family
  */
  public $dnaFam; // string
  /**
  * The family type.
  */
  public $famType; // string
  /**
  * The gender
  */
  public $gender; // string
  /**
  * The social class
  */
  public $socialClass; // string
  /**
  * The customer name.
  */
  public $name; // string
  /**
  * The customer firstName.
  */
  public $firstName; // string
  /**
  * The municipality where the customer resides.
  */
  public $municipality; // string
  }

