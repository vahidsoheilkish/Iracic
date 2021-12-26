$("#volume_id").change(function(){
    let _token = $("#_token").val();
    let id = $(this).children(":selected").attr("value");
    let issue_id = $("#issue_id");
    $.ajax({
        'url' : '/publication/issues/volume/'+id ,
        'type' : 'POST' ,
        'data' : {_token , id} ,
        'dataType' : 'json' ,
        'success' : function(data){
            issue_id.empty();
            issue_id.append('<option></option>');
            for(let i=0; i<data.length; i++){
                issue_id.append('<option value="'+data[i]._id+'">ماه '+ data[i].duration +' </option>');
            }
        }
    });
});


function addAuthor(){
    let last_id = $(".authors_form:last").attr("id");
    let split_id = last_id.split("_");
    let nextIndex = Number(split_id[2]) + 1;
    if(nextIndex >= 16){
        return;
    }
    $(".authors_form:last").after("<div class='authors_form' id='authors_form_"+ nextIndex +"'></div>");

    $("#authors_form_" + nextIndex).append('<p class="tar author_list">نویسنده '+digitToFarsi(nextIndex)+'</p>' +
        '                            <div class="one_author col-sm-5 form-inline form-horizontal">\n' +
        '                                <input type="text" name="author_name[]"  id="author_name_'+nextIndex+'" class="form-control-sm" required />\n' +
        '                                <label for="author_name_'+nextIndex+'">نام نویسنده</label>\n' +
        '\n' +
        '                                <input type="text" name="author_email[]" id="author_email_'+nextIndex+'" class="form-control-sm" required />\n' +
        '                                <label for="author_email_'+nextIndex+'">ایمیل نویسنده</label>\n' +
        '\n' +
        '                                <input type="text" name="author_rate[]" id="author_rate_'+nextIndex+'" class="form-control-sm" required />\n' +
        '                                <label for="author_rate_'+nextIndex+'">رتبه نویسنده</label>\n' +
        '\n' +
        '                                <input type="text" name="author_dependency[]" id="author_dependency_'+nextIndex+'" class="form-control-sm" required />\n' +
        '                                <label for="author_dependency_'+nextIndex+'' +
        '">وابستگی نویسنده</label>\n' +
        '</div>');
}


function addResource(){
    let last_id = $(".resouces_form:last").attr("id");
    let split_id = last_id.split("_");
    let nextIndex = Number(split_id[2]) + 1;
    if(nextIndex >= 16){
        return;
    }
    $(".resouces_form:last").after("<div class='resouces_form' id='resource_form_"+ nextIndex +"'></div>");
    $("#resource_form_" + nextIndex).append('<label for="resource_'+nextIndex+'" style="margin:10px;">منبع '+digitToFarsi(nextIndex)+'</label>\n' +
        '                            <input type="text" name="resource[]" id="resource_'+nextIndex+'" class="form-control" />');
}


function digitToFarsi(number){
    switch (number){
        case 1 : return 'اول';
        case 2 : return 'دوم';
        case 3 : return 'سوم';
        case 4 : return 'چهارم';
        case 5 : return 'پنجم';
        case 6 : return 'ششم';
        case 7 : return 'هفتم';
        case 8 : return 'هشتم';
        case 9 : return 'نهم';
        case 10 : return 'دهم';
        case 11 : return 'یازدهم';
        case 12 : return 'دوازدهم';
        case 13 : return 'سیزدهم';
        case 14 : return 'چهاردهم';
        case 15 : return 'پانزدهم';
        case 16 : return 'شانزدهم';
        case 17 : return 'هفدهم';
        case 18 : return 'هجدهم';
        case 19 : return 'نوزدهم';
        case 20 : return 'بیستم';
        case 21 : return 'بیست و یکم';
        case 22 : return 'بیست و دوم';
        case 23 : return 'بیست و سوم';
        case 24 : return 'بیست و چهارم';
        case 25 : return 'بیست و پنجم';
        case 26 : return 'بیست و ششم';
        case 27 : return 'بیست و هفتم';
        case 28 : return 'بیست و هشتم';
        case 29 : return 'بیست و نهم';
        case 30 : return 'سی ام';
    }
}




