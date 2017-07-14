$(document).ready(function(){
	var obj =[];
	$('#saveButton').click(function(){
			

			$('.questions').each(function(){
				if($(this).find('select').val()=="text")
				{
					var object = {
										"questionId" : $(this).find('input[name="questionId"]').val(),
										"questionText": $(this).find('input[name="questionText"]').val(),
										"questionAnswer": $(this).find('input[name="questionAnswer"]').val(),
										"questionType": $(this).find('select').val(),
										"questionId" : $(this).find('input[name="questionId"]').val(),
										"questionairId" : $(this).find('input[name="questionairId"]').val()
								}
					obj.push(object);
				}
				else if($(this).find('select').val()=="multipleS" || $(this).find('select').val()=="multipleM")
				{
					
						var choices = [];
						
						$(this).find(".choices").each(function(){
							var choiceObj = {
								"choiceId" : $(this).find('input[name="choiceId"]').val(),
								"choiceText" : 	$(this).find('input[name="choiceText"]').val(),
								"questionId" : $(this).find('input[name="questionId"]').val()
							} 
							choices.push(choiceObj);
						});
						if($(this).find('input[name="questionId"]').val().indexOf('questionN')>=0){
							var answer = "answer";
						}else{
							answer = $(this).find('input[name="answer'+$(this).find('input[name="questionId"]').val()+'"]').val();
						}
					var object = {
										"questionText": $(this).find('input[name="questionText"]').val(),
										"questionAnswer": answer,
										"questionType": $(this).find('select').val(),
										"questionChoices": choices,
										"questionId" : $(this).find('input[name="questionId"]').val(),
										"questionairId" : $(this).find('input[name="questionairId"]').val()
								}
						obj.push(object);
					
				}
			});
			 var questionairID = $('.questionsBody').find('input[name="questionairId"]').val();
			 $.ajax({

			 	url: "../saveQuestions",
			 	type: "GET",
			 	data : {Questions : obj , QuestionairId:questionairID}, 
			 	success: function(result)
			 	{
        			var	obj = [];
        			var baseUrl = document.location.origin;
        			window.location.href = "/QuestionairManager/public/questionairs";
   	 			}
   	 		});
	});

});