var DashBoard = new Vue({
    el: '#dashborad',
    data: {
        url: 'http://muthaber-admin.muthaberapp.com/',
        student: '',
        teacher: '',
        lesson: '',
        answer: '',
        question: '',
        questionreport:''
    },
    mounted: function () {
        var self = this;
        $.ajax({
            url: self.url + "dashboarddetails",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.student = result.student;
            self.teacher = result.teacher;
            self.lesson = result.lesson;
            self.answer = result.answer;
            self.question = result.question;
            self.questionreport = result.questionreport;


        });
    },

});