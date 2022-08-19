<?php

    session_start();

    require_once(__DIR__.'/tcpdf_import.php');

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('NZZ Connect');
    $pdf->SetTitle('Programm');
    $pdf->SetSubject('Event Programm');
    $pdf->SetKeywords('programm, event, speaker'); 

    // remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(20, 1, 10);

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
        
    foreach($_SESSION['programm'] as $datum => $programm_day){
        
        $pdf->AddPage();
        $html = '';

        //STYLE
        $html .= '<style>' . file_get_contents("programm_style.css") .'</style>';

        $html .= '<div class="container">';
        $html .= '<h1>'.$datum.'</h1>';
        $html .= '<table cellspacing="0" cellpadding="10">';
        foreach( $programm_day as $datum => $slot ){
            $html .= '<tr>';
                //time
                $padding = '5';
                $html .= '<td width="150" class="schedule-row">';
                    //$html .= '<span height="'.$padding.'"></span>';
                    $html .= '<p class="hour"><b>'.date( 'H:i', strtotime($slot['start']) ).'</b> – '.date( 'H:i', strtotime($slot['ende']) ).'</p>';
                    //$html .= '<span height="2"></span>';
                $html .= '</td>';

                    $column_width = '450';
                    //$html .= '<span height="'.$padding.'"></span>';
                    switch ($slot['acf_fc_layout']) {
                        case 'standard':
                            $html .= '<td width="'.$column_width.'" class="schedule-row standard">';
                            $html .= cast_standard_slot($slot);
                            break;
                        case 'filler':
                            $html .= '<td width="'.$column_width.'" class="schedule-row filler">';
                            $html .= cast_filler_slot($slot);
                            break;
                        case 'placeholder';
                            $html .= '<td width="'.$column_width.'" class="schedule-row placeholder">';
                            $html .= cast_placeholder_slot($slot);
                            break;
                        case 'show':
                            $html .= '<td width="'.$column_width.'" class="schedule-row show">';
                            $html .= cast_show_slot($slot);
                            break;
                        case 'panel':
                            $html .= '<td width="'.$column_width.'" class="schedule-row panel">';
                            $html .= cast_panel_slot($slot);
                            break;

                        case 'speaker':
                            $html .= '<td width="'.$column_width.'" class="schedule-row speaker">';
                            $html .= cast_speaker_slot($slot);
                            break;
                        case 'session':
                            $html .= '<td width="'.$column_width.'" class="schedule-row session">';
                            $html .= cast_session_slot($slot);
                            break;
                        default:
                            # code...
                            break;
                    }
                    //$html .= '<span height="2"></span>';
                $html .= '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';       
        $html .= '</div>';  

        $pdf->writeHTML($html, true, false, true, false, '');
    }
   
    // print a block of text using Write()
    

    // ---------------------------------------------------------
    //Close and output PDF document
    ob_end_clean();

    $filename = 'Programm_' .date('Y'). '.pdf';
    $pdf->Output($filename, 'D');

    //STANDARD SLOT
    function cast_standard_slot($slot){
        $standard_slot = '';
        $standard_slot .= '<h2>'.$slot['bezeichnung'].'</h2>';
        $standard_slot .= $slot['lead'] ? '<p>'.$slot['lead'].'</p>' : '';
        return $standard_slot;
    }

    //FILLER SLOT
    function cast_filler_slot($slot){
        $filler_slot = "";
        $filler_slot .= '<h2>'.$slot['bezeichnung'].'</h2>';
        $filler_slot .= $slot['lead'] ? '<p>'.$slot['lead'].'</p>' : '';
        return $filler_slot;
    }

    //PLACEHOLDER SLOT
    function cast_placeholder_slot($slot){
        $placeholder_slot = '';
        $placeholder_slot .= '<h2>'.$slot['bezeichnung'].'</h2>';
        $placeholder_slot .= $slot['lead'] ? '<p>'.$slot['lead'].'</p>' : '';
        return $placeholder_slot;
    }

    //SHOW SLOT
    function cast_show_slot($slot){
        $show_slot = '';
        $show_slot .= '<h2>'.$slot['bezeichnung'].'</h2>'; 
        $show_slot .= $slot['lead'] ? '<p>'.$slot['lead'].'</p>' : '';
        return $show_slot;
    }

    //PANEL SLOT
    function cast_panel_slot($slot){
        $panel_slot = '';
        $panel_slot .= '<h2>'.$slot['bezeichnung'].'</h2>';  
        $panel_slot .=$slot['lead'] ? '<p>'.$slot['lead'].'</p>' : '';
            foreach($slot['speakers'] as $key => $speaker ) {
                $panel_slot .= '<table>';
                $panel_slot .= '<tr>';
                $panel_slot .= '<td width="50">';
                $panel_slot .= '<img src="'.$speaker['image'].'" width="30" height="30"/>';
                $panel_slot .= '</td>';
                //$panel_slot .= '</div>';
                $panel_slot .= '<td width="350">';
                $panel_slot .= '<h3>'.$speaker['name'].'</h3>';
                $panel_slot .= '<p>'.$speaker['funktion'].'</p>';
                $panel_slot .= '</td >';
                $panel_slot .= '</tr>';
                $panel_slot .= '</table>';
                
            }
        return $panel_slot;
    }

    //SPEAKER SLOT
    function cast_speaker_slot($slot){
        $speaker_slot = '';

        $speaker_slot .= '<table>';
        $speaker_slot .= '<tr>';
        $speaker_slot .= '<td width="50">';
        $speaker_slot .= '<img src="'.$slot['image'].'" width="30" height="30"/>';
        $speaker_slot .= '</td>';
        //$panel_slot .= '</div>';
        $speaker_slot .= '<td width="350">';
        $speaker_slot .= '<h3>'.$slot['name'].'</h3>';
        $speaker_slot .= '<p>'.$slot['funktion'].'</p>';
        $speaker_slot .= '</td >';
        $speaker_slot .= '</tr>';
        $speaker_slot .= '</table>';
            
        return $speaker_slot;
    }

    //SESSION SLOT
    function cast_session_slot($slot){
        $session_slot = '';
        $session_slot = '<h2>'.$slot['slot'].'</h2>';

        
        if( $slot['sessions'] ){
            $row_count = 0;
            $session_slot .= '<table cellspacing="3" cellpadding="6">';
            $session_slot .= '<tr>';
            foreach($slot['sessions'] as $session ){
                
                $session_slot .= ( $row_count%2 == 0 && $row_count != 0 ) ? '</tr><tr>' : '';
                $row_count++;
                $session_slot .= '<td width="200" style=" background-color: #e5e5e5;">';
                //$session_slot .= '<div style="overflow:hidden; height:50px; " height="50"><img src="'.$session['image'].'" width="200" height="auto"/></div>';
                $session_slot .= '<h3>'.$session['titel'].'</h3>';
                //$session_slot .= '<p>'.$slot['funktion'].'</p>';
                $session_slot .= '</td>';
            }
            $session_slot .= '</tr>';
            $session_slot .= '</table>';
        }
       

        return $session_slot;
    }