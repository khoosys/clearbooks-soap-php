<?php
namespace Clearbooks\Soap;

/**
 * @author Clear Books <api@clearbooks.co.uk>
 * @version 1.0
 * @package Clearbooks
 * @subpackage Soap/1/0
 */
class BankStatementLine
{
    /** @var string */
    public $description;

    /** @var string */
    public $date;

    /** @var float */
    public $amount;
}
//EOF BankStatementLine.php