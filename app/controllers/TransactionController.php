<?php


use Illuminate\Log\Writer;

class TransactionController extends BaseController
{

    /**
     * @var Transactions
     */
    private $transactions;
    /**
     * @var TransactionItems
     */
    private $items;
    /**
     * @var Writer
     */
    private $log;

    public function __construct(Transactions $transactions, TransactionItems $items, Writer $log)
    {
        parent::__construct();

        $this->transactions = $transactions;
        $this->items = $items;
        $this->log = $log;
    }


    public function show($id)
    {
        $transaction = $this->transactions->find($id);
        $items = $transaction->items;
        return View::make('transactions.show', compact('transaction', 'items'));


    }

}