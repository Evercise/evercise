<?php namespace composers;

use Withdrawalrequest;

class AdminPendingWithdrawalComposer {

    public function compose($view)
    {


        $pendingWithdrawals = Withdrawalrequest::where('processed', 0)->with('user')->get();

        $processedWithdrawals = Withdrawalrequest::where('processed', 1)->with('user')->get();

        $view
            ->with('pendingWithdrawals', $pendingWithdrawals)
            ->with('processedWithdrawals', $processedWithdrawals);
    }
}