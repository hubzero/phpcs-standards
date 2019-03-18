<?php
/**
 * Php_Sniffs_WhiteSpace_DisallowBlankLinesWithSpacesSniff
 *
 * No blank lines allowed that contain any form of indentation
 *
 * @category  PHP
 * @package   standards
 * @author    Sam Wilson <samwilson@purdue.edu>
 */

namespace PHP_CodeSniffer\Standards\Hubzero\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
class DisallowBlankLinesWithSpacesSniff implements Sniff
{
	/**
	 * Returns an array of tokens for which this test wants to listen
	 *
	 * @return array
	 */
	public function register()
	{
		return array(T_WHITESPACE);
	}

	/**
	 * Processes the test
	 *
	 * @param File $phpcsFile All the tokens found in the document
	 * @param int                  $stackPtr  The position of the current token in
	 *                                        the stack passed in $tokens
	 *
	 * @return void
	 */
	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		// Make sure the line is only white space
		if ($stackPtr > 0 && $tokens[($stackPtr - 1)]['line'] === $tokens[$stackPtr]['line'])
		{
			return;
		}

		if (preg_match('/^[\s]+(\n|\r\n)+/', $tokens[$stackPtr]['content']))
		{
			$error = 'Blank lines containing indentation are not allowed.';
			$phpcsFile->addError($error, $stackPtr, 'IndentedBlankLine');
		}
	}
}
