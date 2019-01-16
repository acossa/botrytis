<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Region view</title>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/content.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="heading">
        Botrytis Cynerea Database
    </div>
    <div class="main">
        <div class="content">
        <?php
            $region = "$_POST[field_region]";
            // echo "$region</br>"; // TEST
            $region = preg_split("/\s-\s/", $region);
            // echo "$region[0]</br>"; // TEST
            // echo "$region[1]</br>"; // TEST

            // Query
            // try {
            //     $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
            //     $query_region = $dbh->query('SELECT gene_locus, gene_seq, gene_start, gene_stop, gene_length, gene_strand, gene_supercontig, gene_operon, trans_id FROM gene WHERE gene_start >= '.$region_start.' AND gene_stop <= '.$region_stop.';');
            //
            //     while ($row = $query_region->fetch(PDO::FETCH_ASSOC)) {
            //         // print_r($row);
            //         $locus = $row['gene_locus'];
            //         $seq = $row['gene_seq'];
            //         $start = $row['gene_start'];
            //         $stop = $row['gene_stop'];
            //         $length = $row['gene_length'];
            //         $strand = $row['gene_strand'];
            //         $supercontig = $row['gene_supercontig'];
            //         $operon = $row['gene_operon'];
            //         $trans = $row['trans_id'];
            //     }
            // } catch (PDOException $e) {
            //     echo "Erreur ! " . $e->getMessage() . "<br/>";
            //     die();
            // } catch (Exception $ee) {
            //     echo "Erreur ! " . $ee->getMessage() . "<br/>";
            //     die();
            // }
            // ?>

</html>
