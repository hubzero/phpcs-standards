<?php
/**
 * HubzeroCS_Sniffs_ControlStructures_RequireSpaceBetweenControlAndArgumentsSniff
 *
 * Control structure declarations must have one space between it and it's arguments
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Sam Wilson <samwilson@purdue.edu>
 */
class HubzeroCS131_Sniffs_ControlStructures_RequireSpaceBetweenControlAndArgumentsSniff implements PHP_CodeSniffer_Sniff
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
	 * @param PHP_CodeSniffer_File $phpcsFile All the tokens found in the document
	 * @param int                  $stackPtr  The position of the current token in
	 *                                        the stack passed in $tokens
	 *
	 * @return void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		if ($tokens[$stackPtr + 1]['content'] != ' ')
		{
			$error = 'Control structures must have a space between the element and its argument(s).';
			$phpcsFile->addError($error, $stackPtr, 'ControlStructureSpace');
		}
	}
}
