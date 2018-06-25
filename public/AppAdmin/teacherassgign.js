ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);

var teacherassgin = new Vue({
        el: '#teacherassgin',
        data: {
            url: 'http://muthaber-admin.muthaberapp.com/',
            teacherData: [],
            teacher_assgin: [],
            Grade: [],
            Year: [],
            Subject: [],
            dialogFormVisible: false,
            dialogTableVisible: false,
            formLabelWidth: '120px',
            form: {
                teacher_id: '',
                grade_id: '',
                year_id: '',
                subject_id: ''
            },
            customFilters: [{
                vals: '',
                props: ['name']
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
            $.ajax({
                url: self.url + "getallteaches",
                method: 'Get'

            }).done(function (result) {

                self.teacherData = result;

                console.log(self.teacherData);
            });

            $.ajax({
                url: self.url + "allgrade", method: 'Get'
            }).done(function (result) {
                self.Grade = result;
                console.log(self.Grade);
            });

        },
        methods: {

            assgin: function () {
                var self = this;
                console.log(self.form);
                $.ajax({
                    url: self.url + "assgin",
                    method: 'Post',
                    data: self.form

                }).done(function (result) {

                    self.teacher_assgin = result;

                    console.log(self.teacher_assgin);
                });

            },

            deleteAssgin: function (assgin, index, teacher_assgin) {
                console.log(assgin);
                console.log(index);
                teacher_assgin.splice(index, 1);
                var self = this;
                $.ajax({
                    url: self.url + "deleteassgin/" + assgin.assgin_id,
                    method: 'Delete'

                }).done(function (result) {


                });

            },
            getassgin: function (index, row) {

                var self = this;
                self.dialogTableVisible = true;
                console.log(row);
                $.ajax({
                    url: self.url + "getassgin/" + row.user_id,
                    method: 'Get'

                }).done(function (result) {

                    self.teacher_assgin = result;

                    console.log(self.teacher_assgin);
                });
            },
            passdata: function (index, row) {
                console.log(row);
                var self = this;
                self.form.teacher_id = row.user_id;
                return self.form.teacher_id
            },
            getYear: function (grade_id) {
                var self = this;
                $.ajax({
                    url: self.url + "api/getYear/" + grade_id,
                    method: 'Get'
                }).done(function (result) {
                    self.Year = result;
                    console.log(self.Year);
                });
            },
            getSubject: function (year_id, grade_id) {
                console.log('grda is' + grade_id);
                console.log('year is' + year_id);
                var self = this;
                $.ajax({
                    url: self.url + "allsubjectadminwhenassgin/" + year_id + '/' + grade_id,
                    method: 'Get'
                }).done(function (result) {
                    self.Subject = result;
                    console.log(self.Subject);
                });
            }

        }
    })
;