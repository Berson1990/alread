$('document').ready(function () {


    getData();
    console.log(teachersput);
    console.log(teachersput.user_id);
    $('#teacher_id').val(teachersput.user_id);
    $('#grade_id').val(teachersput.grade_id);
    // storage = $.localStorage;
    // console.log(storage.set('teachers_data', teachersput));
    // console.log(storage.isSet('teachers_data'));
    // console.log(storage.get ('teachers_data'));
    var SetItem = Cookies.set('teachers_data', teachersput, {expires: 10});
    console.log(SetItem);
    getItem = Cookies.get('teachers_data');
    console.log(getItem);
    // localStorage.setItem('teachers_data', JSON.stringify(teachersput));
    //
    // window.onload = function () {
    //
    //     var getItem = JSON.parse(localStorage.getItem('teachers_data'));
    //     console.log(getItem);
    //
    // }
    // console.log(getItem)
    grade_id = $('#grade_id').val();
    $.ajax({
        url: "allweek",
        method: 'get'
    }).done(function (result) {
        $.each(result, function () {
            $('#week').append($("<option />").val(this.week_id).text(this.week));
        });
    });
    $.ajax({
        url: "http://muthaber-admin.muthaberapp.com/api/getYear/" + grade_id,
        method: 'get'
    }).done(function (result) {
        $.each(result, function () {
            $('#year').append($("<option />").val(this.year_id).text(this.year));
        });
    });

    getsubject = function () {

        var select = document.getElementById("subject");
        var length = select.options.length;
        for (i = 0; i < length; i++) {
            select.options[i] = null;
        }

        year_id = $('#year').val();
        grade_id = $('#grade_id').val();
        console.log(grade_id);
        $.ajax({
            url: "allsubjectforteach/" + year_id + '/' + grade_id + '/' + teachersput.user_id,
            method: 'get'
        }).done(function (result) {
            $.each(result, function () {
                $('#subject').append($("<option />").val(this.subject_id).text(this.name));
            });
        });
    };


});

$('#SubmitLesson').click(function () {

    var data = {
        'year': $('#year').val(),
        'weak': $('#weak').val(),
        'subject': $('#subject').val(),
        'lesson_name': $('#lesson_name').val(),
        'teacher_id': 1,
        'grade_id': 1,
        'vidoe_url': video

    };
    console.log(data);
    $.ajax({
        url: "uploadNewFile",
        method: 'post',
        data: data
    }).done(function (result) {
        console.log(result);
    });
});

function getData() {
    var teacher_table = $('#teacherTable').DataTable();

    try {
        teacher_table
            .clear()
            .draw();
    }
    catch (ex) {

    }

    $.ajax({
        url: "getmylesson/" + teachersput.user_id,
        method: 'get'
    }).done(function (result) {
        console.log(result);
        for (var i = 0; i < result.length; i++) {
            var table = '<tr>'
                + '<td>' + result[i].lesson_name + '</td>'
                + '<td>' + '<video width="320" height="240" controls><source src=' + result[i].video_url + '>' + '</video>' + '</td>'
                // + '<td>' + '<iframe width="200" height="150" src="' + result[i].vidoe_url + '"></iframe>' + '</td>'
                + '<td>' + result[i].name + '</td>'
                + '<td>' + result[i].grade + '</td>'
                + '<td>' + result[i].year + '</td>'
                + '<td>' + result[i].week + '</td>'
                + '<td>' + '<button class="btn btn-danger" onclick="deletelesson(' + result[i].lesson_id + ')">حذف</button>' + '</td>'
                + '</tr>';
            teacher_table.row.add($(table)).draw();

            deletelesson = function (lesson_id) {
                console.log(lesson_id);
                $.ajax({
                    url: "deletelesson/" + lesson_id,
                    method: 'get',
                }).done(function (result) {
                    console.log(result);
                    window.location.href = 'teacherDashBoard'
                });


            }
        }
    });


}
