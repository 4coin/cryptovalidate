<?php
/*
   * Determine if a string is a valid Cryptocoin address adapted from bitcoin php @ https://github.com/mikegogulski/bitcoin-php 
   * originally by Mike Gogulski - http://www.nostate.com/ http://www.gogulski.com/
   * @author theymos
   * adapted and modified by tshabs 2014 (what is licence‽), http://www.cryptovalidate.com
   *if you are reading this, you probably own this code (original author doesn't appear to believe in the "copyright" fiction either), non-exclusivley. (note: "this code" is the script contained in this file and does not include any dependencies which may be under their own respective licences)
    */
      
  function checkAddress($addr, $mode = 'b') {
   //some settings
   if($mode == 's'){
       //string mode selected
   $bad_length_error = "bad length";
   $bad_checksum_error = "bad checksum";
   $valid_address_error = "all good";
   }elseif($mode == 'n'){
       //number mode selected
   //probably better settings for real world use (return integer)
      $bad_length_error = 0;
      $bad_checksum_error = 0;
      $valid_address_error = 1;
   }elseif($mode == 'b'){
       //boolean mode selected
   //better settings for real world use (return boolean)
      $bad_length_error = false;
      $bad_checksum_error = false;
      $valid_address_error = true;
   }else{
       return "Error: bad mode: $mode";
       }
   $addr = decodeBase58($addr);
    if (strlen($addr) != 50) {
      return $bad_length_error;
    }

    $check = substr($addr, 0, strlen($addr) - 8);
    $check = pack("H*", $check);
    $check = strtoupper(hash("sha256", hash("sha256", $check, true)));
    $check = substr($check, 0, 8);
    if($check == substr($addr, strlen($addr) - 8)){
    return $bad_checksum_error;
    }else{
        return $valid_address_error;
        }
  }

  /**
   * Convert a Base58-encoded integer into the equivalent hex string representation
   */
 function decodeBase58($base58) {
    $origbase58 = $base58;

    //only valid chars allowed
    if (preg_match('/[^1-9A-HJ-NP-Za-km-z]/', $base58)) {
      return "";
    }
$base58chars = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
    $return = "0";
    for ($i = 0; $i < strlen($base58); $i++) {
      $current = (string) strpos($base58chars, $base58[$i]);
      $return = (string) bcmul($return, "58", 0);
      $return = (string) bcadd($return, $current, 0);
    }

    $return = encodeHex($return);

    //leading zeros
    for ($i = 0; $i < strlen($origbase58) && $origbase58[$i] == "1"; $i++) {
      $return = "00" . $return;
    }

    if (strlen($return) % 2 != 0) {
      $return = "0" . $return;
    }

    return $return;
}


function encodeHex($dec) {
    $hexchars = "0123456789ABCDEF";
    $return = "";
    while (bccomp($dec, 0) == 1) {
      $dv = (string) bcdiv($dec, "16", 0);
      $rem = (integer) bcmod($dec, "16");
      $dec = $dv;
      $return = $return . $hexchars[$rem];
    }
    return strrev($return);
  }


?>