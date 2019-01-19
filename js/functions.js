/*!

*/
// Function for the genome region search slider
$( function() {
  $( "#slider-range" ).slider({
    range: true,
    min: 1,
    max: 1305633,
    values: [ 1, 1305633 ],
    slide: function( event, ui ) {
      $( "#amount" ).val(ui.values[ 0 ] + " - " + ui.values[ 1 ]);
    }
  });
  $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
    " - " + $( "#slider-range" ).slider( "values", 1 ) );
} );

// Function for correctly formatting gene_locus id: 00001
function numFormat() {
    var num = document.getElementById('gene_number').value;
    if (num.length != 5) {
        if      (num.length == 1) { num = "0000".concat(num); }
        else if (num.length == 2) { num = "000".concat(num); }
        else if (num.length == 3) { num = "00".concat(num); }
        else if (num.length == 4) { num = "0".concat(num); }
        document.getElementById('gene_number').value = num;
        //alert(num); // TEST
    }
}

// function isEmpty() {
//
//     var inseq = document.getElementById('input_seq').value;
//     var inrad = document.getElementById('radio_blast').value;
//
//     if (inseq == "") {
//         alert("Please enter a sequence in the field!");
//     } else if (inrad == "") {
//         alert("Please select the type of your sequence!");
//     } else if (inseq == "" && inrad == "") {
//         alert("Please enter a sequence in the field and select its type!");
//     } else {
//         <?php $flag = true; ?>
//     }
// }
