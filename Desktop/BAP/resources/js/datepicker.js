        var newdate = new Date();
        let currentMonth = newdate.getMonth();
        let currentYear = newdate.getFullYear();
        var currPage = currentMonth; //month
		var year ;
		var day;
		let focusElement;
        document.getElementById('datepicker-year').innerHTML = currentYear;       
		function getVal(e)
		{
			 //lert(document.getElementById(e.id).value);
			 day = document.getElementById(e.id).value;
             if(day < 10){day = 0+''+day}
             let month;
             if(currPage < 9){
				 month = 0+''+ Number(currPage+1)
			 }else{
				month =  (currPage + 1);
			 }

			 focusElement.value = day +"-"+  month  + "-" + year ;
			 
		}


		$(document).ready(function(){

             let pickerInputs = document.querySelectorAll('.datepicker-input')
			 for (let index = 0; index < pickerInputs.length; index++) {
				 pickerInputs[index].addEventListener("focus", ()=>{
					getDays(currentMonth);
					$("#datepicker").css("display"," block");
					document.body.style.overflow = "hidden";
					document.body.style.height = "100vh";
					document.getElementById('datepicker-blackout').style.display = 'block';
					document.getElementById('datepicker-container').style.display = 'block';
					focusElement = pickerInputs[index];
				 });	
			 }
            
			 document.getElementById('datepicker-blackout').addEventListener('click', () =>{
					document.getElementById('datepicker-blackout').style.display ='none';
					document.getElementById('datepicker-container').style.display = 'none';
					document.body.style.overflow = "";
					document.body.style.height = "";
			 })
			 document.getElementById('date-picker-close-button').addEventListener('click', (e) =>{
				 	e.preventDefault();
					document.getElementById('datepicker-blackout').style.display ='none';
					document.getElementById('datepicker-container').style.display = 'none';
					document.body.style.overflow = "";				
					document.body.style.height = "";

			 })

			$("#next-month").click(function(){

				if(currPage < 11)
				{
					currPage =  currPage+1;
					getDays(currPage);
				}else{
                    let currentYear = document.getElementById('datepicker-year').innerHTML;
                    let newyear = (Number(currentYear) + 1);
                    document.getElementById('datepicker-year').innerHTML = newyear;
                    currPage = 0;
                    getDays(0);
                }

			});

			$("#prev-month").click(function(){

                    let datepickerYear = document.getElementById('datepicker-year').innerHTML;
					if(currPage > 0 && datepickerYear != currentYear)
					{
						currPage =  currPage-1;
						getDays(currPage);
					}else if(currPage > currentMonth && datepickerYear == currentYear){
                        currPage =  currPage-1;
						getDays(currPage);
                    }
                    else{
                        if(datepickerYear == currentYear){

                        }else{
                            let newyear = (Number(datepickerYear) - 1);
                            document.getElementById('datepicker-year').innerHTML = newyear;
                            currPage = 11;
                            getDays(11);
                        }
                        
                    }
			});


			$("#next-y").click(function(){
                let currentYear = document.getElementById('datepicker-year').innerHTML;
                let newyear = (Number(currentYear) + 1);
                document.getElementById('datepicker-year').innerHTML = newyear;
                currPage = 0;
				getDays(0);

			});


			$("#prev-y").click(function(){
                let currentYear = document.getElementById('datepicker-year').innerHTML;
                if(currentYear == newdate.getFullYear()){

                }
                else if(currentYear == newdate.getFullYear()+1){
                    let newyear = (Number(currentYear) - 1);
                    document.getElementById('datepicker-year').innerHTML = newyear;
                    currPage = currentMonth;
                    getDays(currentMonth);
                }
                else{
                    let newyear = (Number(currentYear) - 1);
                    document.getElementById('datepicker-year').innerHTML = newyear;
                    currPage = 0;
                    getDays(0);
                }
			});			

          
			function getDays(month)
			{

				$("#dt-able").empty();
				var mos=['Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','Novemeber','Decemeber']
				var day=['Zo', 'Ma', 'Di', 'Wo' , 'Do', 'Vr', 'Za']
				year = document.getElementById('datepicker-year').innerHTML;
				$("#month-title").html(mos[month]);

				$("#dt-able").append('<tr class="datepicker-head">');
				for(i = 0; i < 7; i++)
				{

					$('#dt-able').append("<td id='dt-head'>"  + day[i] + "</td>");
				}

				$("#dt-able").append('</td>');

				var firstDay = new Date(year,month, 1);
				var lastDay = new Date(year, month+1, 0);
				

		
				var offset = firstDay.getDay();
				var dayCount = 1;
				var totalRows;
				if(lastDay.getDay() == 0 || lastDay.getDay() == 1 ){
					totalRows = 6;
				}	else{
					totalRows = 5;
				}
				if(month == 1){
					totalRows = 5;
				}
				for (i = 0; i < totalRows; i++)
				{
					$('#dt-able').append("<tr id=row-"+ i +">");
					for(rw = 0; rw < 7; rw++ )
					{
						if(offset == 0)
						{

							$('#' + "row-"+ i).append("<td  id='"  + "cell-" + dayCount+ "'>"
							 +   "<input type='button' id ='day_val" +dayCount +"'"+   "class='day-button' value= '" +  dayCount + "' >"  + 
							 	
							 '</td>' );
							
							if(dayCount >= lastDay.getDate())
							{
								break;
							}
							dayCount++;
						}else
						{
							$('#' + "row-"+ i).append('<td>' +'</td>' );
							 offset--;

						}

		


					}
					$('#dt-able').append('</tr>');

				}
                let daybuttons =    document.querySelectorAll('.day-button')
                for(j = 0; j < daybuttons.length; j++){
                    daybuttons[j].addEventListener('click', (e)=>{
                        getVal(e.target);
                        document.getElementById('datepicker-year').innerHTML = currentYear;
                        currPage = currentMonth;
						document.getElementById('datepicker-blackout').style.display ='none';
						document.getElementById('datepicker-container').style.display = 'none';
						document.body.style.overflow = "";
						document.body.style.height = "";
                    });
                }
			}


		});
       