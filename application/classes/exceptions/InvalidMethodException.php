<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace classes\exceptions;

/**
 * Description of InvalidAttributeException
 *
 * @author MAKC
 */
class InvalidMethodException extends MyException{
  const MESSAGE = 'Private Method %s doesn`t exists in class %s!';  
}
