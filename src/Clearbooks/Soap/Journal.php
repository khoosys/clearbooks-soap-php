<?php
namespace Clearbooks\Soap;

/**
 * @author Clear Books <api@clearbooks.co.uk>
 * @version 1.0
 * @package Clearbooks
 * @subpackage Soap/1/0
 */
class Journal
{
    /** @var \Clearbooks_Soap_1_0_JournalLedgerItem[] */
    public $ledger = array();

    /** @var string */
    public $description;

    /** @var string */
    public $accountingDate;

    /** @var int */
    public $project = 0;

    /** @var int */
    public $entity = 0;
}
//EOF Journal.php