<?php
  
  session_start();
 
  
   
    require_once(__DIR__.'/tcpdf_import.php');
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 002');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide'); 

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(1, 1, 1);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('dejavusans', '', 20);

    // add a page
    $pdf->AddPage();

    // set some text to print
    $html = '';

    $html .= '<style>' . file_get_contents("programm_style.css") .'</style>';

    $html .= '<div class="container">';
    foreach($_SESSION['programm'] as $datum => $programm_day){
        $html .= '<h1>'.$datum.'<h1>';
        $html .= '<table>';
        foreach( $programm_day as $datum => $slot ){
            $html .= '<tr>';
                //time
                $html .= '<td>';
                $html .= '<p class="hour">'.date( 'H:i', strtotime($slot['start']) ).'</p>';
                $html .= '<p class="till">'.date( 'H:i', strtotime($slot['ende']) ).'</p>'; 
                $html .= '</td>';

                $html .= '<td>';
                switch ($slot['acf_fc_layout']) {
                    case 'standard':
                        $html .= cast_standard_slot($slot);
                        break;
                    
                    default:
                        # code...
                        break;
                }
                $html .= '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';         
    }
    $html .= '</div>';
    // print a block of text using Write()
    $pdf->writeHTML($html, true, false, true, false, '');

    // ---------------------------------------------------------
    //Close and output PDF document
    ob_end_clean();

    $filename = 'asdfasdfasdf' . '.pdf';
    $pdf->Output($filename, 'D');


    function cast_standard_slot($slot){
        $standard_slot = '';
        $standard_slot = '<h2>'.$slot['bezeichnung'].'</h2>';
        $standard_slot = '<p>'.$slot['lead'].'</p>';
        return $standard_slot;
    }
