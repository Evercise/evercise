<?php

/**
 * Class PdfHelper
 */
class PdfHelper
{

    /**
     * @param $evercisegroup
     * @param $evercisesession
     * @param $sessionmembers
     * @return \Illuminate\View\View
     */
    public static function pdfView($evercisegroup, $evercisesession, $sessionmembers)
    {
        $pdfPage = View::make('v3.pdf.session_members')
            ->with('evercisegroup', $evercisegroup)
            ->with('evercisesession', $evercisesession)
            ->with('sessionmembers', $sessionmembers);
        return $pdfPage;
    }
}