<?php
namespace Clearbooks\Soap;

/**
 * PHP client for interacting with the Clearbooks SOAP API.
 *
 * @author Clear Books <api@clearbooks.co.uk>
 * @author Khoo Systems Limited <support@khoosys.net>
 * @version 2.0
 * @package Clearbooks\Soap
 */
class ClearbooksSoap extends \SoapClient
{
    /**
     * Mapping of SOAP types to PHP classes.
     *
     * @var array<string, string>
     */
    protected static $classMap = [
        'AccountCode'                   => 'Clearbooks\Soap\AccountCode',
        'AccountCodeHeading'            => 'Clearbooks\Soap\AccountCodeHeading',
        'AccountCodeRequest'            => 'Clearbooks\Soap\AccountCodeRequest',
        'AccountCodeResult'             => 'Clearbooks\Soap\AccountCodeResult',
        'AllocateQuery'                 => 'Clearbooks\Soap\AllocateQuery',
        'BankAccount'                   => 'Clearbooks\Soap\BankAccount',
        'BankAccountListItem'           => 'Clearbooks\Soap\BankAccountListItem',
        'BankDetails'                   => 'Clearbooks\Soap\BankDetails',
        'BankStatementLine'             => 'Clearbooks\Soap\BankStatementLine',
        'CreditPartialQuery'            => 'Clearbooks\Soap\CreditPartialQuery',
        'CreditQuery'                   => 'Clearbooks\Soap\CreditQuery',
        'CreditResponseStatus'          => 'Clearbooks\Soap\CreditResponseStatus',
        'Currency'                      => 'Clearbooks\Soap\Currency',
        'Entity'                        => 'Clearbooks\Soap\Entity',
        'EntityExtra'                   => 'Clearbooks\Soap\EntityExtra',
        'EntityOutstandingBalance'      => 'Clearbooks\Soap\EntityOutstandingBalance',
        'EntityQuery'                   => 'Clearbooks\Soap\EntityQuery',
        'ExchangeRateRequest'           => 'Clearbooks\Soap\ExchangeRateRequest',
        'Invoice'                       => 'Clearbooks\Soap\Invoice',
        'InvoiceQuery'                  => 'Clearbooks\Soap\InvoiceQuery',
        'InvoiceRef'                    => 'Clearbooks\Soap\InvoiceRef',
        'InvoiceReturn'                 => 'Clearbooks\Soap\InvoiceReturn',
        'Item'                          => 'Clearbooks\Soap\Item',
        'Journal'                       => 'Clearbooks\Soap\Journal',
        'JournalLedgerItem'             => 'Clearbooks\Soap\JournalLedgerItem',
        'JournalReturn'                 => 'Clearbooks\Soap\JournalReturn',
        'ListBankAccountsReturn'        => 'Clearbooks\Soap\ListBankAccountsReturn',
        'ListOutstandingBalancesReturn' => 'Clearbooks\Soap\ListOutstandingBalancesReturn',
        'ListThemesReturn'              => 'Clearbooks\Soap\ListThemesReturn',
        'Payment'                       => 'Clearbooks\Soap\Payment',
        'PaymentInvoice'                => 'Clearbooks\Soap\PaymentInvoice',
        'PaymentMethod'                 => 'Clearbooks\Soap\PaymentMethod',
        'PaymentReturn'                 => 'Clearbooks\Soap\PaymentReturn',
        'Project'                       => 'Clearbooks\Soap\Project',
        'ProjectReturn'                 => 'Clearbooks\Soap\ProjectReturn',
        'RemovePayment'                 => 'Clearbooks\Soap\RemovePayment',
        'ResponseStatus'                => 'Clearbooks\Soap\ResponseStatus',
        'Theme'                         => 'Clearbooks\Soap\Theme',
    ];

    /**
     * API key for authenticating with Clearbooks.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Namespace for SOAP requests.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Constructs the Clearbooks SOAP client.
     *
     * @param string $apiKey The API key for Clearbooks authentication.
     * @param string $wsdl The WSDL URL (defaults to Clearbooks API endpoint).
     * @param array $options Additional SOAP client options.
     * @throws \Exception If no API key is provided.
     */
    public function __construct($apiKey, $wsdl = '', $options = [])
    {
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

        $options['classmap'] = array_merge($options['classmap'] ?? [], self::$classMap);

        parent::__construct($wsdl, $options);

        $this->namespace = str_replace('wsdl', 'soap', $wsdl);

        $header = new \SoapHeader($this->namespace, 'authenticate', ['apiKey' => $this->apiKey]);
        $this->__setSoapHeaders([$header]);
    }

    /**
     * Allocates a payment to an invoice or entity.
     *
     * @param AllocateQuery $query The allocation query details.
     * @return ResponseStatus The status of the allocation operation.
     */
    public function allocatePayment(AllocateQuery $query): ResponseStatus
    {
        return $this->_call('allocatePayment', $query);
    }

    /**
     * Creates a new account code in Clearbooks.
     *
     * @param AccountCodeRequest $code The account code details.
     * @return AccountCodeResult The result of the account code creation.
     */
    public function createAccountCode(AccountCodeRequest $code): AccountCodeResult
    {
        return $this->_call('createAccountCode', $code);
    }

    /**
     * Creates a new entity (e.g., customer or supplier) in Clearbooks.
     *
     * @param Entity $entity The entity details.
     * @return int The ID of the created entity.
     */
    public function createEntity(Entity $entity): int
    {
        return $this->_call('createEntity', $entity);
    }

    /**
     * Creates a new invoice in Clearbooks.
     *
     * @param Invoice $invoice The invoice details.
     * @return InvoiceReturn The result of the invoice creation.
     */
    public function createInvoice(Invoice $invoice): InvoiceReturn
    {
        return $this->_call('createInvoice', $invoice);
    }

    /**
     * Creates multiple invoices in Clearbooks.
     *
     * @param Invoice[] $invoices Array of invoice details.
     * @return InvoiceReturn[] Array of results for each invoice creation.
     */
    public function createInvoices(array $invoices): array
    {
        return $this->_call('createInvoices', $invoices);
    }

    /**
     * Creates a new journal in Clearbooks.
     *
     * @param Journal $journal The journal details.
     * @return JournalReturn The result of the journal creation.
     */
    public function createJournal(Journal $journal): JournalReturn
    {
        return $this->_call('createJournal', $journal);
    }

    /**
     * Creates a new payment in Clearbooks.
     *
     * @param Payment $payment The payment details.
     * @return PaymentReturn The result of the payment creation.
     */
    public function createPayment(Payment $payment): PaymentReturn
    {
        return $this->_call('createPayment', $payment);
    }

    /**
     * Creates multiple payments in Clearbooks.
     *
     * @param Payment[] $payments Array of payment details.
     * @return PaymentReturn The result of the payments creation.
     */
    public function createPayments(array $payments): PaymentReturn
    {
        return $this->_call('createPayments', $payments);
    }

    /**
     * Creates a new project in Clearbooks.
     *
     * @param Project $project The project details.
     * @return ProjectReturn The result of the project creation.
     */
    public function createProject(Project $project): ProjectReturn
    {
        return $this->_call('createProject', $project);
    }

    /**
     * Deletes an entity from Clearbooks.
     *
     * @param int $entityId The ID of the entity to delete.
     * @return bool True if deletion was successful.
     */
    public function deleteEntity(int $entityId): bool
    {
        return $this->_call('deleteEntity', $entityId);
    }

    /**
     * Deletes a journal from Clearbooks.
     *
     * @param int $journalId The ID of the journal to delete.
     * @return bool True if deletion was successful.
     */
    public function deleteJournal(int $journalId): bool
    {
        return $this->_call('deleteJournal', $journalId);
    }

    /**
     * Retrieves an entity ID from an external ID.
     *
     * @param string $externalId The external ID to look up.
     * @return int The corresponding entity ID.
     */
    public function getEntityIdFromExternalId(string $externalId): int
    {
        return $this->_call('getEntityIdFromExternalId', $externalId);
    }

    /**
     * Gets the outstanding balance for an entity.
     *
     * @param int $entityId The entity ID.
     * @param string $type The type of balance (e.g., "sales" or "purchases").
     * @return EntityOutstandingBalance The outstanding balance details.
     */
    public function getEntityOutstandingBalance(int $entityId, string $type): EntityOutstandingBalance
    {
        return $this->_call('getEntityOutstandingBalance', $entityId, $type);
    }

    /**
     * Retrieves an exchange rate from Clearbooks.
     *
     * @param ExchangeRateRequest $request The exchange rate request details.
     * @return float The exchange rate value.
     */
    public function getExchangeRate(ExchangeRateRequest $request): float
    {
        return $this->_call('getExchangeRate', $request);
    }

    /**
     * Gets an invoice ID from its number.
     *
     * @param string $type The type of invoice (e.g., "sales" or "purchases").
     * @param string $invoicePrefix The invoice prefix.
     * @param string $invoiceNumber The invoice number.
     * @return int The invoice ID.
     */
    public function getInvoiceIdFromInvoiceNumber(string $type, string $invoicePrefix, string $invoiceNumber): int
    {
        return $this->_call('getInvoiceIdFromInvoiceNumber', $type, $invoicePrefix, $invoiceNumber);
    }

    /**
     * Gets a payment ID from an external ID.
     *
     * @param string $externalId The external ID to look up.
     * @return int The corresponding payment ID.
     */
    public function getPaymentIdFromExternalId(string $externalId): int
    {
        return $this->_call('getPaymentIdFromExternalId', $externalId);
    }

    /**
     * Lists all account code headings in Clearbooks.
     *
     * @return AccountCodeHeading[] Array of account code headings.
     */
    public function listAccountCodeHeadings(): array
    {
        return $this->_call('listAccountCodeHeadings');
    }

    /**
     * Lists all account codes in Clearbooks.
     *
     * @return AccountCode[] Array of account codes.
     */
    public function listAccountCodes(): array
    {
        return $this->_call('listAccountCodes');
    }

    /**
     * Lists all bank accounts in Clearbooks.
     *
     * @return ListBankAccountsReturn The list of bank accounts.
     */
    public function listBankAccounts(): ListBankAccountsReturn
    {
        return $this->_call('listBankAccounts');
    }

    /**
     * Lists all currencies supported by Clearbooks.
     *
     * @return Currency[] Array of currencies.
     */
    public function listCurrencies(): array
    {
        return $this->_call('listCurrencies');
    }

    /**
     * Lists entities in Clearbooks with pagination support.
     *
     * @param EntityQuery|null $query Optional query to filter entities.
     * @return Entity[] Array of entities.
     */
    public function listEntities(?EntityQuery $query = null): array
    {
        return $this->listPaginatedItems('listEntities', 1000, $query);
    }

    /**
     * Lists invoices in Clearbooks with pagination support.
     *
     * @param InvoiceQuery $query Query to filter invoices.
     * @return Invoice[] Array of invoices.
     */
    public function listInvoices(InvoiceQuery $query): array
    {
        return $this->listPaginatedItems('listInvoices', 100, $query);
    }

    /**
     * Lists outstanding balances in Clearbooks.
     *
     * @param string $type The type of balance (e.g., "sales" or "purchases").
     * @param int $limit The maximum number of results (default 10).
     * @return ListOutstandingBalancesReturn[] Array of outstanding balances.
     */
    public function listOutstandingBalances(string $type, int $limit = 10): array
    {
        return $this->_call('listOutstandingBalances', $type, $limit);
    }

    /**
     * Lists projects in Clearbooks.
     *
     * @param int $offset The offset for pagination (default 0).
     * @return Project[] Array of projects.
     */
    public function listProjects(int $offset = 0): array
    {
        return $this->_call('listProjects', $offset);
    }

    /**
     * Lists themes in Clearbooks.
     *
     * @return Theme[] Array of themes.
     */
    public function listThemes(): array
    {
        return $this->_call('listThemes');
    }

    /**
     * Updates an existing account code in Clearbooks.
     *
     * @param int $codeId The ID of the account code to update.
     * @param AccountCodeRequest $code The updated account code details.
     * @return AccountCodeResult The result of the update operation.
     */
    public function updateAccountCode(int $codeId, AccountCodeRequest $code): AccountCodeResult
    {
        return $this->_call('updateAccountCode', $codeId, $code);
    }

    /**
     * Updates an existing entity in Clearbooks.
     *
     * @param int $entityId The ID of the entity to update.
     * @param Entity $entity The updated entity details.
     * @return int The updated entity ID.
     */
    public function updateEntity(int $entityId, Entity $entity): int
    {
        return $this->_call('updateEntity', $entityId, $entity);
    }

    /**
     * Updates an existing project in Clearbooks.
     *
     * @param int $projectId The ID of the project to update.
     * @param Project $project The updated project details.
     * @return ProjectReturn The result of the update operation.
     */
    public function updateProject(int $projectId, Project $project): ProjectReturn
    {
        return $this->_call('updateProject', $projectId, $project);
    }

    /**
     * Voids an invoice in Clearbooks.
     *
     * @param InvoiceRef $invoice The invoice reference to void.
     * @return ResponseStatus The status of the void operation.
     */
    public function voidInvoice(InvoiceRef $invoice): ResponseStatus
    {
        return $this->_call('voidInvoice', $invoice);
    }

    /**
     * Voids a payment in Clearbooks.
     *
     * @param RemovePayment $payment The payment to void.
     * @return ResponseStatus The status of the void operation.
     */
    public function voidPayment(RemovePayment $payment): ResponseStatus
    {
        return $this->_call('voidPayment', $payment);
    }

    /**
     * Writes off a credit in Clearbooks.
     *
     * @param CreditQuery $query The credit write-off details.
     * @return CreditResponseStatus The status of the write-off operation.
     */
    public function writeOff(CreditQuery $query): CreditResponseStatus
    {
        return $this->_call('writeOff', $query);
    }

    /**
     * Adds bank statement lines to a bank account in Clearbooks.
     *
     * @param string $bankAccount The bank account identifier.
     * @param string $statementName The name of the statement.
     * @param BankStatementLine[] $statementLines Array of statement lines to add.
     * @return void
     */
    public function addBankStatementLines(string $bankAccount, string $statementName, array $statementLines): void
    {
        $this->_call('addBankStatementLines', $bankAccount, $statementName, $statementLines);
    }

    /**
     * Performs a partial write-off of a credit in Clearbooks.
     *
     * @param CreditPartialQuery $query The partial credit write-off details.
     * @return void
     */
    public function writeOffPartial(CreditPartialQuery $query): void
    {
        $this->_call('writeOffPartial', $query);
    }

    /**
     * Creates a new bank account in Clearbooks.
     *
     * @param BankAccount $bankAccount The bank account details.
     * @return int The ID of the created bank account.
     */
    public function createBankAccount(BankAccount $bankAccount): int
    {
        return $this->_call('createBankAccount', $bankAccount);
    }

    /**
     * Lists payment methods available in Clearbooks.
     *
     * @return PaymentMethod[] Array of payment methods.
     */
    public function listPaymentMethods(): array
    {
        return $this->_call('listPaymentMethods');
    }

    /**
     * Gets the last SOAP response as formatted XML.
     *
     * @return string|null The formatted XML response or null if none.
     */
    public function __getLastResponse(): ?string
    {
        return $this->_formatXml(parent::__getLastResponse());
    }

    /**
     * Gets the last SOAP request as formatted XML.
     *
     * @return string|null The formatted XML request or null if none.
     */
    public function __getLastRequest(): ?string
    {
        return $this->_formatXml(parent::__getLastRequest());
    }

    /**
     * Executes a SOAP call with custom namespace and action.
     *
     * @param string $name The SOAP method name.
     * @param mixed ...$parameters Variable parameters for the SOAP call.
     * @return mixed The result of the SOAP call.
     */
    protected function _call($name, ...$parameters)
    {
        return $this->__soapCall($name, $parameters, ['uri' => $this->namespace, 'soapaction' => '#' . $name]);
    }

    /**
     * Formats an XML string for readability.
     *
     * @param string $xml The XML string to format.
     * @return string The formatted XML string.
     */
    private function _formatXml($xml): string
    {
        $doc = new \DOMDocument('1.0');
        $doc->loadXML($xml);
        $doc->formatOutput = true;
        return $doc->saveXML();
    }

    /**
     * Lists items from a Clearbooks endpoint with pagination.
     *
     * @param string $endpoint The SOAP endpoint to call (e.g., 'listEntities', 'listInvoices').
     * @param int $page_size The number of items per page.
     * @param EntityQuery|InvoiceQuery|null $oQuery Optional query object for filtering.
     * @return array The complete list of items retrieved across all pages.
     */
    private function listPaginatedItems(string $endpoint, int $page_size, $oQuery = null): array
    {
        $more = true;
        $a_items = [];
        if ($oQuery === null && in_array($endpoint, ['listEntities', 'listInvoices'])) {
            $oQuery = $endpoint === 'listEntities' ? new EntityQuery() : new InvoiceQuery();
        }
        do {
            $a_result = $this->_call($endpoint, $oQuery);
            array_push($a_items, ...$a_result);
            if ($page_size == count($a_result)) {
                $oQuery->offset += $page_size;
            } else {
                $more = false;
            }
        } while ($more);

        return $a_items;
    }
}