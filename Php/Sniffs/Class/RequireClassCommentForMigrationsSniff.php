<?php
/**
 * package   frameworkSniffs_Class_RequireClassCommentForMigrationsSniff
 *
 * Must have doc block for migrations
 *
 * @category  PHP
 * @package   standards
 * @author    Sam Wilson <samwilson@purdue.edu>
 */
class Php_Sniffs_Class_RequireClassCommentForMigrationsSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register()
	{
		return array(T_CLASS);

	}

	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
	 * @param int                  $stackPtr  The position of the current token in the stack passed in $tokens.
	 *
	 * @return void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$find   = PHP_CodeSniffer_Tokens::$methodPrefixes;
		$find[] = T_WHITESPACE;

		// Get class name
		$className = $tokens[$stackPtr + 2]['content'];

		// Currently only run on migrations
		if (!preg_match("/Migration[^\\s]*/", $className))
		{
			return;
		}

		$commentEnd = $phpcsFile->findPrevious($find, ($stackPtr - 1), null, true);
		if ($tokens[$commentEnd]['code'] !== T_COMMENT && $tokens[$commentEnd]['code'] !== T_DOC_COMMENT)
		{
			$phpcsFile->addError('Missing migration class doc comment', $stackPtr, 'Missing');
			return;
		}

		// Get doc block comment
		$commentLocation = $phpcsFile->findNext(T_DOC_COMMENT, $commentEnd - 1, $commentEnd + 1);
		$commentString   = $tokens[$commentLocation]['content'];

		// Make sure its not default from stub
		if (preg_match("/Migration\\sscript\\sfor\\s\.\.\./", $commentString))
		{
			$phpcsFile->addError('Please complete migration doc block comment.', 'Missing');
			return;
		}
	}
}
