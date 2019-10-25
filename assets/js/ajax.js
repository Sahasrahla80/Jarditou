$(document).ready(function() {
           $("#select1").change(function() {
		       var cat = $("#select1").val();
		       console.log(cat);	   
    	       $("#select2").load("produits/souscategorie/",cat);
    	   });
           /*$("#select2").click(function() {
		       var cat = 'cat_parent=' + $("#select2_1").val();
		       console.log(cat);	   
		       $("#select3").load("listeoption3.php",cat);
 	       });*/
    });