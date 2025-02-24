<?php
namespace Clearbooks\Soap;

use Clearbooks\Soap\AccountCode;
use Clearbooks\Soap\AccountCodeHeading;
use Clearbooks\Soap\AccountCodeRequest;
use Clearbooks\Soap\AccountCodeResult;
use Clearbooks\Soap\AllocateQuery;
use Clearbooks\Soap\BankAccount;
use Clearbooks\Soap\BankAccountListItem;
use Clearbooks\Soap\BankDetails;
use Clearbooks\Soap\BankStatementLine;
use Clearbooks\Soap\CreditPartialQuery;
use Clearbooks\Soap\CreditQuery;
use Clearbooks\Soap\CreditResponseStatus;
use Clearbooks\Soap\Currency;
use Clearbooks\Soap\Entity;
use Clearbooks\Soap\EntityExtra;
use Clearbooks\Soap\EntityOutstandingBalance;
use Clearbooks\Soap\EntityQuery;
use Clearbooks\Soap\ExchangeRateRequest;
use Clearbooks\Soap\Invoice;
use Clearbooks\Soap\InvoiceQuery;
use Clearbooks\Soap\InvoiceRef;
use Clearbooks\Soap\InvoiceReturn;
use Clearbooks\Soap\Item;
use Clearbooks\Soap\Journal;
use Clearbooks\Soap\JournalLedgerItem;
use Clearbooks\Soap\JournalReturn;
use Clearbooks\Soap\ListBankAccountsReturn;
use Clearbooks\Soap\ListOutstandingBalancesReturn;
use Clearbooks\Soap\ListThemesReturn;
use Clearbooks\Soap\Payment;
use Clearbooks\Soap\PaymentInvoice;
use Clearbooks\Soap\PaymentMethod;
use Clearbooks\Soap\PaymentReturn;
use Clearbooks\Soap\Project;
use Clearbooks\Soap\ProjectReturn;
use Clearbooks\Soap\RemovePayment;
use Clearbooks\Soap\ResponseStatus;
use Clearbooks\Soap\Theme;

/**
 * @author Clear Books <api@clearbooks.co.uk>
 * @version 2.0
 * @package Clearbooks
 * @subpackage Soap/1
 *
 * @method \Clearbooks\Soap\ResponseStatus allocatePayment(\Clearbooks\Soap\AllocateQuery $query)
 * @method \Clearbooks\Soap\AccountCodeResult createAccountCode(\Clearbooks\Soap\AccountCodeRequest $code)
 * @method void addBankStatementLines(string $bankAccount, string $statementName, \Clearbooks\Soap\BankStatementLine[] $statementLines)
 * @method void writeOffPartial(\Clearbooks\Soap\CreditPartialQuery $query)
 * @method int createEntity(\Clearbooks\Soap\Entity $entity)
 * @method \Clearbooks\Soap\InvoiceReturn createInvoice(\Clearbooks\Soap\Invoice $invoice)
 * @method \Clearbooks\Soap\InvoiceReturn[] createInvoices(\Clearbooks\Soap\Invoice[] $invoices)
 * @method \Clearbooks\Soap\JournalReturn createJournal(\Clearbooks\Soap\Journal $project)
 * @method \Clearbooks\Soap\PaymentReturn createPayment(\Clearbooks\Soap\Payment $payment)
 * @method \Clearbooks\Soap\PaymentReturn createPayments(\Clearbooks\Soap\Payment[] $payments)
 * @method \Clearbooks\Soap\ProjectReturn createProject(\Clearbooks\Soap\Project $project)
 * @method bool deleteEntity(int $entityId)
 * @method bool deleteJournal(int $journalId)
 * @method int getEntityIdFromExternalId(string $externalId)
 * @method \Clearbooks\Soap\EntityOutstandingBalance getEntityOutstandingBalance(int $entityId, string $type)
 * @method float getExchangeRate(\Clearbooks\Soap\ExchangeRateRequest $request)
 * @method int getInvoiceIdFromInvoiceNumber(string $type, string $invoicePrefix, string $invoiceNumber)
 * @method int getPaymentIdFromExternalId(string $externalId)
 * @method \Clearbooks\Soap\AccountCodeHeading[] listAccountCodeHeadings()
 * @method \Clearbooks\Soap\AccountCode[] listAccountCodes()
 * @method \Clearbooks\Soap\ListBankAccountsReturn listBankAccounts()
 * @method \Clearbooks\Soap\Currency[] listCurrencies()
 * @method \Clearbooks\Soap\Entity[] listEntities(\Clearbooks\Soap\EntityQuery $query)
 * @method \Clearbooks\Soap\Invoice[] listInvoices(\Clearbooks\Soap\InvoiceQuery $query)
 * @method \Clearbooks\Soap\ListOutstandingBalancesReturn[] listOutstandingBalances(string $type, int $limit)
 * @method \Clearbooks\Soap\Project[] listProjects(int $offset)
 * @method \Clearbooks\Soap\Theme[] listThemes()
 * @method \Clearbooks\Soap\AccountCodeResult updateAccountCode(int $codeId, \Clearbooks\Soap\AccountCodeRequest $code)
 * @method int updateEntity(int $entityId, \Clearbooks\Soap\Entity $entity)
 * @method \Clearbooks\Soap\ProjectReturn updateProject(int $projectId, \Clearbooks\Soap\Project $project)
 * @method \Clearbooks\Soap\ResponseStatus voidInvoice(\Clearbooks\Soap\InvoiceRef $invoice)
 * @method \Clearbooks\Soap\ResponseStatus voidPayment(\Clearbooks\Soap\RemovePayment $payment)
 * @method \Clearbooks\Soap\CreditResponseStatus writeOff(\Clearbooks\Soap\CreditQuery $query)
 * @method int createBankAccount(\Clearbooks\Soap\BankAccount $bankAccount)
 * @method \Clearbooks\Soap\PaymentMethod[] listPaymentMethods()
 */
class ClearbooksSoap extends \SoapClient
{
protected static $classMap = [
        'AccountCode' => 'Clearbooks\Soap\AccountCode',
        'AccountCodeHeading' => 'Clearbooks\Soap\AccountCodeHeading',
        'AccountCodeRequest' => 'Clearbooks\Soap\AccountCodeRequest',
        'AccountCodeResult' => 'Clearbooks\Soap\AccountCodeResult',
        'AllocateQuery' => 'Clearbooks\Soap\AllocateQuery',
        'BankAccount' => 'Clearbooks\Soap\BankAccount',
        'BankAccountListItem' => 'Clearbooks\Soap\BankAccountListItem',
        'BankDetails' => 'Clearbooks\Soap\BankDetails',
        'BankStatementLine' => 'Clearbooks\Soap\BankStatementLine',
        'CreditPartialQuery' => 'Clearbooks\Soap\CreditPartialQuery',
        'CreditQuery' => 'Clearbooks\Soap\CreditQuery',
        'CreditResponseStatus' => 'Clearbooks\Soap\CreditResponseStatus',
        'Currency' => 'Clearbooks\Soap\Currency',
        'Entity' => 'Clearbooks\Soap\Entity',
        'EntityExtra' => 'Clearbooks\Soap\EntityExtra',
        'EntityOutstandingBalance' => 'Clearbooks\Soap\EntityOutstandingBalance',
        'EntityQuery' => 'Clearbooks\Soap\EntityQuery',
        'ExchangeRateRequest' => 'Clearbooks\Soap\ExchangeRateRequest',
        'Invoice' => 'Clearbooks\Soap\Invoice',
        'InvoiceQuery' => 'Clearbooks\Soap\InvoiceQuery',
        'InvoiceRef' => 'Clearbooks\Soap\InvoiceRef',
        'InvoiceReturn' => 'Clearbooks\Soap\InvoiceReturn',
        'Item' => 'Clearbooks\Soap\Item',
        'Journal' => 'Clearbooks\Soap\Journal',
        'JournalLedgerItem' => 'Clearbooks\Soap\JournalLedgerItem',
        'JournalReturn' => 'Clearbooks\Soap\JournalReturn',
        'ListBankAccountsReturn' => 'Clearbooks\Soap\ListBankAccountsReturn',
        'ListOutstandingBalancesReturn' => 'Clearbooks\Soap\ListOutstandingBalancesReturn',
        'ListThemesReturn' => 'Clearbooks\Soap\ListThemesReturn',
        'Payment' => 'Clearbooks\Soap\Payment',
        'PaymentInvoice' => 'Clearbooks\Soap\PaymentInvoice',
        'PaymentMethod' => 'Clearbooks\Soap\PaymentMethod',
        'PaymentReturn' => 'Clearbooks\Soap\PaymentReturn',
        'Project' => 'Clearbooks\Soap\Project',
        'ProjectReturn' => 'Clearbooks\Soap\ProjectReturn',
        'RemovePayment' => 'Clearbooks\Soap\RemovePayment',
        'ResponseStatus' => 'Clearbooks\Soap\ResponseStatus',
        'Theme' => 'Clearbooks\Soap\Theme'
    ];
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @param string $apiKey
     * @param string $wsdl
     * @param array $options
     * @throws \Exception
     */
    public function __construct($apiKey, $wsdl = '', $options = []) {
        if (!$apiKey) {
            throw new \Exception('An API Key must be specified');
        }

        $this->apiKey = $apiKey;

        if (!$wsdl) {
            $wsdl = 'https://secure.clearbooks.co.uk/api/accounting/wsdl/';
        }

        if (!is_array($options)) {
            $options = [];
        }

        if (!array_key_exists('trace', $options)) {
            $options['trace'] = 1;
        }

        foreach (self::$classMap as $key => $value) {
            if (!isset($options['classmap'][$key])) {
                $options['classmap'][$key] = $value;
            }
        }

        parent::__construct($wsdl, $options);

        $this->namespace = str_replace('wsdl', 'soap', $wsdl);

        $header = new SoapHeader($this->namespace, 'authenticate', ['apiKey' => $this->apiKey]);
        $this->__setSoapHeaders([$header]);
    }

    /**
     * {@inheritDoc}
     */
    public function __getLastResponse() {
        return $this->_formatXml(parent::__getLastResponse());
    }

    /**
     * {@inheritDoc}
     */
    public function __getLastRequest() {
        return $this->_formatXml(parent::__getLastRequest());
    }

    /**
     * @param string $xml
     * @return string
     */
    private function _formatXml($xml) {
        $doc = new \DomDocument('1.0');
        $doc->loadXML($xml);
        $doc->formatOutput = true;
        return $doc->saveXML();
    }
}