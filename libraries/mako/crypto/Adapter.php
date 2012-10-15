<?php

namespace mako\crypto;

use \mako\security\MAC;

/**
 * Crypto adapter.
 *
 * @author     Frederic G. Østby
 * @copyright  (c) 2008-2012 Frederic G. Østby
 * @license    http://www.makoframework.com/license
 */

abstract class Adapter
{
	//---------------------------------------------
	// Class properties
	//---------------------------------------------

	// Nothing here

	//---------------------------------------------
	// Class constructor, destructor etc ...
	//---------------------------------------------

	abstract public function __construct(array $config);

	//---------------------------------------------
	// Class methods
	//---------------------------------------------

	abstract public function encrypt($string);

	abstract public function decrypt($string);

	/**
	 * Encrypt and sign string.
	 * 
	 * @access  public
	 * @param   string  $string  String to encrypt
	 * @return  string
	 */

	public function encryptAndSign($string)
	{
		return MAC::sign($this->encrypt($string));
	}

	/**
	 * Validats and decrypts data.
	 *
	 * @access  public
	 * @param   string  $string  String to decrypt
	 * @return  string
	 */

	public function validateAndDecrypt($string)
	{
		$string = MAC::validate($string);
		
		return ($string === false) ? false : $this->decrypt($string);
	}
}

/** -------------------- End of file --------------------**/