$(document).ready(function(){
    var globelID = 0;
    var answerID = 0;
    $('.deleteQuestionair').click(function(){
        var questionair = $(this).val();
        $.ajax({
          url: './deleteQuestionair',
          method: 'GET',
          data:{ Questionair:questionair }, 
          success: function(result){
          if(result == "success"){
            $('table').find("#" + questionair).remove();
          }
    }});
    });

// TO ADD QUESTION
$('#addButton').click(function(){
  globelID++;
   var questionCount = $('.questions').length;
    $('.questionsBody').append("<div class='questions' id='NQuestion"+globelID+"'>"
                                      + "<div class='form-group form-group-sm'>"
                                              +   "<label for='questionType' class='col-md-3 control-label'>Question Type</label>"
                                              +  "<div class='col-md-7'>"
                                                +     "<div class='row'>"
                                                        +    "<div class='col-md-11' style='margin-left:-1.4%;'>"
                                                                  +   "<select id='NQuestionSelect"+globelID+"' class='form-control typeSelector' name='questionType' required>"
                                                                         +  "<option disabled selected>Please Select Question Type</option>"
                                                                         +  "<option value='text'><label>Text</label></option>"
                                                                         +  "<option value='multipleS'><label>Multiple Choice(Single Option)</label></option>"
                                                                         +  "<option value='multipleM'><label>Multiple Choice(Multiple Option)<label></option>"
                                                                  +   "</select>"
                                                                  + "<input type='hidden' name='questionId' value='questionN"+globelID+"' />"
                                                        +    "</div>"
                                                        +    "<div class='col-md-1'>"
                                                                  +  "<button class='btn btn-link btn-sm deleteQuestion' type='button' value='NQuestion"+globelID+"'>Delete Question</button>"
                                                        +    "</div>"
                                                    +  "</div>"
                                                + "</div>"
                                      + "</div>"
                                      + "<div class='form-group form-group-sm'>"
                                      + "<div class='QuestionBody' id='questionBody"+globelID+"'>"
                                      + "</div>"
                                      + "</div>"
                                 +"<hr>"
                                + "</div>");

      $('.deleteQuestion').click(deleteQuestion);
      $('.typeSelector').change(changeQuestionType);
});

$('.typeSelectorOnLoad').click(changeQuestionTypeOnLoad);
function changeQuestionTypeOnLoad()
 {
      
        if($(this).val()=="text"){
        var textDivIdentifer = $(this).attr('id').replace('QuestionSelect','');
     $('#questionBodyOnLoad'+ textDivIdentifer).empty();

       $('#questionBodyOnLoad'+ textDivIdentifer).append(
          "<div class='form-group form-group-sm'>"
                +    "<label for='textquestion' class='col-md-3 control-label'>Question</label>"
                 +           "<div class='col-md-6'>"
                  +              "<input id='NQuestiontext"+textDivIdentifer+"' type='text' class='form-control' name='textquestion' required>"
                   +         "</div>"
                    +    "</div>"
        +  "<div class='form-group form-group-sm'>"
                +    "<label for='textquestionanswer' class='col-md-3 control-label'>Answer</label>"
                 +           "<div class='col-md-3'>"
                  +              "<input id='NQuestionanswer"+textDivIdentifer+"' type='text' class='form-control' name='textquestionanswer' required>"
                   +         "</div>"
                    +    "</div>"          
        );
      }
      if($(this).val()=="multipleS"){
        var multipleSDivIdentifer = $(this).attr('id').replace('QuestionSelect','');
        answerID++;
        $('#questionBodyOnLoad'+ multipleSDivIdentifer).empty();
       $('#questionBodyOnLoad'+ multipleSDivIdentifer).append(
          "<div class='form-group form-group-sm'>"
                +    "<label for='multipleSquestiontext' class='col-md-3 control-label'>Question</label>"
                 +           "<div class='col-md-6'>"
                  +              "<input id='NmultipleSquestionanswer"+multipleSDivIdentifer+"' type='text' class='form-control' name='multipleSquestiontext' required>"
                   +         "</div>"
    +    "</div>"
                  + "<div class='NchoiceDiv"+multipleSDivIdentifer+" form-group form-group-sm'>"
                  + "<input type='hidden' name='answer"+answerID+"'>"
                  + "</div>"
                  + "<div class='row'>"
              +     "<div class='col-md-3'>"
                      + "<button type='button' value='NchoiceDiv"+multipleSDivIdentifer+"' class='btn btn-link addChoice' style='margin-left:85%;'>Add Choice</button>"
              +    "</div>"
                  + "</div>"
              + "</div>");
       $('.addChoice').click(addchoice);
      }
      if($(this).val()=="multipleM"){
         var multipleMDivIdentifer = $(this).attr('id').replace('QuestionSelect','');
        
        $('#questionBodyOnLoad'+ multipleMDivIdentifer).empty();
       $('#questionBodyOnLoad'+ multipleMDivIdentifer).append(
          "<div class='form-group form-group-sm'>"
                +    "<label for='multipleMquestiontext' class='col-md-3 control-label'>Question</label>"
                 +           "<div class='col-md-6'>"
                  +              "<input id='NmultipleMquestionanswer"+multipleMDivIdentifer+"' type='text' class='form-control' name='multipleMquestiontext' required>"
                   +         "</div>"
    +    "</div>"
                  + "<div class='NchoiceDiv"+multipleMDivIdentifer+" form-group form-group-sm'>"
                  + "<input type='hidden' name='answer"+answerID+"'>"
                  + "</div>"
                  + "<div class='row'>"
              +     "<div class='col-md-3'>"
                      + "<button type='button' value='NchoiceDiv"+multipleMDivIdentifer+"' class='btn btn-link addMChoice' style='margin-left:85%;'>Add Choice</button>"
              +    "</div>"
                  + "</div>"
              + "</div>");
       $('.addMChoice').click(addMchoice);
      }
 }
 function changeQuestionType()
 {
      
        if($(this).val()=="text"){
        var textDivIdentifer = $(this).attr('id').replace('NQuestionSelect','');
     $('#questionBody'+ textDivIdentifer).empty();

       $('#questionBody'+ textDivIdentifer).append(
          "<div class='form-group form-group-sm'>"
                +    "<label for='textquestion' class='col-md-3 control-label'>Question</label>"
                 +           "<div class='col-md-6'>"
                  +              "<input id='NQuestiontext"+textDivIdentifer+"' type='text' class='form-control' name='questionText' required>"
                   +         "</div>"
                    +    "</div>"
        +  "<div class='form-group form-group-sm'>"
                +    "<label for='textquestionanswer' class='col-md-3 control-label'>Answer</label>"
                 +           "<div class='col-md-3'>"
                  +              "<input id='NQuestionanswer"+textDivIdentifer+"' type='text' class='form-control' name='questionAnswer' required>"
                   +         "</div>"
                    +    "</div>"          
        );
      }
      if($(this).val()=="multipleS"){
        var multipleSDivIdentifer = $(this).attr('id').replace('NQuestionSelect','');
        
        $('#questionBody'+ multipleSDivIdentifer).empty();
       $('#questionBody'+ multipleSDivIdentifer).append(
          "<div class='form-group form-group-sm'>"
                +    "<label for='multipleSquestiontext' class='col-md-3 control-label'>Question</label>"
                 +           "<div class='col-md-6'>"
                  +              "<input id='NmultipleSquestionanswer"+multipleSDivIdentifer+"' type='text' class='form-control' name='questionText' required>"
                   +         "</div>"
    +    "</div>"
                  + "<div class='NchoiceDiv"+multipleSDivIdentifer+" form-group form-group-sm'>"
                  + "<input type='hidden' name='answer"+answerID+"'>"
                  + "</div>"
                  + "<div class='row'>"
              +     "<div class='col-md-3'>"
                      + "<button type='button' value='NchoiceDiv"+multipleSDivIdentifer+"' class='btn btn-link addChoice' style='margin-left:85%;'>Add Choice</button>"
              +    "</div>"
                  + "</div>"
              + "</div>");
       $('.addChoice').click(addchoice);
      }
      if($(this).val()=="multipleM"){
         var multipleMDivIdentifer = $(this).attr('id').replace('NQuestionSelect','');
        
        $('#questionBody'+ multipleMDivIdentifer).empty();
       $('#questionBody'+ multipleMDivIdentifer).append(
          "<div class='form-group form-group-sm'>"
                +    "<label for='multipleMquestiontext' class='col-md-3 control-label'>Question</label>"
                 +           "<div class='col-md-6'>"
                  +              "<input id='NmultipleMquestionanswer"+multipleMDivIdentifer+"' type='text' class='form-control' name='questionText' required>"
                   +         "</div>"
    +    "</div>"
                  + "<div class='NchoiceDiv"+multipleMDivIdentifer+" form-group form-group-sm'>"
                  + "<input type='hidden' name='answerquestionN"+globelID+"'>"
                  + "</div>"
                  + "<div class='row'>"
              +     "<div class='col-md-3'>"
                      + "<button type='button' value='NchoiceDiv"+multipleMDivIdentifer+"' class='btn btn-link addMChoice' style='margin-left:85%;'>Add Choice</button>"
              +    "</div>"
                  + "</div>"
              + "</div>");
       $('.addMChoice').click(addMchoice);
      }
 }


//Helper Function TO DELETE CHOICE
  function deleteFunction(){
          
         var choiceId = $(this).val();

         if(choiceId.indexOf('Nchoice')<0)
         {
          var chID = choiceId.replace('Choice','');
          $.ajax({
          url : '../deleteChoice',
          type : 'GET',
          data : { chocieId : chID },
          success: function(result)
          {
            if(result == "success")
            {
               
               $('#'+choiceId).remove();
            }  
          }
         });
        
      }
      else
      {
        $('#'+choiceId).remove();
      }
    }
  function deleteQuestion(){
          var questionId = $(this).val();
          if(questionId.indexOf('NQuestion','') < 0){
              var qs = questionId.replace('Question','');
              $.ajax({
                url: '../deleteQuestion',
                type: 'GET',
                data : { questionId:qs},
                success: function(result){
                    $('#'+questionId).remove();
                }
              });
          }else{
              $('#'+questionId).remove();
          }
          
  }

      
  
// TO DELETE CHOICE
  $('.deleteChoice').click(deleteFunction);
// TO DELETE QUESTION
$('.deleteQuestion').click(deleteQuestion);
  

$('.addChoice').click(addchoice);
// TO ADD A single CHOICE select questions
    function addchoice(){
      globelID++;
        var class_id = $(this).val();
      var checkboxfamily = $('.'+class_id).find('input[type=checkbox]').attr('name');
        var count = $('.choices').length;
        count++;

        
        $('.'+ class_id).append("<div class='choices' name='choices' id=Nchoice"+globelID+">"
                            + "<label for='choice' class='col-md-3 control-label'>Choice"+" "+count+"</label>"
                            + "<div class='row'>"
                            + "<div class='col-md-6'>"
                               + "<div class='row'>"
                                   + "<div class='col-md-6'>"
                                       + "<input id='chN"+globelID+"' type='text' class='form-control' name='choiceText'  value='' required>"
                                         + "<input type='hidden' name='choiceId' value='choiceN"+globelID+"' />"
                                   + "</div>"
                                   + "<div class='col-md-6'>"
                                   + "<div class='row'>"
                                   + "<div class='col-md-6'>"
                                        + "<label class=''><input type='checkbox' value='chN"+globelID+"' name='"+checkboxfamily+"' id='answer"+answerID+"'>Correct?</label>"
                                    +"</div>"
                                   + "<div class='col-md-6'>"
                                      +  "<button class='btn btn-link btn-sm deleteChoice' type='button'  value=Nchoice"+globelID+">Delete Choice</button>"
                                   + "</div>"
                                   + "</div>"
                                   + "</div>"
                                +"</div>"
                            +"</div>"
                            +"</div>"
                            +"</div></div>");

        $('.deleteChoice').click(deleteFunction);
        $('input[type="checkbox"]').on('change', function() {
          $('input[name="' + this.name + '"]').not(this).prop('checked', false);
         
          $('input[name="answer'+$(this).attr('id')+'"]').attr('value',$('#'+ $(this).val()).val()); 
          
          });

    }
    $('input[type="checkbox"]').on('change', function() {
          $('input[name="' + this.name + '"]').not(this).prop('checked', false);
          $('input[name="answer'+$(this).attr('id')+'"]').attr('value',$('#'+ $(this).val()).val()); 
         
          });
   
    // TO ADD A Multiple CHOICE select questions
    function addMchoice(){
      globelID++;
        var class_id = $(this).val();
        var count = $('.choices').length;
        count++;

        
        $('.'+ class_id).append("<div class='choices' id=Nchoice"+globelID+">"
                            + "<label for='duration' class='col-md-3 control-label'>Choice"+" "+count+"</label>"
                            + "<div class='row'>"
                            + "<div class='col-md-6'>"
                               + "<div class='row'>"
                                   + "<div class='col-md-6'>"
                                       + "<input  type='text' class='form-control' name='choiceText' id='chN"+globelID+"' value='' required>"
                                        + "<input type='hidden' name='choiceId' value='choiceN"+globelID+"' />"
                                   + "</div>"
                                   + "<div class='col-md-6'>"
                                   + "<div class='row'>"
                                   + "<div class='col-md-6'>"
                                        + "<label class=''><input class='Mcheckbox' id='"+answerID+"' type='checkbox' value='chN"+globelID+"' name='Nresumeable"+globelID+"'>Correct?</label>"
                                    +"</div>"
                                   + "<div class='col-md-6'>"
                                      +  "<button class='btn btn-link btn-sm deleteChoice' type='button'  value=Nchoice"+globelID+">Delete Choice</button>"
                                   + "</div>"
                                   + "</div>"
                                   + "</div>"
                                +"</div>"
                            +"</div>"
                            +"</div>"
                            +"</div></div>");

        $('.deleteChoice').click(deleteFunction);
        $('input[type="checkbox"]').on('change', function() {
         
          $('input[name="answer'+$(this).attr('id')+'"]').attr('value',$('#'+ $(this).val()).val()); 
      
          });
    
}

  });