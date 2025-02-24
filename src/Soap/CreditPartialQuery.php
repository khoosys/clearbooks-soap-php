<?php
namespace Clearbooks\Soap;

/**
 * @author Clear Books <api@clearbooks.co.uk>
 * @version 1.0
 * @package Clearbooks
 * @subpackage Soap/1/0
 */
class CreditPartialQuery
{
    /** @var int */
    public $invoiceId;

    /** @var int */
    public $creditId;

    /** @var float */
    public $amountToAllocate;

    /**  @var string */
    public $ledger;

}
//EOF CreditPartialQuery.php