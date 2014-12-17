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

        if ($this->user->id != $transaction->user_id) {
            return Redirect::route('home');
        }

        $items = $transaction->items;

        $total = 0;
        foreach ($items as $item) {
            $total += $item->amount;
        }

        $single = TRUE;
        $content = View::make('v3.cart.invoice', compact('transaction', 'items', 'total', 'single'))->render();
        return View::make('v3.cart.invoice_wrapper', compact('content'));


    }


    public function download($id)
    {
        $transaction = $this->transactions->find($id);

        if ($this->user->id != $transaction->user_id) {
            return Redirect::route('home');
        }

        $items = $transaction->items;

        $total = 0;
        foreach ($items as $item) {
            $total += $item->amount;
        }

        $view = View::make('v3.cart.invoice', compact('transaction', 'items', 'total'));


        return PDF::load($view, 'A4', 'portrait')->download('Invoice_' . $id.'.pdf');

    }
}