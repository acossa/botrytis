<?php

function echo_results($query) {
    echo '
    <table id="query" class="display" width="100%" cellspacing="0">
        <thead><th>Gene Locus</th></thead>
        <tbody>';

    $current_row = "";
    // $flag = false;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        if ($row['gene_locus']!=$current_row) {
            $current_row = $row['gene_locus'];
            // if ($flag) {
                echo '<tr><td>'.$current_row.'</td></tr>';
            }
            // else $flag = true;
        }

    echo '
        </tbody>
    </table>';

    echo "
		<script type=\"text/javascript\">
			$(document).ready(function() {
				$('#test').DataTable({
					dom: 'Bfrtip',
					lengthMenu: [
			            [ 10, 25, 50, -1 ],
			            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
			        ],
			        columnDefs: [
			            {
			                targets: -1,
			                visible: false
			            }
       				],

					buttons: [
					 	{
							extend: 'collection',
			                text: 'Export',
			                buttons: [
			                	{
					                extend: 'copyHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'csvHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'excelHtml5',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'pdfHtml5',
					                orientation: 'landscape',
               						pageSize: 'LEGAL',
					                exportOptions: {
					                    columns: ':visible'
					                }
					            },
					            {
					                extend: 'print',
					                exportOptions: {
					                    columns: ':visible'
					            	}
					            }
			                ]
						},
						'pageLength',
						{
							extend: 'colvis'
						}
					]
				});
			} );
		</script>";
}
?>
