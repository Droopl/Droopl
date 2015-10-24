<?php

class Municipality {

  static $swaggerTypes = array(
      'postalcode' => 'int',
      'name' => 'string'

    );

  static $swaggerNames = array(
      'postalcode' => 'postalcode',
      'name' => 'name'

    );
    
  /**
  * The municipality postal code
  */
  public $postalcode; // int
  /**
  * The municipality name
  */
  public $name; // string
  }

