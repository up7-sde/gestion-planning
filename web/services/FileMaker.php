<?php
class FileMaker{
    private function loadFile($data, $delimiter=","){
        
        $file = fopen('php://temp', 'w'); 
        
        /*les headers pour l'encodage*/
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        /*les noms de colonne*/
        fputcsv($file, array_keys($data[0]));

        // les data
        foreach ($data as $obs) {     
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