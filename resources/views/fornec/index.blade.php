<div>
    @php
        ini_set('default_charset', 'UTF-8');

        ob_start();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=fornec.csv');

        //Apagando arquivo antigo
        if (file_exists('fornec.csv')) {
            unlink('fornec.csv');
        }

        ob_end_clean();

        //Gerando arquivo novo
        $file = fopen('php://output', 'w');

        foreach ($dados as $line) {
            fputcsv($file, $line, ';', "'");
        }

        fclose($file);

        exit();
    @endphp
</div>
