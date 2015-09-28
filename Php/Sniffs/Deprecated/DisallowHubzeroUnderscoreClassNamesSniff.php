<?php
/**
 * package   frameworkSniffs_Deprecated_DisallowHubzeroUnderscoreClassNamesSniff
 *
 * Ensure no use of 'Hubzero_*' class names are reintroduced
 *
 * @category  PHP
 * @package   standards
 * @author    Sam Wilson <samwilson@purdue.edu>
 */
class Php_Sniffs_Deprecated_DisallowHubzeroUnderscoreClassNamesSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * Returns an array of tokens for which this test wants to listen
	 *
	 * @return array
	 */
	public function register()
	{
		return array(
			T_DOUBLE_COLON,
			T_NEW
		);
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

		switch ($tokens[$stackPtr]['type'])
		{
			case 'T_DOUBLE_COLON':
				$classname = $tokens[$stackPtr - 1]['content'];
				break;

			case 'T_NEW':
			default:
				$classname = $tokens[$stackPtr + 2]['content'];
				break;
		}

		// Find tokens where two colons are in a row "::"
		if (strpos($classname, 'Hubzero_') !== false)
		{
			$error = 'Illegal use of deprecated classname format %s.';
			$phpcsFile->addError($error, $stackPtr, 'IndentedBlankLine', $classname);
		}
	}
}