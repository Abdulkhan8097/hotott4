<?php
/**
 * Control Structure Spacing
 *
 * @package   CodeIgniter4-Standard
 * @author    Louis Linehan <louis.linehan@gmail.com>
 * @copyright 2017 British Columbia Institute of Technology
 * @license   https://github.com/bcit-ci/CodeIgniter4-Standard/blob/master/LICENSE MIT License
 */

namespace CodeIgniter4\Sniffs\ControlStructures;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Control Structure Spacing Sniff
 *
 * Checks that control structures have the correct spacing around brackets.
 *
 * @author Louis Linehan <louis.linehan@gmail.com>
 */
class ControlStructureSpacingSniff implements Sniff
{

    /**
     * How many spaces should follow the opening bracket.
     *
     * @var integer
     */
    public $requiredSpacesAfterOpen = 0;

    /**
     * How many spaces should precede the closing bracket.
     *
     * @var integer
     */
    public $requiredSpacesBeforeClose = 0;


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return [
            T_IF,
            T_WHILE,
            T_FOREACH,
            T_FOR,
            T_SWITCH,
            T_DO,
            T_ELSE,
            T_ELSEIF,
            T_TRY,
            T_CATCH,
        ];

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param File $phpcsFile The file being scanned.
     * @param int  $stackPtr  The position of the current token
     *                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $this->requiredSpacesAfterOpen   = (int) $this->requiredSpacesAfterOpen;
        $this->requiredSpacesBeforeClose = (int) $this->requiredSpacesBeforeClose;
        $tokens = $phpcsFile->getTokens();

        if (isset($tokens[$stackPtr]['parenthesis_opener']) === false
            || isset($tokens[$stackPtr]['parenthesis_closer']) === false
        ) {
            return;
        }

        $parenOpener    = $tokens[$stackPtr]['parenthesis_opener'];
        $parenCloser    = $tokens[$stackPtr]['parenthesis_closer'];
        $nextContentPtr = $phpcsFile->findNext(T_WHITESPACE, ($parenOpener + 1), null, true);

        $spaceAfterOpen = 0;
        if ($tokens[($parenOpener + 1)]['code'] === T_WHITESPACE) {
            if (strpos($tokens[($parenOpener + 1)]['content'], $phpcsFile->eolChar) !== false) {
                $spaceAfterOpen = 'newline';
            } else {
                $spaceAfterOpen = strlen($tokens[($parenOpener + 1)]['content']);
            }
        }

        if ($spaceAfterOpen !== $this->requiredSpacesAfterOpen) {
            $error = 'Expected %s spaces after opening bracket; %s found';
            $data  = [
                $this->requiredSpacesAfterOpen,
                $spaceAfterOpen,
            ];
            $fix   = $phpcsFile->addFixableError($error, ($parenOpener + 1), 'SpacingAfterOpenBrace', $data);
            if ($fix === true) {
                $padding = str_repeat(' ', $this->requiredSpacesAfterOpen);
                if ($spaceAfterOpen === 0) {
                    $phpcsFile->fixer->addContent($parenOpener, $padding);
                } else if ($spaceAfterOpen === 'newline') {
                    $phpcsFile->fixer->replaceToken(($parenOpener + 1), '');
                } else {
                    $phpcsFile->fixer->replaceToken(($parenOpener + 1), $padding);
                }
            }
        }

        // Spaces before control structure close parenthesis.
        if ($tokens[$parenOpener]['line'] === $tokens[$parenCloser]['line']) {
            $spaceBeforeClose = 0;
            if ($tokens[($parenCloser - 1)]['code'] === T_WHITESPACE) {
                $spaceBeforeClose = strlen(ltrim($tokens[($parenCloser - 1)]['content'], $phpcsFile->eolChar));
            }

            if ($spaceBeforeClose !== $this->requiredSpacesBeforeClose) {
                $error = 'Expected %s spaces before closing bracket; %s found';
                $data  = [
                    $this->requiredSpacesBeforeClose,
                    $spaceBeforeClose,
                ];
                $fix   = $phpcsFile->addFixableError($error, ($parenCloser - 1), 'SpaceBeforeCloseBrace', $data);
                if ($fix === true) {
                    $padding = str_repeat(' ', $this->requiredSpacesBeforeClose);
                    if ($spaceBeforeClose === 0) {
                        $phpcsFile->fixer->addContentBefore($parenCloser, $padding);
                    } else {
                        $phpcsFile->fixer->replaceToken(($parenCloser - 1), $padding);
                    }
                }
            }
        }//end if

    }//end process()


}//end class
