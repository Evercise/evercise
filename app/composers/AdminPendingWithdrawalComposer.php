<?php namespace composers;

use Withdrawalrequest;

class AdminPendingWithdrawalComposer {

    public function compose($view)
    {


        $pendingWithdrawals = Withdrawalrequest::getPendingWithdrawals();

        $processedWithdrawals = Withdrawalrequest::getProcessedWithdrawals();

        $view
            ->with('pendingWithdrawals', $pendingWithdrawals)
            ->with('processedWithdrawals', $processedWithdrawals);
    }
}