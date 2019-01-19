<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blast</title>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/content.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/Buttons-1.5.4/css/buttons.dataTables.min.css">
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="./DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="./DataTables/Buttons-1.5.4/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="./DataTables/Buttons-1.5.4/js/buttons.html5.min.js"></script>
    <!-- <script type="text/javascript" src="./DataTables/pdfmake-0.1.36/pdfmake.min.js"></script> -->
    <!-- <script type="text/javascript" src="./DataTables/pdfmake-0.1.36/vfs_fonts.js"></script> -->


</head>
<body>
    <div class="heading">
        Botrytis Cynerea Database
    </div>
    <div class="main">
        <div class="content" style="width:50%;">
            <p>
                <?php
                $flag = false;
                if (!isset($seq)) {
                    $seq = "";
                } else {
                    $seq = $_POST['blast_seq'];
                }
                ?>
                <h1>Blast</h1>
                </br>
                </br>
                <form method="POST" name="blast_form" id="blast_form" style="margin:5px">
                    <textarea form="blast_form" name="blast_seq" id="input_seq" required autofocus rows="10" cols="55" placeholder="Paste your nucleotide or protein sequence here...">
                        <?php if($seq!="") { echo('value="'.$seq.'" '); } ?>
                    </textarea></br>
                    Select the type of your sequence:
                    <input type="radio" name="radio_blast" required value="N"> Nucleotide</input>
                    <input type="radio" name="radio_blast" value="P"> Protein</input></br>
                    <input type="submit" name="submit_blast" value=" Submit " style="margin-top:5px">
                </form>
            </p>

            <!-- Display Blast results -->
            <div>
                <?php
                // print_r($_POST['blast_seq']); // TEST
                // var_dump(isset($_POST["blast_seq"])); // TEST
                // var_dump(isset($_POST["radio_blast"])); // TEST
                if (isset($_POST["blast_seq"]) && isset($_POST["radio_blast"])) { // && $flag==true
                    echo '</br><h1>Result(s) of your query:</h1></br>';
                    // Strip all special chars in html entities: eg. > & --> &gt; &amp;
                    $seq = htmlspecialchars($_POST["blast_seq"]);
                    if ($_POST["radio_blast"] == ("N"||"P")) {
                        $type = $_POST["radio_blast"];
                    }
                    // echo $seq."</br>"; // TEST
                    // echo $type."</br>"; // TEST

                    // Creation/opening of the query file
                    $blast_file = fopen('blast/blast.fasta', 'a+'); // potentiellement remplacer a+ par a si tout fonctionne
                    fputs($blast_file, $seq);
                    fclose($blast_file);

                    // echo exec('whoami'); // TEST
                    if ($type == "N") { // Nucleotide sequence
                        // Execute the BLASTn query
                        exec('blastn -query blast/blast.fasta -db blast/blast_bcdb_gene -outfmt "10 sseqid qlen slen sstart send length evalue" -out blast/blast_res.bl 2>&1');
                    } else if ($type == "P") { // Protein sequence
                        // Execute the BLASTp query
                        exec('blastp -query blast/blast.fasta -db  blast/blast_bcdb_prot -outfmt "10 sseqid qlen slen sstart send length evalue" -out blast/blast_res.bl 2>&1');
                    }

                    $blast_res_file = fopen('blast/blast_res.bl', 'r');
                    $blast_res_var = fgetcsv($blast_res_file,",");
                    fclose($blast_res_file);
                    unlink('blast/blast.fasta');

                    $colnames = array('Subject ID', 'Query Length', 'Subject Length', 'Subject Start', 'Subject Stop', 'Alignment length', 'E-value');
                    ?>
                    <script>
                    $(document).ready(function() {
                        $('#table_blast').DataTable( {
                            // fixedHeader: true
                            "searching": false,
                            dom: 'Bfrtip',
                            buttons: [
                                { extend: 'csv', text: 'Download as CSV' }
                            ],
                        });
                    } );
                    </script>
                    <table id="table_blast" class="display" style="width:100%; text-align:center;">
                        <thead>
                            <!-- Colnames -->
                            <?php
                            foreach ($colnames as $col => $value) {
                                echo '<th>'.$value.'</th>';
                            }
                            ?>
                        </thead>
                        <tbody>
                            <!-- Function used to display the content of the csv file as a table -->
                            <?php
                            $row = 1;
                            if (($handle = fopen("blast/blast_res.bl", "r")) !== FALSE) {
                                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                    $num = count($data);
                                    $row++;
                                    echo "<tr>";
                                    for ($i=0; $i < $num; $i++) {
                                        echo "<td>".$data[$i]."</td>\n";
                                    }
                                    echo "</tr>";
                                }
                                fclose($handle);
                            }
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Botrytis cinerea Database 2019</p>
    </div>
</body>
</html>
