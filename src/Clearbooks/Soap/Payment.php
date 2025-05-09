<?php
namespace Clearbooks\Soap;

/**
 * @author Clear Books <api@clearbooks.co.uk>
 * @version 1.0
 * @package Clearbooks
 * @subpackage Soap/1/0
 */
class Payment
{
    /** @var string */
    public $description;

    /** @var \Clearbooks\Soap\PaymentInvoice[] */
    public $invoices = array();

    /** @var string */
    public $type;

    /** @var int */
    public $project;

    /** @var \DateTime */
    public $accountingDate;

    /** @var float */
    public $amount;

    /** @var int */
    public $entityId;

    /** @var int */
    public $paymentMethod;

    /** @var string */
    public $bankAccount;

    /** @var int */
    public $bsAccount = 0;

    /** @var float */
    public $fxRate = 0;
}
//EOF Payment.php
