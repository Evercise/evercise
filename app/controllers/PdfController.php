<?php


class PdfController extends \BaseController
{


    public function postPdf()
    {
        $sessionmembers = json_decode(Input::get('postMembers'), true);
        $evercisesession = Input::get('postEverciseSession');
        $evercisegroup = Input::get('postEverciseGroup');

        $timestamp = date("d-m-Y");


        $pdfPage = PdfHelper::pdfView($evercisegroup, $evercisesession, $sessionmembers);

        return PDF::load($pdfPage, 'A4', 'portrait')->download($evercisegroup.'-'.$timestamp);

    }

    public function getPdf($session_id)
    {
        $evercisesession = Evercisesession::find($session_id);
        $evercisegroup = Evercisegroup::find($evercisesession->evercisegroup_id);

        $sessionmembers = $evercisesession->getSessionmembers();

        $timestamp = date("d-m-Y");

        $pdfPage = PdfHelper::pdfView($evercisegroup, $evercisesession, $sessionmembers);

        return PDF::load($pdfPage, 'A4', 'portrait')->download($evercisegroup->id.'-'.$timestamp);

    }

}