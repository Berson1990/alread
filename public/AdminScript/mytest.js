$('document').ready(function () {


    console.log(teachersput);
    console.log(teachersput.user_id);
    $('#teacher_id').val(teachersput.user_id);
    $('#grade_id').val(teachersput.grade_id);
    grade_id = $('#grade_id').val();

});
ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var Mytest = new Vue({
    el: '#mytest',
    data: {
        url: 'http://teacher.muthaberapp.com/',
        url2: 'http://muthaber-admin.muthaberapp.com/',
        TestData: [], //for test data
        TestQuestsios: [], // for test questions
        Grade: [], // for grade lockups
        Year: [], // for year lockups
        Subject: [], // for subject  lockups
        Week: [], // for week lockups
        testQuestion: [],
        dialogFormVisible: false,
        dialogTableVisible: false,
        formLabelWidth: '120px',
        isEditMode: false,
        form: {
            'subject_id': '',
            'teacher_id': '',
            'week_id': '',
            'grade_id': '',
            'year_id': '',
            'quetsion': ''

        },
        quetsions: [{
            'quetsion': '',
            'correct': '',
            'answer1': '',
            'answer2': '',
            'answer3': ''
        }],
        questsionEdit: {
            'quetsion': '',
            'correct': '',
            'answer1': '',
            'answer2': '',
            'answer3': '',
            'test_id': ''
        },
        'correct1': '',
        'correct2': '',
        'correct3': '',
        customFilters: [{
            vals: '',
            props: ['name', 'grade', 'year', 'week']
        }, {
            vals: []
        }],
        actionsDef: {
            colProps: {
                span: 8
            },
            def: [{
                name: 'new',
                handler: function () {
                    this.$message("new clicked")
                }

            }]
        }

    },
    mounted: function () {
        var self = this;
        self.getallTests();
        self.getYear();
        self.allweek();
    },
    methods: {
        getallTests: function () {
            var self = this;
            $.ajax({
                url: self.url + '/getmytest/' + teachersput.user_id,
                method: 'Get'
            }).done(function (result) {
                self.TestData = result;
                console.log(self.TestData);
            });
        },
        allweek: function () {
            var self = this;
            $.ajax({
                url: 'allweek',
                method: 'Get'
            }).done(function (result) {
                self.Week = result;
                // console.log(self.Week);
            });
        },
        getYear: function () {
            var self = this;
            $.ajax({
                url: self.url2 + "api/getYear/" + teachersput.grade_id,
                method: 'Get'
            }).done(function (result) {
                self.Year = result;
                // console.log(self.Year);
            });
        },
        getSubject: function (year_id) {
            console.log('year is' + year_id);
            var self = this;
            $.ajax({
                url: "allsubjectadminwhenassgin/" + year_id + '/' + teachersput.grade_id,
                method: 'Get'
            }).done(function (result) {
                self.Subject = result;
                // console.log(self.Subject);
            });
        },
        AddNewQuestionsInUi: function () {
            var self = this;
            self.quetsions.push({
                'quetsion': '',
                'correct': '',
                'answer1': '',
                'answer2': '',
                'answer3': ''
            })
        },
        AddEdit: function (index, row, isEditMode) {
            var self = this;
            console.log(isEditMode);
            self.isEditMode = isEditMode;
            console.log(row);
            self.form = row;
            self.quetsions = [];

            if (isEditMode === true) {
                self.quetsions = self.form.test_question;
                console.log(self.quetsions)
            }

        },
        Save: function () {
            var self = this;
            console.log(self.isEditMode);
            self.isEditMode ? self.update() : self.create();
        },
        create: function () {

            var self = this;
            self.form.grade_id = teachersput.grade_id;
            self.form.teacher_id = teachersput.teacher_id;
            var data = {
                main: self.form,
                qustions: self.quetsions
            };
            console.log(data);
            $.ajax({
                url: self.url + "createtest",
                method: 'post',
                data: data
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                Mytest.TestData.push(result);
            });
        },
        update: function () {
            var self = this;
            console.log(self.form);
            $.ajax({
                url: self.url + "updatetest/" + self.form.test_id,
                method: 'put',
                data: self.form
            }).done(function (result) {
                console.log(result);

                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                window.location.reload()
            });
        },
        showModalTest: function (index, row) {
            var self = this;
            console.log(row.test_question);
            self.testQuestion = row.test_question;
            self.dialogTableVisible = true;
        },
        addNewQuestion: function (testQuestion) {
            var self = this;
            self.questsionEdit.test_id = testQuestion[0].test_id;
            console.log(self.questsionEdit);
            $.ajax({
                url: self.url + "addnewquestiontest",
                method: 'post',
                data: self.questsionEdit
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                Mytest.testQuestion.push(result);
            });


        },
        deleteAuestion: function (index, quetsions, testQuestion) {
            var self = this;
            console.log(quetsions);
            $.ajax({
                url: self.url + "deletequestion/" + quetsions.questaion_id,
                method: 'Get'
            }).done(function (result) {
                testQuestion.splice(index, 1);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
            });

        },
        deletetest: function (index, row) {
            console.log(index);
            var self = this;
            $.ajax({
                url: self.url + "deletmytest/" + row.test_id,
                method: 'Get'
            }).done(function (result) {
                Mytest.TestData.splice(index, 1);
                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
            });

        }
    }
});




