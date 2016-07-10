

// JQUERY CODE

$(document).ready(function(){
    
    // position the header 
    $("#header").width( $( window ).width()-80 ); // position at starting (80 is the menu width)
    $(window).on('resize', function(){  // position on resizing the window
        var windowWidth = $( window ).width();
        $("#header").width( windowWidth-80 );
    });

    

    //power consumption chart:
        window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", x);
                chart.render();
        }
        var x= {
				
				animationEnabled: true,
				theme: "theme3",
				backgroundColor:"rgb(225, 225, 225)",
				
				data: [
				{
					type: "doughnut",
					indexLabelFontFamily: "Garamond",
					indexLabelFontSize: 20,
					startAngle: 0,
					indexLabelFontColor: "dimgrey",
					indexLabelLineColor: "darkgrey",
					toolTipContent: "{y} %",
                    /*dataPOINTS:
                    {y: total power consumtion of a blook , indexLabel:"blook name: y%"}*/
                    //example
					dataPoints: [
					{ y: 51.04, indexLabel:"Room (1): {y}%" },
					{ y: 10.83, indexLabel:"Room (2): {y}%" },
					{ y: 30.20, indexLabel: "Room (3): {y}%" },
					{ y: 10.11, indexLabel: "Room (4): {y}%" },
					{ y: 20.29, indexLabel: "Room (5): {y}%" },
					{ y: 10.53, indexLabel: "Room (6): {y}%" }
                    
					]
				
            }
				]
			}
            
            //var i,sum=0;
            //for(i=0;i<x.data[0].dataPoints.length;i++){
            //    var z=x.data[0].dataPoints[i].y;                               
            //    sum+= z;
            //}            
            //power consumption total power : 
            /*totalPower is the sum of the power consumption of whole rooms */
            //var totalPower= parseInt(sum,10);     
            //$("#cons").before(totalPower);
            
        
        /**********************************/
        //Billing page
            /*billReach*/ 
           
         
           $( "#fee" )
              .keyup(function() {
                var value = $( this ).val();
               
              })
              .keyup();
          
});
