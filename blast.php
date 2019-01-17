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
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script>
    function isEmpty() {

        var inseq = document.getElementById('input_seq').value;
        var inrad = document.getElementById('radio_blast').value;

        if (inseq == "") {
            alert("Please enter a sequence in the field!");
        } else if (inrad == "") {
            alert("Please select the type of your sequence!");
        } else if (inseq == "" && inrad == "") {
            alert("Please enter a sequence in the field and select its type!");
        } else {
            <?php $flag = true; ?>
        }
    }
    </script>
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
                // if (!isset($seq)) {
                //     $seq = "";
                // } else {
                //     $seq = $_POST['input_seq'];
                // }
                ?>
                <h1>Blast</h1></br>
                <h3>Paste your nucleotide or protein sequence here:</h3></br>
                <form method="POST" name="blast_form" id="blast_form" style="margin:5px">
                    <textarea form="blast_form" name="blast_seq" id="input_seq" <?php if(isset($seq)) echo('value="'.$seq.'"'); ?> required rows="10" cols="50"></textarea></br>
                    Select the type of your sequence:
                    <input type="radio" name="radio_blast" value="N"> Nucleotide</input>
                    <input type="radio" name="radio_blast" value="P"> Protein</input></br>
                    <input type="submit" name="submit_blast" value=" Submit " onclick="isEmpty()">
                </form>
            </p>

            <!-- Display Blast results -->
            <div>
                <?php
                // print_r($_POST['blast_seq']); // TEST
                // var_dump(isset($_POST["blast_seq"])); // TEST
                // var_dump(isset($_POST["radio_blast"])); // TEST
                if (isset($_POST["blast_seq"]) && isset($_POST["radio_blast"])) { // && $flag==true
                    // On suppose pour l'instant que les sequences entrees sont correctes...
                    $seq = $_POST["blast_seq"];
                    $type = $_POST["radio_blast"];
                    // echo $seq."</br>"; // TEST
                    // echo $type."</br>"; // TEST

                    // Creation/opening of the query file
                    $blast_file = fopen('blast/blast.fasta', 'a+'); // potentiellement remplacer a+ par a si tout fonctionne
                    fputs($blast_file, $seq);
                    fclose($blast_file);

                    // echo exec('whoami'); // TEST
                    if ($type == "N") { // Nucleotide sequence
                        // Execute the BLAST query
                        exec('blastn -query blast/blast.fasta -db blast/blast_bcdb_gene -outfmt "10 sseqid qlen slen sstart send length evalue" -out blast/blast_res.bl 2>&1');
                    } else if ($type == "P") { // Protein sequence
                        // Execute the BLAST query
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
                            fixedHeader: true
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
                            <?php
                            $row = 1;
                            if (($handle = fopen("blast/blast_res.bl", "r")) !== FALSE) {
                                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                    $num = count($data);
                                    // echo "<p> $num champs à la ligne $row: <br /></p>\n";
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
