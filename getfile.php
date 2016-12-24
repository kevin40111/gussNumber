<?
if(isset($_GET["action"])){
    switch ($_GET['action'])
    {
        case 'downloadRecord':
            header("Content-type: text/plain");
            header("Content-Disposition: attachment; filename=inputRecord.txt");
            $displayRecord = explode('!',$_GET['inputData']);
            foreach ($displayRecord  as $value ) echo $value."\r\n";
        break;
        default:
        break;
    }
}
?>