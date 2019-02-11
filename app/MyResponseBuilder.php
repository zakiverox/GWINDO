<?php

namespace App;

use MarcinOrlowski\ResponseBuilder\ResponseBuilder;



class MyResponseBuilder extends arcinOrlowski\ResponseBuilder\ResponseBuilder
{
   protected static function buildResponse($code, $message, $data = null)
   {
      // tell ResponseBuilder to do all the heavy lifting first
      $response = parent::buildResponse($code, $message, $data);

      // then do all the tweaks you need
      $date = new DateTime();
      $response['timestamp'] = $date->getTimestamp();
      $response['timezone'] = $date->getTimezone();

      unset($response['locale']);

      // finally, return what $response holds
      return $response;
   }
}