<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gene view</title>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/content.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="./DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="./DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="./DataTables/Buttons-1.5.4/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="./DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="./DataTables/Buttons-1.5.4/js/buttons.html5.min.js"></script>
</head>

<body>
    <div class="heading">
        Botrytis Cynerea Database
    </div>
    <div class="main">
        <div class="content" id="gene_search">
        <?php
            if (preg_match("/BC1G_/", $_POST['gene_number'])) {
                $gene_locus = "$_POST[gene_number]";
            } else {
                $gene_locus = "BC1G_$_POST[gene_number]";
            }
            // echo "$gene_locus</br>"; // TEST

            // Query
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=botrytis', 'lespinet', '');
                $query_gene = $dbh->query('SELECT gene_locus, gene_seq, gene_start, gene_stop, gene_length, gene_strand, gene_supercontig, gene_operon, trans_id FROM gene WHERE gene_locus = "'.$gene_locus.'";');

                while ($row = $query_gene->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($row); // TEST
                    $locus = $row['gene_locus'];
                    $seq = $row['gene_seq'];
                    $start = $row['gene_start'];
                    $stop = $row['gene_stop'];
                    $length = $row['gene_length'];
                    $strand = $row['gene_strand'];
                    $supercontig = $row['gene_supercontig'];
                    $operon = $row['gene_operon'];
                    $trans = $row['trans_id'];
                }

                $query_prot = $dbh->query('SELECT prot_name,prot_seq, prot_length FROM protein WHERE gene_locus = "'.$locus.'" AND trans_id = "'.$trans.'";');

                while ($line = $query_prot->fetch(PDO::FETCH_ASSOC)) {
                    // print_r($row);
                    $prot_name = $line['prot_name'];
                    $prot_seq = $line['prot_seq'];
                    $prot_length = $line['prot_length'];
                }
            } catch (PDOException $e) {
                echo "Erreur ! " . $e->getMessage() . "<br/>";
                die();
            } catch (Exception $ee) {
                echo "Erreur ! " . $ee->getMessage() . "<br/>";
                die();
            }

            // $columns = array($locus, $seq, $start, $stop, $length, $strand, $supercontig, $operon, $trans);
            // foreach ($columns as $key => $value) {
            //     echo $key . " : " . $value . "</br>";
            // }
            ?>
            <script>
            $(document).ready(function() {
                $('#table_gene').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'pdf'
                    ]
                } );
            } );
            </script>
            <table id="table_gene" class="display" style="align:center">
                <tbody>
                    <tr>
                        <td><b>Gene Locus</b></td>
                        <td colspan="2"><?php echo $locus ?></td>
                    </tr>
                    <tr>
                        <td><b>Sequence</b></td>
                        <td colspan="2" style="word-break: break-all">
                            <?php echo $seq ?></br>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Start</b></td>
                        <td colspan="2"><?php echo $start ?></td>
                    </tr>
                    <tr>
                        <td><b>Stop</b></td>
                        <td colspan="2"><?php echo $stop ?></td>
                    </tr>
                    <tr>
                        <td><b>Length</b></td>
                        <td colspan="2"><?php echo $length ?></td>
                    </tr>
                    <tr>
                        <td><b>Strand</b></td>
                        <td colspan="2"><?php echo $strand ?></td>
                    </tr>
                    <tr>
                        <td><b>Supercontig</b></td>
                        <td colspan="2"><?php echo $supercontig ?></td>
                    </tr>
                    <tr>
                        <td><b>Transcript ID</b></td>
                        <td colspan="2"><?php echo $trans ?></td>
                    </tr>

                     <!-- Display Protein informations -->
                    <tr>
                        <td><b>Protein name</b></td>
                        <td colspan="2"><?php echo $prot_name ?></td>
                    </tr>
                    <tr>
                        <td><b>Protein Sequence</b></td>
                        <td  colspan="2" style="word-break: break-all">
                            <?php echo $prot_seq ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Protein Length</b></td>
                        <td colspan="2"><?php echo $prot_length ?></td>
                    </tr>
                    <?php
                    if ($operon != "") {
                        $pfam = preg_split("/;/", $operon);
                        echo
                        '<th scope="rowgroup" rowspan="'.(count($pfam)*8+1).'">
                            <b>Pfam</b>
                        </th>';

                        foreach ($pfam as $key => $value) {
                            // Link to Pfam website
                            echo '
                            <tr>
                            <th scope="colgroup" colspan="2">
                                <a href="https://pfam.xfam.org/family/'.$value.'" target="_blank" title="Pfam webpage of '.$value.'">'.$value.'</a>
                            </th>';
                            try {
                                $query_pfam = $dbh->query('SELECT MIN(id), pfam_name, pfam_description, pfam_start, pfam_stop, pfam_length, pfam_score, pfam_expected FROM pfam WHERE pfam_locus = "'.$locus.'" AND prot_name = "'.$prot_name.'" AND pfam_acc = "'.$value.'";');

                                while ($l = $query_pfam->fetch(PDO::FETCH_ASSOC)) {
                                    // print_r($row); // TEST
                                    $pfam_name = $l['pfam_name'];
                                    $pfam_desc = $l['pfam_description'];
                                    $pfam_start = $l['pfam_start'];
                                    $pfam_stop = $l['pfam_stop'];
                                    $pfam_length = $l['pfam_length'];
                                    $pfam_score = $l['pfam_score'];
                                    $pfam_eval = $l['pfam_expected'];
                                }
                            } catch (PDOException $e) {
                                echo "Erreur ! " . $e->getMessage() . "<br/>";
                                die();
                            } catch (Exception $ee) {
                                echo "Erreur ! " . $ee->getMessage() . "<br/>";
                                die();
                            }

                            // Display the Pfam results foreach Pfam accession id
                            echo '
                            <tr>
                                <td><b>
                                    Name
                                </b></td>
                                <td>
                                    '.$pfam_name.'
                                </td>
                            </tr>
                            <tr>
                                <td><b>
                                    Description
                                </b></td>
                                <td>
                                    '.$pfam_desc.'
                                </td>
                            </tr>
                            <tr>
                                <td><b>
                                    Start
                                </b></td>
                                <td>
                                    '.$pfam_start.'
                                </td>
                            </tr>
                            <tr>
                                <td><b>
                                    Stop
                                </b></td>
                                <td>
                                    '.$pfam_stop.'
                                </td>
                            </tr>
                            <tr>
                                <td><b>
                                    Length
                                </b></td>
                                <td>
                                    '.$pfam_length.'
                                </td>
                            </tr>
                            <tr>
                                <td><b>
                                    Score
                                </b></td>
                                <td>
                                    '.$pfam_score.'
                                </td>
                            </tr>
                            <tr>
                                <td><b>
                                    E-value
                                </b></td>
                                <td>
                                    '.$pfam_eval.'
                                </td>
                            </tr>
                        </tr>';
                        }

                    }
                    ?>
                </tbody>
            </table>
            <!-- <?php
            // exec('"C:/Program Files/R/R-3.5.2/bin/Rscript.exe" "C:/wamp64/www/botrytis/data/hydro.r" "'.$prot_seq.'" 21', $result);
            ?>
            <img src="data/hydro.jpg"> -->
        </div>
    </div>
    <div class="footer">
        <p>Botrytis cinerea Database 2019</p>
    </div>
</body>
</html>
