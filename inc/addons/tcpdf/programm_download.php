<?php
  
  
    
   /*  $url = '';

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {  
        $url = "https://";   }
    else  {
        $url = "http://";   }
   
    $host =  $url.$_SERVER['HTTP_HOST'];   
    $url = $protocol.$host.'/SimplEvent_v2/wp-json/wp/v2/pages/'.$_POST['downloadpdf'];
    
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 2);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); 

    $result = curl_exec($curl);

    if($e = curl_error($curl)){
        echo $e;
    } else {
        $decoded = json_decode($result);
        echo '<pre>';
        print_r($decoded); 
    }  

    curl_close($result); */

    /*
    $args = array(
        'post_type' => 'speakers', 
        'tax_query' => array(
            array(
                'taxonomy' => 'jahr',
                'field'    => 'slug',
                'terms'    => '2022',
            ),
        ),
    );

    $speakers = new WP_Query( $args ); */
    
    // 1st Method - Declaring $wpdb as global and using it to execute an SQL query statement that returns a PHP object
   
    //$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT );
    echo 'haaaa';
    //var_dump($results);


if(false){
if( !isset ( $_POST['downloadpdf'] ) ) {
    print_r($_POST);
    $programmData = $_POST['downloadpdf'];
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
    $pdf->SetFont('times', 'BI', 20);

    // add a page
    $pdf->AddPage();

    // set some text to print
    $txt = <<<EOD
    TCPDF Example 002

    Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
    EOD;

    // print a block of text using Write()
    $pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

    // ---------------------------------------------------------
    //Close and output PDF document
    ob_end_clean();

    $filename = $programmData . '.pdf';
    $pdf->Output($filename, 'D');


}
}