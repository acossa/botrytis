<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Protein view</title>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/content.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="DataTables\fixedHeader.dataTables.min.css">
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
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
            $prot = "$_POST[field_prot_name]";
            // echo "$prot</br>"; // TEST

            // Query
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
                $query_prot = $dbh->query('SELECT gene_locus, trans_id, prot_seq, prot_length FROM protein WHERE prot_name = "'.$prot.'";');
            } catch (PDOException $e) {
                echo "Erreur ! " . $e->getMessage() . "<br/>";
                die();
            } catch (Exception $ee) {
                echo "Erreur ! " . $ee->getMessage() . "<br/>";
                die();
            }
            $colnames = array('Gene Locus', 'Transcript ID', 'Protein Sequence', 'Length');
            ?>

            <script>
            $(document).ready(function() {
                $('#table_prot').DataTable();
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'pdf'
                ]
            } );
            </script>
            <table id="table_prot" class="display" style="width:100%">
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
                        while ($row = $query_prot->fetch(PDO::FETCH_ASSOC)) {
                            // print_r($row);
                            echo '<tr>';
                            foreach($row as $key=>$value) {
                                // echo each value in a table box
                                // echo $key.'</br>'; // TEST
                                if ($key == "gene_locus") {
                                    echo '<td style="text-align:center">' . $value . '
                                    <form method="POST" action="gene_locus_search.php" target="_blank">
                                    <input type="hidden" name="gene_number" id="gene_number" value="'.$value.'">
                                    <input type="submit" value=" View gene ">
                                    </form>
                                    </td>';
                                } else if ($key == "prot_seq") {
                                    echo '<td style="word-break: break-all" width="33%" >'.$value.'</td>';
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
    <div class="footer">
        <p>Botrytis cinerea Database 2019</p>
    </div>
</body>
</html>
