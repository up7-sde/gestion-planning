<?php
class FileMaker{
    private function loadFile($data, $delimiter=","){
        
        $file = fopen('php://memory', 'w'); 
        
        /*les headers*/
        fputcsv($file, array_keys($data[0]));
        // loop over the input array
        foreach ($data as $obs) { 
            // generate csv lines from the inner arrays
            fputcsv($file, $obs, $delimiter); 
        }
        
        rewind($file);

        return $file;
    }
    public function passToBrowser($data, $filename="export.csv"){
        
        $file = $this->loadFile($data);
        
        header('Content-Type: application/csv; charset=UTF-8');
        header('Content-Disposition: attachment;filename="'.$filename.'";');

        fpassthru($file);

        fclose($file);
    }
}
?>

