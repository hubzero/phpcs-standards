<?php
/**
 * HubzeroCS_Sniffs_WhiteSpace_DisallowTrailingWhiteSpaceSniff
 *
 * No trailing white spaces allowed at the end of lines
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Sam Wilson <samwilson@purdue.edu>
 */
class HubzeroCSmaster_Sniffs_WhiteSpace_DisallowTrailingWhiteSpaceSniff implements PHP_CodeSniffer_Sniff
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
	 * @param PHP_CodeSniffer_File $phpcsFile All the tokens found in the document
	 * @param int                  $stackPtr  The position of the current token in
	 *                                        the stack passed in $tokens
	 *
	 * @return void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		if (preg_match('/[\s]+(\n|\r\n)/', $tokens[$stackPtr]['content']))
		{
			$error = 'Trailing white space is not allowed.';
			$phpcsFile->addError($error, $stackPtr, 'TrailingSpaces');
		}
	}
}