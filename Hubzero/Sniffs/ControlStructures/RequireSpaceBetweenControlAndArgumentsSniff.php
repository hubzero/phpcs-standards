<?php
/**
 * Php_Sniffs_ControlStructures_RequireSpaceBetweenControlAndArgumentsSniff
 *
 * Control structure declarations must have one space between it and it's arguments
 *
 * @category  PHP
 * @package   standards
 * @author    Sam Wilson <samwilson@purdue.edu>
 */

namespace PHP_CodeSniffer\Standards\Hubzero\Sniffs\ControlStructures;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class RequireSpaceBetweenControlAndArgumentsSniff implements Sniff
{
	/**
	 * Returns an array of tokens for which this test wants to listen
	 *
	 * @return array
	 */
	public function register()
	{
		return array(
			T_IF,
			T_ELSEIF,
			T_SWITCH,
			T_CASE,
			T_FOR,
			T_FOREACH,
			T_CATCH
		);
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

		if ($tokens[$stackPtr + 1]['content'] != ' ')
		{
			$error = 'Control structures must have a space between the element and its argument(s).';
			$phpcsFile->addError($error, $stackPtr, 'ControlStructureSpace');
		}
	}
}
