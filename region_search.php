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
    <link rel="stylesheet" type="text/css" href="DataTables\fixedHeader.dataTables.min.css">
    <script type="text/javascript" src="./DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./DataTables\dataTables.fixedHeader.min.js"></script>
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
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
                $query_region = $dbh->query('SELECT gene_locus, gene_seq, gene_start, gene_stop, gene_length, gene_strand, gene_supercontig, gene_operon, trans_id FROM gene WHERE gene_start >= '.$region[0].' AND gene_stop <= '.$region[1].';');
            } catch (PDOException $e) {
                echo "Erreur ! " . $e->getMessage() . "<br/>";
                die();
            } catch (Exception $ee) {
                echo "Erreur ! " . $ee->getMessage() . "<br/>";
                die();
            }
            $colnames = array('Gene Locus', 'Gene Sequence', 'Start', 'Stop', 'Length', 'Strand', 'Supercontig', 'Gene Operon', 'Transcript');
            ?>

            <script>
            $(document).ready(function() {
                $('#table_region').DataTable( {
                    fixedHeader: true
                });
            } );
            </script>
            <table id="table_region" class="display" style="width:100%">
                <thead>
                    <!-- Colnames -->
                    <?php foreach ($colnames as $col => $value) {
                        echo '<th>'.$value.'</th>';
                    }
                    ?>
                </thead>
                <tbody>
                    <?php
                    try {
                        while ($row = $query_region->fetch(PDO::FETCH_ASSOC)) {
                            // print_r($row);
                            echo '<tr>';
                            foreach($row as $key=>$value) {
                                // echo each value in a table box
                                // echo $key.'</br>'; // TEST
                                if ($key == "gene_seq") {
                                    echo '<td style="word-break: break-all" width="33%" >'.$value.'</td>';
                                } else if ($key == "gene_operon") {
                                    echo '<td style="word-break: break-all" width="10%" >'.$value.'</td>';
                                } else {
                                    echo '<td style="text-align:center">'.$value.'</td>';
                                }
                            }
                            echo '</tr>';
                        }
                    } catch (Exception $e) {
                        echo "Erreur ! " . $e->getMessage() . "<br/>";
                        die();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
