<?php

class myUser extends sfBasicSecurityUser
{
  /**
   * Name
   */
  public function getName()
  {
    return $this->getAttribute('name');
  }
 
  public function setName($name)
  {
    return $this->setAttribute('name', $name);
  }
  
  /**
   * Email
   */
  public function getEmail()
  {
    return $this->getAttribute('email');
  }
 
  public function setEmail($email)
  {
    return $this->setAttribute('email', $email);
  }
  
  /**
   * password
   */
  public function getPassword()
  {
    return str_rot13($this->getAttribute('password'));
  }
 
  public function setPassword($password)
  {
    return str_rot13($this->setAttribute('password', $password));
  }  

  /**
   * 出発地
   */
  public function getToAddress()
  {
    return $this->getAttribute('to_address');
  }
 
  public function setToAddress($to_address)
  {
    return $this->setAttribute('to_address', $to_address);
  }

 
  public function getToLat()
  {
    return $this->getAttribute('to_lat');
  } 
 
  public function setToLat($to_lat)
  {
    return $this->setAttribute('to_lat', $to_lat);
  }
  
  public function getToLon()
  {
    return $this->getAttribute('to_lon');
  } 
 
  public function setToLon($to_lon)
  {
    return $this->setAttribute('to_lon', $to_lon);
  }  

  /**
   * 目的地
   */
  public function getFromAddress()
  {
    return $this->getAttribute('from_address');
  }
 
  public function setFromAddress($from_address)
  {
    return $this->setAttribute('from_address', $from_address);
  }
 
  public function getFromLat()
  {
    return $this->getAttribute('from_lat');
  } 
 
  public function setFromLat($from_lat)
  {
    return $this->setAttribute('from_lat', $from_lat);
  }
  
  public function getFromLon()
  {
    return $this->getAttribute('from_lon');
  } 
 
  public function setFromLon($from_lon)
  {
    return $this->setAttribute('from_lon', $from_lon);
  }          
        

}
